<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" value="{{ csrf_token() }}"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vue SPA Demo</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="border-t-4 border-indigo-500">
<div id="app">
    <app></app>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
