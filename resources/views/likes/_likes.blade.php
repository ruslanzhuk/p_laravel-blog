@include('likes/_like')
<br />
<?php
    $userReaction = $post->reactions->firstWhere('user_id', auth()->id());
    $exist_reactions = $post->reactions->groupBy("reaction");
    foreach ($exist_reactions as $exist_reaction) {
        ?>
@auth
    <x-turbo-frame :id="[$post, 'reaction']" data-post-id="{{ $post->id }}">
    @if($userReaction && $userReaction->reaction == $exist_reaction[0]->reaction)
        <form class="reaction-form-delete" style="display: inline-block" id="reaction-form-<?=$exist_reaction[0]->reaction?>" action="{{ route('posts.reactions.destroy', $post) }}" method="POST" class="form-inline" data-turbo="true">
            @method('DELETE')
            @csrf

            <input type="hidden" name="reaction" value="{{ $userReaction->reaction }}" />
            <button type="submit" name="submit" class="btn btn-link p-0">
                <span id="{{ dom_id($post, $exist_reaction[0]->reaction . '_count') }}" class="my_reaction">&{{ $exist_reaction[0]->reaction }} {{ $post->getReactionCount($exist_reaction[0]->reaction) }}</span>
            </button>
        </form>
    @else
        <form id="reaction-form-<?=$exist_reaction[0]->reaction?>" action="{{ route('posts.reactions.store', $post) }}" method="POST" class="form-inline" data-turbo="true">
            @csrf

            <input type="hidden" name="reaction" value="<?=$exist_reaction[0]->reaction?>" />
            <button onclick="this.form.submit()" style="padding: 2px; border: none; border-radius: 5px; margin: 2px; background: rgba(0, 190, 250, 0.5)">
                <span id="{{ dom_id($post, $exist_reaction[0]->reaction . '_count') }}" style="cursor: pointer;">&<?=$exist_reaction[0]->reaction?> {{ $post->getReactionCount($exist_reaction[0]->reaction) }}</span>
            </button>
        </form>
    @endif
    </x-turbo-frame>
@else
    <span id="{{ dom_id($post, $exist_reaction[0]->reaction . '_count') }}" style="cursor: pointer;">&<?=$exist_reaction[0]->reaction?> {{ $post->getReactionCount($exist_reaction[0]->reaction) }}</span>
@endauth
    <?php
    }
?>

