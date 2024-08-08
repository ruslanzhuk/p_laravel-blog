@include('likes/_like')
<br />
<?php
    $exist_reactions = $post->reactions->groupBy("reaction");
    foreach ($exist_reactions as $exist_reaction) {
        ?>
        <span id="{{ dom_id($post, $exist_reaction[0]->reaction . '_count') }}">&<?=$exist_reaction[0]->reaction?> {{ $post->getReactionCount($exist_reaction[0]->reaction) }}</span>
<?php
    }
?>
{{--{{ dump($post->reactions->groupBy("reaction")) }}--}}
{{--{{ dump($post->reactions->groupBy("reaction")->count()) }}--}}
{{--<span id="{{ dom_id($post, '#128517;_count') }}">&#128517; {{ $post->getReactionCount('#128517;') }}</span>--}}
{{--<span id="{{ dom_id($post, '#128513;_count') }}">&#128513; {{ $post->getReactionCount('#128513;') }}</span>--}}
{{--<span id="{{ dom_id($post, '#129315;_count') }}">&#129315; {{ $post->getReactionCount('#129315;') }}</span>--}}
{{--<span id="@domid($post, 'likes_count')">{{ $post->likes_count }}</span>--}}

