<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostReplyController extends Controller
{

        /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //       
    }
    
    public function store(Request $request): RedirectResponse
    {   
        $postreply = new PostReply;
        $postreply->content = $request->content;
        $postreply->user_id = 1;
        $postreply->likes = 0;
        $postreply->save();

        // dd($request->all());

        return redirect()->route('posts.index');
    }
}
