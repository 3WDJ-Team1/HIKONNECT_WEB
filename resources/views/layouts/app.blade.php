<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <script type="text/javascript"
        src='https://maps.googleapis.com/maps/api/js?key=AIzaSyBAxuXFnvSopsfKoJjoXKXnm-BnjNdzAYk&libraries=drawing'
        async defer></script>
</head>
<body>
    <div id="app">
    </div>
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            'host'      => env('APP_URL')
        ]); ?>;
    </script>
    <script src="{{ asset('js/app.js') }}"></script>  
</body>
<style>
    #app{
        width: 100%;
    }
</style>
</html>
