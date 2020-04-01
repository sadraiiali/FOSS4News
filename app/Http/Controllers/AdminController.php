<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\Report;
use App\Site;
use App\User;
use Exception;
use phpDocumentor\Reflection\Types\Null_;

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

        $admins_count = User::where(['role' => 'ADMIN'])->count();

        return view('admin.users', [
            'users' => $users,
            'admins_count' => $admins_count,
            'users_count' => $users->toArray()['total'],
            'last_page' => $users->toArray()['last_page'],
            'current_page' => $users->toArray()['current_page'],
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

    public function showPosts()
    {
        $posts = Post::withTrashed()
            ->with(array('user' => function ($query) {
                $query->select('name');
            }))
            ->orderBy('created_at', 'DESC')
            ->paginate(30);

        return view('admin.posts', [
            'posts' => $posts,
            'posts_count' => $posts->toArray()['total'],
            'last_page' => $posts->toArray()['last_page'],
            'current_page' => $posts->toArray()['current_page'],
            'trashed_count' => Post::onlyTrashed()->count(),
        ]);
    }

    public function showAllReports()
    {
        $post_reports_count = Report::where(['reportable_type' => Post::class])->count();
        $user_reports_count = Report::where(['reportable_type' => User::class])->count();
        $comment_reports_count = Report::where(['reportable_type' => Comment::class])->count();
        $site_reports_count = Report::where(['reportable_type' => Site::class])->count();
        $trashed_reports_count = Report::onlyTrashed()->count();

        $all_reports_count = $post_reports_count + $user_reports_count + $comment_reports_count + $site_reports_count;

        return view('admin.report.all', [
            'post_reports_count' => $post_reports_count,
            'user_reports_count' => $user_reports_count,
            'comment_reports_count' => $comment_reports_count,
            'site_reports_count' => $site_reports_count,
            'all_reports_count' => $all_reports_count,
            'trashed_reports_count' => $trashed_reports_count,
        ]);
    }

    public function showPostReports(Post $post = null)
    {
        if ($post == null) {
            $reports = Report::where(['reportable_type' => Post::class])->paginate(30);
        } else {
            $reports = $post->reports()->paginate(30);
        }
        return view('admin.report.post', [
            'reports' => $reports,
            'reports_count' => $reports->toArray()['total'],
            'last_page' => $reports->toArray()['last_page'],
            'current_page' => $reports->toArray()['current_page'],
        ]);
    }

    public function deleteReport(Report $report)
    {
        try {
            $report->delete();
            return redirect()->back();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['msg' => __('errors.admin.Delete Report')]);
        }
    }

    public function showComments(Post $post = null)
    {
        if ($post == null) {
            $comments = Comment::with('user')
                ->orderBy('created_at', 'DESC')
                ->paginate(30);
        } else {
            $comments = $post->comments()->paginate(30);
        }
        return view('admin.comments', [
            'comments' => $comments,
            'comments_count' => $comments->toArray()['total'],
            'last_page' => $comments->toArray()['last_page'],
            'current_page' => $comments->toArray()['current_page'],
        ]);
    }

    public function deleteComment(Comment $comment)
    {
        try {
            $comment->delete();
            return redirect()->back();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['msg' => __('errors.admin.Delete Comment')]);
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
