<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    //
    public function add_like(Comment $comment, Request $request)
    {
        $data = [];
        $data['comment_id'] = $comment->id;
        $data['user_id'] = auth()->user()->id;

        //insert to database
        Like::create($data);

        return redirect("/posts/{$request->post_comment}");
    }
}
