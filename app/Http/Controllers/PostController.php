<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostReply;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $posts = Post::all();

        return view('posts.index', 
            ['posts' => $posts],
        );

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {   
        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = $request->user()->id;
        $post->likes = 0;
        $post->save();

        // dd($request->all());

        return redirect()->route('posts.index');
    }

    public function storeReply(Request $request, Post $post): RedirectResponse
    {   

        $postReply = new PostReply;
        $postReply->content = $request->content;
        $postReply->user_id = $request->user()->id;
        $postReply->post_id = $post->id;
        $postReply->likes = 0;
        $postReply->save();

        // dd($request->all());
        // dd($request->content, $post->id);

        return redirect()->route('posts.show', $post->id);



    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        return view('posts.show', [
            'post' => Post::findOrFail($id),
            'postReplies' => Post::find($id)->postReply
        ]);
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
