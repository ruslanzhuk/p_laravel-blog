<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/assets/main.css">
    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite([
        'resources/sass/app.scss',
        'resources/js/app.js'
    ])
    @stack('inline-scripts')
</head>

<body id="body" class="d-flex flex-column vh-100">
    @include('shared/navbar')

    <div class="container flex-grow-1">
        @include('shared/alerts')

        <main class="my-4">
            @yield('custom')
            @yield('content')
        </main>
    </div>

    @include('shared/footer')
</body>
<script type="text/javascript" src="scripts/custom.js"></script>
</html>
