@extends('layouts.main')

@section("container")

    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <h1 class="mb-3">{{ $post->title }}</h1>

                <p>By. <a href="/authors/{{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a> in <a href="/categories/{{ $post->category->slug }}"  class="text-decoration-none">{{ $post->category->name }}</a></p>

                {{-- jika post ada gambar --}}
                @if($post->image != null)
                <div style="max-height: 350px; overflow:hidden">
                    <img src="{{ asset('storage') ."/". $post->image }}" class="img-fluid" alt={{ $post-category->name }}>
                </div>
                @else 
                    <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" class="img-fluid" alt="{{ $post->category->name }}">
                @endif                {{-- !! digunakan agar tidak dilakukan html escape --}}

                <article class="my-3 fs-5">
                    {!! $post->body !!}
                </article>

                <a href="/posts" class="d-block mt-3">Back to Post</a>

                <form action="/posts/{{ $post->slug }}" method="POST">
                    @csrf
                    <div class="d-flex align-items-center justify-content-between mt-3">
                        <h4 class="mb-0">Comments</h4>
                        <button type="submit" class="btn btn-primary">Add Comment</button>
                    </div>
                    <div class="mt-3 mb-3">
                        <input type="text" class="form-control  @error('content') is-invalid @enderror" placeholder="Write a comment..." id="content" name="content" value="{{ old('content') }}" required autocomplete="off">
                        @error('content')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <input type="hidden" name="parent" value="">
                    <input type="hidden" name="user_id" value="1">
                </form>

                @if(session()->has('success'))
                <div class="alert alert-success col-lg-12" role="alert">
                  {{ session('success') }}
                </div>
                @endif

                @if(count($comments) > 0)
                <ul>
                    @foreach ($comments as $comment)
                    <div class="card mb-4" style="width: 100%;"> <!-- Adjust width and add bottom margin -->
                        <div class="card-body">
                            <h5 class="card-title">{{ $comment->content }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">By : {{ $comment->user->name }} ({{ $comment->created_at->diffForHumans()}})</h6>
                            @include('partials.replies', ['replies' => $comment->children])
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>
                    
                    @endforeach
                </ul>
                @else
                <h7>No Comments Yet</h7>
                @endif
            </div>
        </div>
    </div>



@endsection