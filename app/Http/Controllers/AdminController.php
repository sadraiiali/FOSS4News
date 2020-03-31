<?php

namespace App\Http\Controllers;

use App\Post;
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
        $users = User::orderBy('role', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->paginate(30);

        $users_count = $users->toArray()['total'];
        $last_page = $users->toArray()['last_page'];
        $current_page = $users->toArray()['current_page'];
        $admins_count = User::where(['role' => 'ADMIN'])->count();

        return view('admin.users', [
            'users' => $users,
            'admins_count' => $admins_count,
            'users_count' => $users_count,
            'last_page' => $last_page,
            'current_page' => $current_page,
        ]);
    }

    public function showPosts()
    {
        $posts = Post::with(array('user' => function ($query) {
            $query->select('name');
        }))
            ->orderBy('created_at', 'DESC')
            ->paginate(30);

        $posts_count = $posts->toArray()['total'];
        $last_page = $posts->toArray()['last_page'];
        $current_page = $posts->toArray()['current_page'];
        $trashed_count = Post::onlyTrashed()->count();

        return view('admin.posts', [
            'posts' => $posts,
            'posts_count' => $posts_count,
            'last_page' => $last_page,
            'current_page' => $current_page,
            'trashed_count' => $trashed_count,
        ]);
    }

    public function deletePost(Post $post)
    {
        try {
            $post->delete();
            return redirect()->back();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['msg' => __('errors.admin.Delete Post')]);
        }
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
