<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {   
        return view('posts', [
            "title" => "All Posts",
            // "posts" => Post::all()
            "posts" => Post::latest()->filter(request(['search']))->paginate(7)
        ]);
    }

    public function show(Post $post){
        
        // Fetch all comments for the post in a single query
        $comments = $post->comments()->with('replies')->get();

        // Organize comments by parent_id
        $commentsByParentId = $comments->groupBy('parent_id');

        // Create a recursive function to organize replies
        $buildTree = function ($parentId = null) use ($commentsByParentId, &$buildTree) {
            return $commentsByParentId->get($parentId, collect())->map(function ($comment) use ($buildTree) {
                $comment->children = $buildTree($comment->id);
                return $comment;
            });
        };

        return view('post', [
            "title" => "Single Post",
            "post" => $post,
            'comments' => $buildTree()
        ]);
    }
}
