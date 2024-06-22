@foreach ($replies as $reply)
    <div class="card mb-2" style="margin-left: 20px;">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h5 class="card-title">{{ $reply->content }}</h5>
                <h6 class="card-subtitle mb-2 text-muted">By: {{ $reply->user->name }} ({{ $reply->created_at->diffForHumans() }})</h6>
                <h6 class="card-subtitle mb-2 text-muted">Likes: {{ $reply->like_count() }}</h6>
            </div>
            <div class="d-flex align-items-center">
                <!-- Reply button -->
                <button type="button" class="btn btn-secondary mb-2 me-2 addReply" data-bs-toggle="modal" data-bs-target="#commentModal" data-id="{{ $reply->id }}">
                    <i class="bi bi-reply-fill"></i> Reply
                </button>
                <!-- Like button -->
                <form method="POST" action="/comments/{{ $reply->id }}" id="likeForm-{{ $reply->id }}" class="mb-2">
                    @csrf
                    <input type="hidden" name="post_comment" value="{{ $post->slug }}">
                    <button type="submit" class="btn {{ $reply->getIsLikedAttribute() ? 'btn-danger disabled' : 'btn-danger' }} addReply">
                        <i class="bi bi-heart-fill"></i> Like
                    </button>
                </form>
            </div>
        </div>
        @include('partials.replies', ['replies' => $reply->children])
    </div>
@endforeach
