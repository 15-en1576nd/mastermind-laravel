<html>
    <head>
        <title>App Name - @yield('title')</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="@yield('description')">
        <meta name="robots" content="@yield('robots')">
        <link rel="stylesheet" href=" {{ asset('css/app.css') }} ">
        <script src="{{ asset('js/app.js') }}"></script>
        <link href="https://pro.fontawesome.com/releases/v5.13.1/css/all.css" rel="stylesheet">
    </head>
    <body>
        <x-nav />
        @yield('content')
    </body>
</html>
