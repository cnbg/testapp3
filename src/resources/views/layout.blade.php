<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - @yield('title')</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @stack('style')
</head>
<body>
@yield('content')
<script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
@stack('script')
</body>
</html>
