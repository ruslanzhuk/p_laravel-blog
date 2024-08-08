@extends('layouts.app')

@section('custom')

    <form class="selectForm" action="" method="get">
        <label for="option">Оберіть країну</label>
        <select name="option" id="option" onchange="autoSubmitForm()">
{{--            <?php--}}
{{--            if(isset($_GET["option"])) {--}}
{{--                ?>--}}
{{--            <option id="current_opt" value="{{ $_GET["option"] }}">{{ $_GET["option"] }}</option>--}}
{{--                <?php--}}
{{--            }--}}
{{--            ?>--}}
            <option value="USA">USA</option>
            <option value="Ukraine">Ukraine</option>
            <option value="Poland">Poland</option>
            <option value="Portuguie">Portuguie</option>
            <option value="Germany">Germany</option>
            <option value="Grecja">Grecja</option>
            <option value="Chine">Chine</option>
            <option value="Japan">Japan</option>
        </select>
    </form>
@endsection

@section('content')
  @include ('posts/_search_form')
  <x-turbo-frame id="posts">
    <div class="d-flex justify-content-between gap-3 mt-3">
      <div class="p-2">
        <h2>
          @if (filled(request('q')))
            {{ trans_choice('posts.search_results', $posts->count()) }}
          @else
            @lang('posts.last_posts')
          @endif
        </h2>
      </div>

      <div id="post" class="p-2">
        <a href="{{ route('posts.feed') }}" data-turbo="false">
          <x-icon name="rss" />
        </a>
      </div>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
      @each('posts/_post', $posts, 'post', 'posts/_empty')
    </div>

    <div class="d-flex justify-content-center">
      {{ $posts->links() }}
    </div>
  </x-turbo-frame>
@endsection
