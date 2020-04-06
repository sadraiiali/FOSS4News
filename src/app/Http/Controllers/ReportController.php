<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReportRequest;
use App\Post;
use App\Report;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new Report for Post.
     *
     * @param Post $post
     * @return Factory|View
     */
    public function create(Post $post)
    {
        return view('posts.report', ['post' => $post]);
    }

    /**
     * Store a newly created Report in storage.
     *
     * @param Post $post
     * @param CreateReportRequest $request
     * @return Factory|View
     */
    public function store(Post $post, CreateReportRequest $request)
    {

        try {
            $post->reports()->create([
                'user_id' => Auth::user()->id,
                'reason' => $request->reason,
                'body' => $request->body
            ]);
            return view('posts.report_success');
        } catch (Exception $e) {
            return view('posts.report', ['post' => $post, 'error' => true]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Report $report
     * @return Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Report $report
     * @return Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Report $report
     * @return Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Report $report
     * @return Response
     */
    public function destroy(Report $report)
    {
        //
    }
}
