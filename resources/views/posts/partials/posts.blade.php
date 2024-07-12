@foreach ($posts as $post)
    <div class="post">
        <!-- Відображення посту -->
        <h2>{{ $post->title }}</h2>
        <p>{{ $posts->content }}</p>
    </div>

@endforeach

{{ $posts->links() }}
