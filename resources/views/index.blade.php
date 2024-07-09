<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Restaurant">
    <meta name="author" content="Trung">
    <title>Harmorny - Coffee and Restaurant</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="../img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72"
        href="../img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114"
        href="../img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144"
        href="../img/apple-touch-icon-144x144-precomposed.png">

    <!-- BASE CSS -->
    <link href="{{ asset('css/vendors.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <!-- SPECIFIC CSS -->
    <link href="{{ asset('css/flex_slider.css') }}" rel="stylesheet">
    <link href="{{ asset('css/wizard.css') }}" rel="stylesheet">

    <!-- SPECIFIC CSS -->
    <link href="{{ asset('css/shop.css') }}" rel="stylesheet">
    <!-- SPECIFIC CSS -->
    <link href="{{ asset('css/blog.css') }}" rel="stylesheet">
    {{-- @vite('resources/css/app.css') --}}
</head>

<body>

    <div id="app"></div>

    <!-- COMMON SCRIPTS -->
    <script src="{{ asset('js/common_scripts.min.js') }}"></script>
    <script src="{{ asset('js/jquery.flexslider.js') }}"></script>
    <script src="{{ asset('js/slider_func.js') }}"></script>
    <script src="{{ asset('js/common_func.js') }}"></script>

    <!-- SPECIFIC SCRIPTS (wizard form) -->
    <script src="{{ asset('js/wizard/wizard_scripts.min.js') }}"></script>
    <script src="{{ asset('js/wizard/wizard_func.js') }}"></script>

    <!-- SPECIFIC SCRIPTS -->
    <script src="{{ asset('js/specific_shop.js') }}"></script>
    <script src="{{ asset('js/sticky_sidebar.min.js') }}"></script>
    {{-- js --}}
    @vite('resources/js/app.js')
</body>

</html>
