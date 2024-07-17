<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentsRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Tonysm\TurboLaravel\Http\MultiplePendingTurboStreamResponse;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentsRequest $request): MultiplePendingTurboStreamResponse
    {

        $post = Post::find($request->input('post_id'));

        if ($post->comments_type === 'everyone' && !Auth::check()) {
            $comment = Comment::create([
                'post_id' => $request->input('post_id'),
                'content' => $request->input('content'),
                'guest_name' => $request->input('guest_name'),
                'author_id' => 1001
            ]);
        } else {
            $comment = Auth::user()->comments()->create($request->validated());
        }

        return response()->turboStream([
            response()->turboStream()->prepend('comments')->view('comments._comment', ['comment' => $comment]),
            response()->turboStream()->replace('comments_form')->view('comments._form', ['post' => $comment->post]),
            response()->turboStream()->update('comments_count', trans_choice('comments.count', $comment->post->comments()->count()))
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment): MultiplePendingTurboStreamResponse
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return response()->turboStream([
            response()->turboStream()->remove($comment),
            response()->turboStream()->update('comments_count', trans_choice('comments.count', $comment->post->comments()->count()))
        ]);
    }
}
