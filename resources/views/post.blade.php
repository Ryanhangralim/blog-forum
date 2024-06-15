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
                @endif

                <article class="my-3 fs-5">
                    {!! $post->body !!}
                </article>

                <a href="/posts" class="d-block mt-3">Back to Post</a>

                <div class="mt-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Comments</h4>
                        <button type="button" class="btn btn-primary  mb-4" data-bs-toggle="modal" data-bs-target="#commentModal">
                            Add Comment
                        </button>
                    </div>

                    {{-- ADD COMMENT MODAL --}}
                    <div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="commentModalLabel">Add Comment</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="/posts/{{ $post->slug }}" id="commentForm">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="commentContent" class="form-label">Comment</label>
                                            <textarea class="form-control @error('content') is-invalid @enderror" id="commentContent" name="content" rows="3" required>{{ old('content') }}</textarea>
                                            @error('content')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary">Comment</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(session()->has('success'))
                        <div class="alert alert-success col-lg-12" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(count($comments) > 0)
                        @foreach ($comments as $comment)
                            <div class="card mb-4" style="width: 100%;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $comment->content }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">By: {{ $comment->user->name }} ({{ $comment->created_at->diffForHumans() }})</h6>
                                    @include('partials.replies', ['replies' => $comment->children])
                                    <button type="button" class="btn btn-primary mb-4 addReply" data-bs-toggle="modal" data-bs-target="#commentModal" data-id="{{ $comment->id }}" data-slug="{{ $post->slug }}">
                                        Reply
                                    </button>                                    
                                    <a href="#" class="card-link">Another link</a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h7>No Comments Yet</h7>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

<script>
    $(document).ready(function() {
        $('.addReply').on('click', function() {
            var commentId = $(this).data('id');
            var postSlug = $(this).data('slug');
            var path = '/posts/' + postSlug + "/" + commentId;
            $('#commentForm').attr('action', path);
        });
    });
</script>

@push('scripts')
    <script>
        var commentModal = new bootstrap.Modal(document.getElementById('commentModal'));
        commentModal.show();
    </script>
@endpush
