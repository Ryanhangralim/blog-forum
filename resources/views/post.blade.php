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

                <h4 class="mt-3">Comments</h4>

                @if(count($comments) > 0)
                <ul>
                    @foreach ($comments as $comment)
                    <li>
                    <div>
                        <b>{{ $comment->user->name }}</b>
                        <p>{{ $comment->content }}</p>
                        @include('partials.replies', ['replies' => $comment->children])
                    </div>
                    </li>
                    @endforeach
                </ul>
                @else
                <h7>No Comments Yet</h7>
                @endif
            </div>
        </div>
    </div>



@endsection