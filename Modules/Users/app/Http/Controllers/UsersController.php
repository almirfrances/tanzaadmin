<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Users\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users::dashboard.index');
    }

    public function AdminIndex(Request $request)
    {
        $search = $request->get('search');
        $users = User::query()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('username', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view('users::admin.users.index', compact('users'));
    }



    public function update(Request $request, $id)
    {
        try {
            // Find the user
            $user = User::findOrFail($id);

            // Validate request data
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'username' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('users')->ignore($user->id),
                ],
                'phone' => [
                    'required',
                    'string',
                    'max:15',
                    Rule::unique('users')->ignore($user->id),
                ],
                'status' => 'required|in:active,inactive',
            ]);

            // Update user details
            $user->update($validated);
            sweetalert()->success('User updated successfully!');


            return redirect()->route('admin.users.index');
        } catch (\Exception $e) {
            // Log the exception for debugging
            sweetalert()->error('Failed to update user details. Please try again.');

            return redirect()->route('admin.users.index');
        }
    }



        /**
     * Remove the specified user from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        sweetalert()->success('User deleted successfully!');

        return redirect()->route('admin.users.index');
    }
}
