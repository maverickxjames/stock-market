<?php

namespace App\Http\Controllers;

// use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use Illuminate\View\View;

class PaymentController extends Controller
{
    public function generatePaymentLink(Request $request)
    {
        $userId = auth()->user()->id;


        // Fetch user details
        $user = DB::table('users')->where('id', $userId)->first();

        $paymentMode = $request->input('payment_mode');
        $amount = $request->input('amount');

        if (!$paymentMode || !$amount) {
            return response()->json(['status' => 'error', 'message' => 'Payment mode and amount are required.'], 400);
        }

        // Fetch settings
        // $settings = DB::table('settings')->where('id', 1)->first();
        // $minDeposit = $settings->minRecharge;

        // if ($amount < $minDeposit) {
        //     return response()->json(['status' => 'error', 'message' => "Minimum deposit amount is $minDeposit"], 400);
        // }

        switch ($paymentMode) {
            case 'phonepe_api':
                return $this->handlePhonePeApi($user, $amount);

            case 'manual':
                return $this->handleManualPayment($amount);

            case 'upigateway':
                return $this->handleUPIGateway($user, $amount);

            case 'bankcard':
                return $this->handleBankPayment($amount);

            default:
                return response()->json(['status' => 'error', 'message' => 'Invalid payment mode'], 400);
        }
    }

