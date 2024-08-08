@extends('layouts.main')

@section('content')
<h1>{{ $title }}</h1>

<form id="jakas_form" action="{{ route("cos.contact.store") }}" method="POST" class="form-inline" data-turbo="true">
    @csrf
    <input type="text" name="klaymore" />
    <button type="submit" name="submit" class="mt-4">submit</button>
</form>

@endsection

