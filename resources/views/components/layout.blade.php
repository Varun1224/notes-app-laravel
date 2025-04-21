<!-- See, now when we are using app.blade.php we do not need this file anymore so we can delete it -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        @session('message')
            <div class="success-message note-container">
                {{ session('message') }}
            </div>
        @endsession
        {{$slot}}
    </body>
</html>
