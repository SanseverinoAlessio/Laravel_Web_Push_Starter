<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}"></meta>
    <link rel="manifest" href="{{url("/manifest.json")}}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="{{ env('APP_NAME') }}">
    <link rel="apple-touch-icon" href="/icons/icon-192.png">
    <title>Push Notifications</title>

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

</head>

<body>
    <div class="container-fluid">
        @yield('content')
    </div>
</body>

</html>
