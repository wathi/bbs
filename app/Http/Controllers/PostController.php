<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostReply;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $posts = Post::paginate(20);
        $users = User::all();

        return view('posts.index', 
            ['posts' => $posts],  ['users' => $users],
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
        $validated = $request->validate([
            'title' => 'required|max:100',
            'content' => 'required',
        ]);

        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = Auth::id();
        $post->likes = 0;
        $post->save();
 
        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        return view('posts.show', [
            'post' => Post::findOrFail($id),
            'postReplies' => Post::find($id)->reply
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
