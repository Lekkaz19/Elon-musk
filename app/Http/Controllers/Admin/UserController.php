<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('role')->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'role_id' => ['required', 'integer', Rule::exists('user_permissions', 'id')],
        ]);

        // Prevent admin from removing their own admin role
        if ($user->id === auth()->id() && $user->isAdmin() && (int)$request->role_id !== $user->role_id) {
            $adminRole = Role::where('name', 'admin')->first();
            if ($user->role_id === $adminRole->id && (int)$request->role_id !== $adminRole->id) {
                 return back()->withErrors(['role_id' => 'You cannot remove your own admin status.']);
            }
        }

        $user->update(['role_id' => $request->role_id]);

        return redirect()->route('admin.users.index')->with('success', 'User role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Prevent admin from deleting themselves
        if ($user->id === auth()->id()) {
            return back()->withErrors(['error' => 'You cannot delete your own account.']);
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}