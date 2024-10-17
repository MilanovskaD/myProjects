<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = DB::table('comments')
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->join('blogs', function ($join) {
                $join->on('comments.commentable_id', '=', 'blogs.id')
                    ->where('comments.commentable_type', '=', 'App\\Models\\Blog');
            })
            ->leftJoin('comments as replies', 'replies.parent_id', '=', 'comments.id')
            ->select(
                'comments.id as comment_id',
                'comments.body as comment_body',
                'users.name as user_name',
                'blogs.title as blog_title',
                'replies.body as reply_body',
                'replies.id as reply_id',
                'replies.user_id as reply_user_id'
            )
            ->whereNull('comments.parent_id')
            ->orderBy('comments.id', 'asc')
            ->paginate(15);

        return view('comments.index', compact('comments'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('comments')->where('id', $id)->delete();

        return redirect()->route('comments.index')->with('status', 'Comment deleted successfully.');
    }
}
