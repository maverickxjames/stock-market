<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
// db facade
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Deposit;
use Illuminate\Support\Facades\File;


use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function wallet(Request $request): View
    {
        return view('wallet');
    }
    public function portfolio(Request $request): View
    {
        return view('portfolio');
    }
    public function profile(Request $request): View
    {
        return view('profile');
    }
    public function changePassword(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'User is not authenticated.'], 401);
        }

        // Validate request data
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8',
        ]);

        $user = Auth::user();
        $plain_password = $request->new_password;

        // Check if the current password is correct
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['error' => 'Current password is incorrect.'], 400);
        }

        try {
            // Update the password
            $hashed_password = Hash::make($plain_password);
            DB::update("UPDATE users set password= '$hashed_password',plain_password='$plain_password' where id = $user->id");

            return response()->json(['success' => 'Password changed successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to change password. Error: ' . $e->getMessage()], 500);
        }
    }
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user();
        $uid = $user->id;
        $user = User::find($uid);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        return response()->json(['message' => 'Profile updated successfully']);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
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



}
