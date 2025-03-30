<?php

namespace App\Http\Controllers\Auth;

use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\AdminChangePasswordRequest;
use App\Http\Requests\Auth\UpdateAdminAccountRequest;

class AdminProfileController extends Controller
{
    // Display the Account tab view
    public function view()
    {
        $admin = Auth::guard('admin')->user();
        return view('auth.admin.account', compact('admin'));
    }

    // Update the admin account details
    public function update(UpdateAdminAccountRequest $request)
    {
        $admin = Auth::guard('admin')->user();

        try {
            $admin->update([
                'name' => $request->name,
                'username' => $request->username,
                'phone' => $request->phone,
                'email' => $request->email,
                'status' => $request->status,
            ]);

            // Success notification
            sweetalert()->success('Account details updated successfully.');
        } catch (\Exception $e) {
            // Error notification
            sweetalert()->error('Failed to update account details. Please try again.');
            return redirect()->back();
        }

        return redirect()->route('admin.profile.account.view');
    }

    // Display the Security tab view
    public function security()
    {
        $admin = Auth::guard('admin')->user();
        return view('auth.admin.security', compact('admin'));
    }

    // Change the admin password
    public function changePassword(AdminChangePasswordRequest $request)
    {
        $admin = auth('admin')->user();

        try {
            $admin->update(['password' => bcrypt($request->newPassword)]);
            // Success notification
            sweetalert()->success('Password updated successfully.');
        } catch (\Exception $e) {
            // Error notification
            sweetalert()->error('Failed to update password. Please try again.');
            return back();
        }

        return back();
    }
}
