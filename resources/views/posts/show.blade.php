@extends('layouts.app')

@section('content')

    {{ dump($post->getReactions()) }}
  <x-card class="border-0">
    @if ($post->hasThumbnail())
      <x-slot:image>
        <img src="{{ $post->thumbnail->getUrl() }}" alt="{{ $post->thumbnail->name }}" class="card-img-top">
      </x-slot>
    @endif

    <h1>{{ $post->title }}</h1>

    <div class="mb-3">
      <small class="text-body-secondary">
        <a href="{{ route('users.show', $post->author) }}">
            {{ $post->author->fullname }}
        </a>
      </small>,

      <small class="text-body-secondary">@humanize_date($post->posted_at)</small>
    </div>

    <div class="post-content">
      {!! $post->content !!}
    </div>

    <div class="mt-3">
      @include('likes/_likes')
        <form action="{{ route("reactions.store", ['post' => $post]) }}" method="post">
            @csrf
            <button type="submit">show reactions</button>
        </form>
    </div>

        <form action=""></form>
  </x-card>

  @include ('comments/_list')
@endsection
