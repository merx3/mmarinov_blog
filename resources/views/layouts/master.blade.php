<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Marian Marinov">

    <title>{{ $title }}</title>

    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,800" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link href="css/main.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    @yield('extra_scripts')
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

@include('partials.navigation')

@include('partials.header')


<!-- Main Content -->
<div class="container">
    @yield('content')
</div>

@include('partials.footer')

<script src="js/main.min.js"></script>

@include('partials.google_analytics')

</body>

</html>
