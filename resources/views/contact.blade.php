@extends('layouts.master')

@section('extra_scripts')
    <script type="text/javascript">
        var recaptchaId;

        var onloadCallback = function() {
            recaptchaId = grecaptcha.render('recaptcha', {
                'sitekey': '6LcSoAwTAAAAAAF2NpXd8s-RkUWjt1wlLiDrZnp_',
                'theme': 'light'
            });
        }
    </script>
@stop

@section('content')
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
                    {!! Form::email('email', null, ['id' => 'email', 'class' => 'form-control', 'placeholder' => 'Email Address', 'required', 'data-validation-required-message' => 'Please enter your email address.']); !!}
                    <p class="help-block text-danger"></p>
                </div>
            </div>
            <div class="row control-group">
                <div class="form-group col-xs-12 floating-label-form-group controls">
                    {!! Form::label('Message') !!}
                    {!! Form::textarea('message', null, ['rows' => 5, 'id' => 'message', 'class' => 'form-control', 'placeholder' => 'Message', 'required', 'data-validation-required-message' => 'Please enter a message.']); !!}
                    <p class="help-block text-danger"></p>
                </div>
            </div>
            <br>
            <div class="row control-group">
                {{--<div class="form-group col-xs-12 controls g-recaptcha" data-sitekey="6LcSoAwTAAAAAAF2NpXd8s-RkUWjt1wlLiDrZnp_"></div>--}}
                <div id="recaptcha"></div>
            </div>
            <br>
            <div id="success"></div>
            <div class="row">
                <div class="form-group col-xs-12 submit-button">
                    {!! Form::submit('Send', ['id' => 'btn_contact_submit', 'class' => 'btn btn-default']) !!}
                </div>
            </div>
            {!! Form::close() !!}
            <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
                    async defer>
            </script>
        </div>
    </div>
@stop
