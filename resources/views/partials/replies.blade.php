@foreach ($replies as $reply)
    <div style="margin-left: 20px;">
        <b>{{ $reply->user->name }}</b>
        <p>{{ $reply->content }}</p>
        @include('partials.replies', ['replies' => $reply->children])
    </div>
@endforeach
