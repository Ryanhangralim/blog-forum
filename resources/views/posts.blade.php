@extends('layouts.main')

@section('container')    
    <h1 class="mb-3 text-center">All Posts</h1>

  <div class="row justify-content-center mb-3">
    <div class="col-md-6">
      <form action="/posts" method="GET">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Search.." name="search" autocomplete="off" value="{{ request('search') }}">
          <button class="btn btn-danger" type="submit" >Search</button>
        </div>
      </form>
    </div>
  </div>

    @if ($posts->count())
    <div class="card mb-3">
          {{-- jika post ada gambar --}}
          @if($posts[0]->image != null)
          <div style="max-height: 400px; overflow:hidden">
              <img src="{{ asset('storage') ."/". $posts[0]->image }}" class="img-fluid" alt="{{ $posts[0]->category->name }}">
          </div>
          @else 
            <img src="https://source.unsplash.com/1200x400?{{ $posts[0]->category->name }}" class="card-img-top" alt="{{ $posts[0]->category->name }}">
          @endif
        <div class="card-body text-center">
          <h3 class="card-title"><a class="text-decoration-none text-dark" href="/posts/{{ $posts[0]->slug }}">{{ $posts[0]->title }}</a></h3>
          <p>
            <small class="text-muted">
                By. <a href="/authors/{{ $posts[0]->author->username }}"  class="text-decoration-none">{{ $posts[0]->author->name }}</a> in <a href="/categories/{{ $posts[0]->category->slug }}"  class="text-decoration-none">{{ $posts[0]->category->name }}</a> {{ $posts[0]->created_at->diffForHumans() }}
            </small>
            </p>
          <p class="card-text">{{ $posts[0]->excerpt }}</p>

          <a href="/posts/{{ $posts[0]->slug }}"  class="text-decoration-none btn btn-primary">Read more</a>
        </div>
      </div>

    <div class="container">
        <div class="row">
            @foreach ($posts->skip(1) as $post)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="position-absolute px-3 py-2" style="background-color: rgba(0, 0, 0, 0.7)"><a href="/categories/{{ $post->category->slug }}" class="text-white text-decoration-none">{{ $post->category->name }}</a></div>
                      {{-- jika post ada gambar --}}
                      @if($post->image != null)
                          <img src="{{ asset('storage') ."/". $post->image }}" class="img-fluid" alt="{{ $post->category->name }}">
                      @else 
                          <img src="https://source.unsplash.com/500x400?{{ $post->category->name }}" class="card-img-top" alt="{{ $post->category->name }}">
                      @endif
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