    private function handlePhonePeApi($user, $amount)
    {
        $txnId = uniqid('txn_');
            DB::table('deposits')->insert([
                'userid' => $user->id,
                'order_id' => $txnId,
                'amount' => $amount,
                'type' => 'deposit',
                'upi' => 'upi',
                'status' => 0,
                'remark' => 'Pending Payment',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json(['status' => 'success', 'url' => route('recharge', ['txn_id' => $txnId])]);
    }

    private function handleManualPayment($amount)
    {
        $upiList = DB::table('manualupi')->where('status', 1)->get();
        if ($upiList->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'No UPI available'], 400);
        }

        $selectedUpi = $upiList->random();
        $txnId = uniqid('txn_');

        DB::table('deposits')->insert([
            'userid' => auth()->id(),
            'order_id' => $txnId,
            'amount' => $amount,
            'type' => 'deposit',
            'upi' => $selectedUpi->upi,
            'status' => 0,
            'remark' => 'Pending Payment',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['status' => 'success', 'url' => route('recharge', ['txn_id' => $txnId])]);
    }

    private function handleUPIGateway($user, $amount)
    {
        $txnId = uniqid('txn_qr_');
        $data = [
            'customer_mobile' => $user->mobile,
            'user_token' => '70080ad1bdbef1d1d0b394be20e1c7ff',
            'amount' => $amount,
            'order_id' => $txnId,
            'redirect_url' => route('payment.history'),
            'remark1' => 'ludopaisa',
            'remark2' => 'ludopaisa',
        ];

        $response = $this->makeApiRequest('https://upig.in/api/create-order', $data);

        if ($response['status'] ?? false) {
            DB::table('paymenthistory')->insert([
                'userid' => $user->id,
                'order_id' => $txnId,
                'amount' => $amount,
                'type' => 'deposit',
                'upi' => 'upigateway',
                'status' => 0,
                'remark' => 'Pending Payment',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json(['status' => 'success', 'url' => $response['result']['payment_url']]);
        }

        return response()->json(['status' => 'error', 'message' => 'Error in API response', 'response' => $response]);
    }

    private function handleBankPayment($amount)
    {
        $bankDetails = DB::table('manual_deposit')->where('status', 1)->orderByDesc('id')->first();
        if (!$bankDetails) {
            return response()->json(['status' => 'error', 'message' => 'No bank available'], 400);
        }

        $txnId = uniqid('btxn_');
        DB::table('paymenthistory')->insert([
            'userid' => auth()->id(),
            'order_id' => $txnId,
            'amount' => $amount,
            'type' => 'deposit',
            'upi' => json_encode([
                'ac' => $bankDetails->ac,
                'ac_holder' => $bankDetails->ac_holder,
                'ifsc' => $bankDetails->ifsc,
                'bank_name' => $bankDetails->bank_name,
            ]),
            'status' => 0,
            'remark' => 'Pending Payment',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['status' => 'success', 'url' => route('deposit', ['txn_id' => $txnId])]);
    }

    private function makeApiRequest($url, $data)
    {
        $response = Http::asForm()->post($url, $data);
        return $response->json();
    }

    public function deposit(Request $request): View
    {
        return view('deposit');
    }
    public function payment_link(Request $request): View
    {
        return view('payment_link');
    }
    public function recharge($txn_id)
    {
        if ($txn_id) {
            $txn = DB::table('deposits')
                ->where('order_id', $txn_id)
                ->whereNull('utr')
                ->whereNull('payment_ss')
                ->first();

                if ($txn) {
                    if ($txn->status == 1) {
                        // Payment success
                        return response()->json([
                            'status' => 'success',
                            'icon' => 'success',
                            'title' => 'Payment Success',
                            'message' => 'Payment Already Received!',
                            'redirect' => route('deposit'),
                        ]);
                    } elseif ($txn->status == 2) {
                        // Payment failed
                        return response()->json([
                            'status' => 'failed',
                            'icon' => 'error',
                            'title' => 'Payment Failed',
                            'message' => 'Payment has been failed. Please try again!',
                            'redirect' => route('deposit'),
                        ]);
                    } else {
                        // Prepare UPI details for QR code
                        $upi = $txn->upi;
                        $amount = $txn->amount;
                        $upi_data = urlencode("upi://pay?pa=$upi&pn=Ludopaisa&mc=0000&tid=$txn_id&tr=$txn_id&tn=Add%20Funds&am=$amount&cu=INR");
                        $qr_img = "https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=" . $upi_data;
        
                        return view('recharge', compact('upi', 'amount', 'upi_data', 'qr_img', 'txn_id'));
                    }
                } else {
                    // Transaction not found
                    return response()->json([
                        'status' => 'not_found',
                        'icon' => 'error',
                        'title' => 'Payment Not Found',
                        'message' => 'Payment not found. Please make payment first!',
                        'redirect' => route('deposit'),
                    ]);
                }
        } else {
            return redirect()->route('deposit')->with('error', 'Transaction not found');
        }
    }

    public function uploadRef(Request $request)
    {
        try {
            // Validate the request inputs
            $request->validate([
                'txn_id' => 'required|string',
                'ss' => 'required|file|mimes:jpg,jpeg,png,gif|max:20480', // Max 2MB file size
                'utr' => 'nullable|string'
            ]);

            $txn_id = $request->input('txn_id');
            $utr = $request->input('utr');
            $user_id = Auth::id(); // Assuming the user is authenticated

            // Get the transaction details
            $transaction = DB::table('depsoits')->where('order_id', $txn_id)->first();

            if (!$transaction) {
                return response()->json(['icon' => 'error', 'title' => 'Error', 'message' => 'Transaction not found.'], 404);
            }

           

            //upload the file
            $file = $request->file('ss');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = 'public/payment_ss/' . $filename;
            Storage::put($path, File::get($file));


            // Update the database based on transaction type
            if ($transaction->type === 'usdt') {
                $update = DB::table('deposits')->where('order_id', $txn_id)->update([
                    'remark' => 'Payment Requested',
                    'payment_ss' => $filename
                ]);
            } else {
                $update = DB::table('deposits')->where('order_id', $txn_id)->update([
                    'remark' => 'Payment Requested',
                    'utr' => $utr,
                    'payment_ss' => $filename
                ]);
            }

            if ($update) {
                return response()->json(['icon' => 'success', 'title' => 'Success', 'message' => 'Payment proof uploaded successfully.', 'redirect' => url('/success-page')]);
            } else {
                return response()->json(['icon' => 'error', 'title' => 'Error', 'message' => 'Failed to update the transaction.'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['icon' => 'error', 'title' => 'Error', 'message' => 'An unexpected error occurred.', 'error' => $e->getMessage()], 500);
        }
    }


    public function withdraw(Request $request): View
    {
        return view('withdraw');
    }

}
