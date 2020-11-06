<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ToDo App</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    </head>
    <body>
        <div class="w-100 h-100 d-flex flex-column justify-content-center align-items-center">
            <div class="text-center text-uppercase font-weight-bold display-4">
                Welcome to ToDo app, please
                @if (Route::has('login'))
                    <div class="">
                        @auth
                            <a href="{{ url('/home') }}" class="btn btn-success btn-lg btn-block">Go to home page</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-warning btn-lg btn-block">Login</a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </body>
</html>
