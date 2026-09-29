<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $description }}">
    <title>{{ $pageTitle }} | {{ $projectName }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <script src="{{ asset('assets/js/script.js') }}" defer></script>
</head>
<body>
<a class="skip-link" href="#continut">Sari la conținut</a>

<div class="site-shell">
    @include('components.header')

    <main id="continut" class="site-main">
        @yield('content')
    </main>

    @include('components.footer')
</div>
</body>
</html>
