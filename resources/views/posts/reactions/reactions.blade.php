@extends("layouts.app")

@section("custom")
    @foreach ($post->reactions as $reaction)
        <p>{{ $reaction->user->name }} reacted with {{ $reaction->emoji }}</p>
    @endforeach
@endsection

