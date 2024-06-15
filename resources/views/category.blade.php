@extends('layouts.main')

@section('container')    
<h1 class="mb-5">Post Category: {{ $category }}</h1>

<div class="row justify-content-center mb-3">
  <div class="col-md-6">
    <form action="/categories/{{ $slug }}" method="GET">
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Search.." name="search" autocomplete="off" value="{{ request('search') }}">
        <button class="btn btn-danger" type="submit" >Search</button>
      </div>
    </form>
  </div>
</div>

@if ($posts->count())
<div class="container">
    <div class="row">
        @foreach ($posts as $post)
        <div class="col-md-4 mb-3">
            <div class="card">
                <img src="https://source.unsplash.com/500x400?{{ $post->category->name }}" class="card-img-top" alt="{{ $post->category->name }}">
                <div class="card-body">
                  <h5 class="card-title"><a href="/posts/{{ $post->slug }}" class="text-decoration-none text-dark">{{ $post->title }}</a></h5>
                  <p>
                    <small class="text-muted">
                        By. <a href="/authors/{{ $post->author->username }}"  class="text-decoration-none">{{ $post->author->name }}</a> {{ $post->created_at->diffForHumans() }}
                    </small>
                    </p>
                  <p class="card-text">{{ $post->excerpt }}</p>
                  <a href="/posts/{{ $post->slug }}" class="btn btn-primary">Read more</a>
                </div>
              </div>
        </div>
        @endforeach
    </div>
</div>

@else 
<p class="text-center fs-4">No post found</p>
@endif


<div class="d-flex justify-content-end">
  {{ $posts->links() }}
</div>

@endsection
