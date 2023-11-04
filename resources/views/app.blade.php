<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    @inertiaHead
    @routes
    @vite(['resources/js/app.js', "resources/js/pages/{$page['component']}.vue", 'resources/css/app.scss'])
</head>
<body>
    @inertia
</body>
</html>