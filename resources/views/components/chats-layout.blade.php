<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script
        src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
        crossorigin="anonymous"></script>
    </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;1,700&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="/styles.css">
    <style>
        .rainbow{
            animation: rainbow 2.5s linear;
            animation-iteration-count: infinite;
        }

        @keyframes rainbow-bg{
            100%,0%{
                background-color: rgb(255,0,0);
            }
            8%{
                background-color: rgb(255,127,0);
            }
            16%{
                background-color: rgb(255,255,0);
            }
            25%{
                background-color: rgb(127,255,0);
            }
            33%{
                background-color: rgb(0,255,0);
            }
            41%{
                background-color: rgb(0,255,127);
            }
            50%{
                background-color: rgb(0,255,255);
            }
            58%{
                background-color: rgb(0,127,255);
            }
            66%{
                background-color: rgb(0,0,255);
            }
            75%{
                background-color: rgb(127,0,255);
            }
            83%{
                background-color: rgb(255,0,255);
            }
            91%{
                background-color: rgb(255,0,127);
            }
        }

        @keyframes rainbow{
            100%,0%{
                color: rgb(255,0,0);
            }
            8%{
                color: rgb(255,127,0);
            }
            16%{
                color: rgb(255,255,0);
            }
            25%{
                color: rgb(127,255,0);
            }
            33%{
                color: rgb(0,255,0);
            }
            41%{
                color: rgb(0,255,127);
            }
            50%{
                color: rgb(0,255,255);
            }
            58%{
                color: rgb(0,127,255);
            }
            66%{
                color: rgb(0,0,255);
            }
            75%{
                color: rgb(127,0,255);
            }
            83%{
                color: rgb(255,0,255);
            }
            91%{
                color: rgb(255,0,127);
            }
        }
    </style>

    <!-- Scripts -->
    @livewireStyles
</head>

<body>
{{$slot}}
@livewireScripts


</body>

