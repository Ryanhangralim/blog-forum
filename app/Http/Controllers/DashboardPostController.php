<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.posts.index', [
            'posts' => Post::where('user_id', auth()->user()->id)->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.posts.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => ['required', 'max:255'],
            'slug' => ['required', 'unique:posts'],
            'category_id' => ['required'],
            'image' => ['image', 'file', 'max:2048'],
            'body' => ['required']
        ]);

        //jika ada image yang diupload, masukkan path image
        if($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $validatedData['user_id'] = auth()->user()->id;
        //mengambil excerpt dari body tanpa tag
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);

        //masukkan data ke database
        Post::create($validatedData);

        return redirect('/dashboard/posts')->with('success', 'New post added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        if($post->author->id !== auth()->user()->id) {
            abort(403);
       }

        return view('dashboard.posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if($post->author->id !== auth()->user()->id) {
            abort(403);
       }
       
        return view('dashboard.posts.edit', [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $rules = [
            'title' => ['required', 'max:255'],
            'category_id' => ['required'],
            'image' => ['image', 'file', 'max:2048'],
            'body' => ['required']
        ];

        //jika mengganti slug
        if($request->slug != $post->slug){
            $rules['slug'] = ['required', 'unique:posts'];
        }
        
        $validatedData = $request->validate($rules);

        //jika ada image yang diupload, masukkan path image
        if($request->file('image')) {
            //hapus file gambar lama
            if($post->image != null)
            {
                Storage::delete($post->image);
            }
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        //mengambil is user yang mengupdate post
        $validatedData['user_id'] = auth()->user()->id;
        //mengambil excerpt dari body tanpa tag
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);

        //update data ke database
        Post::where('id', $post->id)->update($validatedData);

        return redirect('/dashboard/posts')->with('success', 'Post has been updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //hapus file gambar lama
        if($post->image != null)
        {
            Storage::delete($post->image);
        }
        Post::destroy($post->id);
        return redirect('/dashboard/posts')->with('success', 'Post has been deleted');
    }

}
