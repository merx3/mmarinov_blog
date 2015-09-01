<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Laravel and PhP blog</title>

    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,800" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link href="css/main.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

<!-- Navigation -->
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand page-scroll" href="#page-top">
                Marian Marinov
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
            <ul class="nav navbar-nav">
                <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
                </li>
                <li>
                    <a class="page-scroll" href="/">Posts</a>
                </li>
                <li>
                    <a href="about">About</a>
                </li>
                <li>
                    <a href="contact">Contact Me</a>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<!-- Page Header -->
<!-- Set your background image for this header on the line below. -->
<header class="intro-header" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('images/contact-bg.jpg'); background-position: 0 68%; background-size: 100% auto;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="site-heading">
                    <h1>Contact me</h1>
                </div>
            </div>
        </div>
    </div>
</header>



<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <p>If you would like to get in contact with me, you can do that by sending me an e-mail or filling out this form:</p>

            {!! Form::open(['url' => 'contact', 'name' => 'sendMessage', 'id' => 'contactForm']) !!}
                <div class="row control-group" style="color: #000000; display: none">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <input type="text" class="form-control" placeholder="If you're a bot, write here" id="favourite_color" name="favourite_color">
                    </div>
                </div>
                <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        {!! Form::label('Name') !!}
                        {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control', 'placeholder' => 'Name', 'required', 'data-validation-required-message' => 'Please enter your name.']); !!}
                        {{--<input type="text" class="form-control" placeholder="Name" id="name" required data-validation-required-message="Please enter your name.">--}}
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        {!! Form::label('email', 'Email Address') !!}
                        <input type="email" class="form-control" placeholder="Email Address" id="email" required data-validation-required-message="Please enter your email address.">
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                {{--<div class="row control-group">--}}
                    {{--<div class="form-group col-xs-12 floating-label-form-group controls">--}}
                        {{--<label>Phone Number</label>--}}
                        {{--<input type="tel" class="form-control" placeholder="Phone Number" id="phone" required data-validation-required-message="Please enter your phone number.">--}}
                        {{--<p class="help-block text-danger"></p>--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label>Message</label>
                        <textarea rows="5" class="form-control" placeholder="Message" id="message" required data-validation-required-message="Please enter a message."></textarea>
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <br>
                <div id="success"></div>
                <div class="row">
                    <div class="form-group col-xs-12">
                        <button id="btn_contact_submit" type="submit" class="btn btn-default">Send</button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>


<footer>
    <div class="container text-center">
        <ul class="list-inline text-center">
            <li>
                <a href="https://bg.linkedin.com/pub/marian-marinov/77/586/b34">
                                <span class="fa-stack fa-lg contact-icon">
                                    <i class="linkedin-custom"></i>
                                </span>
                </a>
            </li>
            <li>
                <a href="mailto:marian.mmarinov@gmail.com">
                                <span class="fa-stack fa-lg contact-icon">
                                    <i class="mail-custom"></i>
                                </span>
                </a>
            </li>
            <li>
                <a href="https://github.com/merx3">
                                <span class="fa-stack fa-lg contact-icon">
                                    <i class="github-custom"></i>
                                </span>
                </a>
            </li>
        </ul>
        <p class="copyright text-muted">Copyright &copy; 2015 · Marian Marinov's Blog</p>
    </div>
</footer>

<!-- Google Maps API Key - Use your own API key to enable the map feature. More information on the Google Maps API can be found at https://developers.google.com/maps/ -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRngKslUGJTlibkQ3FkfTxj3Xss1UlZDA&sensor=false"></script>

<!-- Custom Theme JavaScript -->
<script src="js/main.min.js"></script>

</body>

</html>
