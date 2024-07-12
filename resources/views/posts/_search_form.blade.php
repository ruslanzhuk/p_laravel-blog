<form
  id="search_form"
  action="{{ route('home') }}"
  method="GET"
  class="d-flex gap-2"
  data-turbo="true"
  data-turbo-frame="posts"
  data-turbo-action="advance"
>
  <div class="input-group">
      <input type="hidden" name="option" value="<?php if(isset($_GET["option"])) { echo $_GET["option"]; } else { echo "USA"; } ?>">
    <input
        type="text"
        id="search"
        name="search"
        class="form-control"
        placeholder="@lang('posts.search')"
        value="{{ request('search') }}"
    >
  </div>
</form>
