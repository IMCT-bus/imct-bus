<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link type="image/png" sizes="16x16" rel="icon" href="{{asset('icons8-bus-papercut-16.png')}}">
    <link type="image/png" sizes="32x32" rel="icon" href="{{asset('icons8-bus-papercut-32.png')}}">
    <link type="image/png" sizes="96x96" rel="icon" href="{{asset('icons8-bus-papercut-96.png')}}">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    @inertiaHead
    @routes
    @vite(['resources/js/app.js', "resources/js/pages/{$page['component']}.vue", 'resources/css/app.scss'])
</head>
<body>
    @inertia
</body>
</html>
