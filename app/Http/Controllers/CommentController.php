<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
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
        $validatedData = $request->validate([
            'content' => ['required'],
        ]); 

        $validatedData['post_id'] = $post->id;
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['parent_id'] = $request->comment_id;

        //insert to database
        Comment::create($validatedData);

        //cek jika komen asli atau reply
        if($validatedData['parent_id']){
            return redirect("/posts/{$post->slug}")->with('success', 'Reply added');
        }
        else{
            return redirect("/posts/{$post->slug}")->with('success', 'Comment added');
        }
    }

    public function store_reply(Request $request, Post $post, Comment $comment)
    {
        $validatedData = $request->validate([
            'content' => ['required'],
        ]); 

        $validatedData['post_id'] = $post->id;
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['parent_id'] = $comment->id;

        //insert to database
        Comment::create($validatedData);

        return redirect("/posts/{$post->slug}")->with('success', 'Reply added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comments)
    {
        //
    }
}
