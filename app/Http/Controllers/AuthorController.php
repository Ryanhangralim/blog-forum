<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function show(User $author){
        $name = $author->name;
    return view("authors", [
        "title" => $name . "'s Posts",
        "username" => $author->username,
        "posts" => $author->posts()->filter(request(['search']))->paginate(6),
        "author_name" => $name
    ]);
    }
}
