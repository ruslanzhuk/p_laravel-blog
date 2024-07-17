@if($post->comments_type == "none")
    <x-alert type="warning">
        @lang('comments.comments_are_disabled')
    </x-alert>
@else
    @auth
        @if($post->comments_type == "everyone" || ($post->comments_type == "compatriots" && $post->author->country == Auth::user()->country))
            <form id="comments_form" action="{{ route('comments.store') }}" method="POST" data-turbo="true">
                @csrf

                <input type="hidden" name="post_id" value="{{ $post->id }}">

                <div class="form-group mb-3">
                <textarea
                    name="content"
                    id="content"
                    cols="50"
                    rows="3"
                    @class(['form-control', 'is-invalid' => $errors->has('content')])
                    placeholder="@lang('comments.placeholder.content')"
                    required
                >{{ old('content', $comment ?? null) }}</textarea>

                    @error('content')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3 text-end">
                    <button type="submit" class="btn btn-primary">
                        <x-icon name="paper-plane" />

                        @lang('comments.comment')
                    </button>
                </div>
            </form>
        @else
            <x-alert type="warning">
                @lang('comments.comments_are_able_only') {{ $post->author->country }}.
            </x-alert>
        @endif
    @else
        @if($post->comments_type == "everyone")
            <form id="comments_form" action="{{ route('comments.store') }}" method="POST" data-turbo="true">
                @csrf

                <input type="hidden" name="post_id" value="{{ $post->id }}">
                @if (!Auth::check())
                    <div class="form-group mb-3">
                        <label for="guest_name">Name</label>
                        <input type="text" class="form-control" id="guest_name" name="guest_name" required>
                    </div>
                @endif
                <div class="form-group mb-3">
                <textarea
                    name="content"
                    id="content"
                    cols="50"
                    rows="3"
                    @class(['form-control', 'is-invalid' => $errors->has('content')])
                    placeholder="@lang('comments.placeholder.content')"
                    required
                >{{ old('content', $comment ?? null) }}</textarea>

                    @error('content')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3 text-end">
                    <button type="submit" class="btn btn-primary">
                        <x-icon name="paper-plane" />

                        @lang('comments.comment')
                    </button>
                </div>
            </form>
        @elseif($post->comments_type == "compatriots")
            <x-alert type="warning">
                @lang('comments.sign_in_to_comment')
            </x-alert>
        @endif
    @endauth
@endif

{{--@auth--}}
{{--    @if($post->comments_type != "none")--}}
{{--        @if($post->comments_type == "everyone" || ($post->comments_type == "compatriots" && $post->author->country == Auth::user()->country))--}}
{{--            <form id="comments_form" action="{{ route('comments.store') }}" method="POST" data-turbo="true">--}}
{{--                @csrf--}}

{{--                <input type="hidden" name="post_id" value="{{ $post->id }}">--}}

{{--                <div class="form-group mb-3">--}}
{{--                <textarea--}}
{{--                    name="content"--}}
{{--                    id="content"--}}
{{--                    cols="50"--}}
{{--                    rows="3"--}}
{{--                    @class(['form-control', 'is-invalid' => $errors->has('content')])--}}
{{--                    placeholder="@lang('comments.placeholder.content')"--}}
{{--                    required--}}
{{--                >{{ old('content', $comment ?? null) }}</textarea>--}}

{{--                    @error('content')--}}
{{--                    <span class="invalid-feedback">{{ $message }}</span>--}}
{{--                    @enderror--}}
{{--                </div>--}}

{{--                <div class="form-group mb-3 text-end">--}}
{{--                    <button type="submit" class="btn btn-primary">--}}
{{--                        <x-icon name="paper-plane" />--}}

{{--                        @lang('comments.comment')--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        @else--}}
{{--            <x-alert type="warning">--}}
{{--                @lang('comments.comments_are_able_only') {{ $post->author->country }}.--}}
{{--            </x-alert>--}}
{{--        @endif--}}
{{--    @else--}}
{{--        <x-alert type="warning">--}}
{{--            @lang('comments.comments_are_disabled')--}}
{{--        </x-alert>--}}
{{--    @endif--}}
{{--@else--}}
{{--    @if($post->comments_type == "everyone")--}}
{{--        <form id="comments_form" action="{{ route('comments.store') }}" method="POST" data-turbo="true">--}}
{{--            @csrf--}}

{{--            <input type="hidden" name="post_id" value="{{ $post->id }}">--}}
{{--            @if (!Auth::check())--}}
{{--                <div class="form-group mb-3">--}}
{{--                    <label for="guest_name">Name</label>--}}
{{--                    <input type="text" class="form-control" id="guest_name" name="guest_name" required>--}}
{{--                </div>--}}
{{--            @endif--}}
{{--            <div class="form-group mb-3">--}}
{{--                <textarea--}}
{{--                    name="content"--}}
{{--                    id="content"--}}
{{--                    cols="50"--}}
{{--                    rows="3"--}}
{{--                    @class(['form-control', 'is-invalid' => $errors->has('content')])--}}
{{--                    placeholder="@lang('comments.placeholder.content')"--}}
{{--                    required--}}
{{--                >{{ old('content', $comment ?? null) }}</textarea>--}}

{{--                @error('content')--}}
{{--                <span class="invalid-feedback">{{ $message }}</span>--}}
{{--                @enderror--}}
{{--            </div>--}}

{{--            <div class="form-group mb-3 text-end">--}}
{{--                <button type="submit" class="btn btn-primary">--}}
{{--                    <x-icon name="paper-plane" />--}}

{{--                    @lang('comments.comment')--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    @elseif($post->comments_type == "compatriots")--}}
{{--        <x-alert type="warning">--}}
{{--            @lang('comments.sign_in_to_comment')--}}
{{--        </x-alert>--}}
{{--    @else--}}
{{--        <x-alert type="warning">--}}
{{--            @lang('comments.comments_are_disabled')--}}
{{--        </x-alert>--}}
{{--    @endif--}}
{{--@endauth--}}
