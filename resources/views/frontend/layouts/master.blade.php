<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Template</title>
    <link rel="shortcut icon" href="{{Config::get('app.url') . '/public/backend/images/logo/favicon.ico'}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{Config::get('app.url').'/public/css/app.css'}}">
    <link rel="stylesheet" href="{{Config::get('app.url').'/public/css/flag-icon.css'}}">
    <link href="{{Config::get('app.url').'/public/dashboard/styles/shards-dashboards.1.1.0.min.css'}}" rel="stylesheet">
    <link rel="stylesheet" href="{{Config::get('app.url').'/public/dashboard/styles/extras.1.1.0.min.css'}}">
    <script src="{{Config::get('app.url').'/public/js/buttons.js'}}"></script>
    <link rel="stylesheet" href="{{Config::get('app.url').'/public/css/vue-multiselect.min.css'}}">
    @include('frontend.layouts.js_variable')
</head>

<body>
    <div class="container-fluid" id="app"></div>
    
    <script src="{{Config::get('app.url').'/public/js/frontend_app.js'}}"></script>
    <script src="{{Config::get('app.url').'/public/js/jquery-3.5.1.min.js'}}"></script>
    <script src="{{Config::get('app.url').'/public/dashboard/scripts/Chart.min.js'}}"></script>
    <script src="{{Config::get('app.url').'/public/dashboard/scripts/shards-dashboards.1.1.0.min.js'}}"></script>
    <script src="{{Config::get('app.url').'/public/js/jquery.sharrre.min.js'}}"></script>
    <script src="{{Config::get('app.url').'/public/dashboard/scripts/extras.1.1.0.min.js'}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
   
</body>

</html>