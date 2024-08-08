<?php

namespace App\Http\Controllers;

use App\Models\Post;
//use App\Http\Resources\Post;
use App\Models\Reaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Tonysm\TurboLaravel\Http\MultiplePendingTurboStreamResponse;
use function Tonysm\TurboLaravel\dom_id;

class ReactionController extends Controller
{
    //
    public function store(Request $request, Post $post): MultiplePendingTurboStreamResponse
    {
        $user = auth()->user();

        $request->validate([
            'reaction' => 'required|string|max:255',
        ]);

        $reaction = Reaction::updateOrCreate(
            ['user_id' => $user->id, 'post_id' => $post->id],
            ['reaction' => $request->reaction]
        );

        if($reaction) {
            return response()->turboStream([
                response()->turboStream()->replace(dom_id($post, 'reaction'))->view('likes._like', ['post' => $post]),
                response()->turboStream()->update(dom_id($post, $request->reaction.'_count'), Str::of("&$request->reaction" . $post->getReactionCount("$request->reaction"))->toHtmlString())
            ]);
        }

        return redirect()->back()->with('success', 'Reaction added!');
    }

    public function destroy(Request $request, Post $post): MultiplePendingTurboStreamResponse
    {
        $reaction = Reaction::where('user_id', Auth::id())
            ->where('post_id', $post->id)
            ->where('reaction', $request->reaction)
            ->first();

        $array_responses = [];

        if($reaction){
            $reaction->delete();
            $ifexistreaction = $post->getReactionCount($request->reaction);

            if($ifexistreaction > 0){
                return response()->turboStream([
                    response()->turboStream()->replace(dom_id($post, 'reaction'))->view('likes._like', ['post' => $post]),
                    response()->turboStream()->update(dom_id($post, $request->reaction.'_count'), Str::of("&$request->reaction" . $post->getReactionCount("$request->reaction"))->toHtmlString())
                ]);
            } else {
                return response()->turboStream([
                    response()->turboStream()->replace(dom_id($post, 'reaction'))->view('likes._like', ['post' => $post]),
                    response()->turboStream()->remove(dom_id($post, $request->reaction.'_count'))
                ]);
            }
        }

        return redirect()->back()->with('success', 'Reaction deleted!');
    }
}
