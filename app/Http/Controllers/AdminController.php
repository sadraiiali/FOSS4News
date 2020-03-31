<?php

namespace App\Http\Controllers;

use App\User;
use Exception;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.home');
    }

    public function showUsers()
    {
        $users = User::orderBy('role', 'DESC')->orderBy('created_at', 'DESC')->paginate(20);
        $users_count = $users->toArray()['total'];
        $admins_count = User::where(['role' => 'ADMIN'])->count();
        return view('admin.users', [
            'users' => $users,
            'admins_count' => $admins_count,
            'users_count' => $users_count,
        ]);
    }

    public function deleteUser(User $user)
    {
        try {
            $user->posts()->delete();
            $user->votes()->delete();
            $user->reports()->delete();
            $user->reported()->delete();
            $user->delete();
            return redirect()->back();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['msg' => __('errors.admin.Delete User')]);
        }
    }

    public function makeAdmin(User $user)
    {
        try {
            $user->update(['role' => 'ADMIN']);
            return redirect()->back();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['msg' => __('errors.admin.Make Admin User')]);
        }
    }
}
