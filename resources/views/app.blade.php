<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" value="{{ csrf_token() }}" />

    <title>Agenda</title>

    <style>
        #fundo {
            background: linear-gradient(-30deg, #51565a 0%, #C3CFD9 100%);
            background-size: cover;
            min-height: 100vh;
        }
            *,*:before,*:after{
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-size: 1rem;
        }
    </style>

    <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet" />
</head>

<body id="fundo">
    <div id="app"></div>
    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
</body>

</html>