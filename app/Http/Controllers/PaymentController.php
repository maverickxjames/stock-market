<?php

namespace App\Http\Controllers;

use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

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
}
