<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use PharIo\Manifest\Author;

class PostController extends Controller
{
    /**
     * Show the application dashboard.
     */
    public function index(Request $request): View
    {
        if(isset($_GET["option"])) {
            $current_country = $_GET["option"];
        } else {
            $current_country = "USA";
        }
        $country = $request->input('option', "$current_country");

        $users = User::all();
        $authors = ($users->where('country', $country));
        $ids = ($users->where('country', $country))->pluck('id');

        $postsQuery = Post::whereIn('author_id', $ids);

        if($search = $request->input('search')) {
            $postsQuery = $postsQuery->where(function($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('content', 'like', '%' . $search . '%');
            });
        }

        $posts = $postsQuery->with('author', 'likes')
            ->withCount('comments', 'thumbnail', 'likes')
            ->latest()
            ->paginate(20);

//        if ($request->ajax()) {
//            return view('posts.partials.posts', ['posts' => $posts])->render();
//        }

//        return view('posts.index', [
//            'posts' => Post::search($posts, $request->input('q'))
//                ->with('author', 'likes')
//                ->withCount('comments', 'thumbnail', 'likes')
//                ->latest()
//                ->paginate(20)
//        ]);
        return view('posts.index', ['posts' => $posts, 'current_country' => $country]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Post $post): View
    {
        $post->comments_count = $post->comments()->count();
        $post->likes_count = $post->likes()->count();

        return view('posts.show', [
            'post' => $post
        ]);
    }
}
