@foreach ($replies as $reply)
    <div style="margin-left: 20px;">
        <h5 class="card-title">{{ $reply->content }}</h5>
        <h6 class="card-subtitle mb-2 text-muted">By : {{ $reply->user->name }}  ({{ $reply->created_at->diffForHumans()}})</h6>
        <button type="button" class="btn btn-secondary mb-2 addReply" data-bs-toggle="modal" data-bs-target="#commentModal" data-id="{{ $reply->id }}">
            <i class="bi bi-reply-fill"></i>
        </button>                                    
        <button type="button" class="btn btn-danger mb-2 addReply" data-bs-toggle="modal" data-bs-target="#commentModal" data-id="{{ $reply->id }}">
            <i class="bi bi-heart-fill"></i>
        </button>
        @include('partials.replies', ['replies' => $reply->children])
    </div>
@endforeach
