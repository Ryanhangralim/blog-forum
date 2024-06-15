@foreach ($replies as $reply)
    <div style="margin-left: 20px;">
        <h5 class="card-title">{{ $reply->content }}</h5>
        <h6 class="card-subtitle mb-2 text-muted">By : {{ $reply->user->name }}  ({{ $reply->created_at->diffForHumans()}})</h6>
        @include('partials.replies', ['replies' => $reply->children])
    </div>
@endforeach
