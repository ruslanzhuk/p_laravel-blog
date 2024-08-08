@auth
    <x-turbo-frame :id="[$post, 'reaction']">
        <?php
            //$userReaction = $post->getReactionCount("&#128525;");
            $userReaction = $post->reactions->firstWhere('user_id', auth()->id());
            //dump($userReaction);
        ?>
        @if ($userReaction)
            <form id="reaction-form" action="{{ route('posts.reactions.destroy', $post) }}" method="POST" class="form-inline" data-turbo="true">
                @method('DELETE')
                @csrf

                <input type="hidden" name="reaction" value="{{ $userReaction->reaction }}" />
                <button type="submit" name="submit" class="btn btn-link p-0">
                    <span class="my_reaction">&{{ $userReaction->reaction }}</span>
                </button>
            </form>
        @else
            <form id="reaction-form" action="{{ route('posts.reactions.store', $post) }}" method="POST" class="form-inline" data-turbo="true">
                @csrf

                    <select name="reaction" id="reaction" onchange="this.form.submit()">
                        <option value="#128517;">&#128517;</option>
                        <option value="#128525;">&#128525;</option>
                        <option value="#128545;">&#128545;</option>
                        <option value="#128513;">&#128513;</option>
                        <option value="#129315;">&#129315;</option>
                        <option value="#128519;">&#128519;</option>
                        <option value="#129402;">&#129402;</option>
                        <option value="#129297;">&#129297;</option>
                        <option value="#129300;">&#129300;</option>
                        <option value="#128529;">&#128529;</option>
                        <option value="#129327;">&#129327;</option>
                        <option value="#128557;">&#128557;</option>
                        <option value="#129324;">&#129324;</option>
                        <option value="#128520;">&#128520;</option>
                        <option value="#129313;">&#129313;</option>
                    </select>
            </form>
        @endif
    </x-turbo-frame>
@else
    <i
        class="fa-regular ms-2 fa-heart"
        aria-hidden="true"
    ></i>
@endauth
