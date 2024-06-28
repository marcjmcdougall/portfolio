<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->


        <!-- Styles -->
        @vite(['resources/css/index.css'])
    </head>
    <body class="antialiased">
        <div>
            <h1>Welcome to my new portfolio</h1>
        </div>

        @vite(['resources/js/app.js'])
    </body>
</html>
