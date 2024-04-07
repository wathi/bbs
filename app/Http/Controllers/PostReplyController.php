<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostReply;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class PostReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'content' => 'required',
        ]);

        $postReply = new PostReply;
        $postReply->content = $request->content;
        $postReply->user_id = Auth::id();
        $postReply->post_id = $post->id;
        $postReply->likes = 0;
        $postReply->save();

        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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

    public function like(Request $request, string $id)
    {
        // dd(Auth::user());

        $user = Auth::user();
        $user->postReplylike()->attach($id);
        
        $post_id = PostReply::find($id)->post_id;

        return redirect()->route('posts.show', $post_id);
    }

    public function unlike(Request $request, string $id)
    {
        
        $user = Auth::user();
        $user->postReplylike()->detach($id);

        $post_id = PostReply::find($id)->post_id;

        return redirect()->route('posts.show', $post_id);
    }
}
