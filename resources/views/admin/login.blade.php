@extends('layouts.admin_master')

@section('content')
    <div id="wrapper" style="background:#F7F7F7;">
        <div id="login" class="animate form">
            <section class="login_content">
                {!! Form::open() !!}
                    <h1>Login Form</h1>
                    <div>
                        {!! Form::email('email', null, ['id' => 'email', 'class' => 'form-control', 'placeholder' => 'E-mail', 'required', 'data-validation-required-message' => 'Please enter your email.']); !!}
                    </div>
                    <div>
                        {!! Form::password('password', ['id' => 'password', 'class' => 'form-control', 'placeholder' => 'Password', 'required', 'data-validation-required-message' => 'Please enter your password.']); !!}
                    </div>
                    <div>
                        {!! Form::submit('Log in', ['id' => 'btn_login_submit', 'class' => 'btn btn-default']) !!}
                    </div>
                    <div class="clearfix"></div>
                    @if($errors->any())
                        <br>
                        <div class='alert alert-danger text-left'>
                            <strong>{{$errors->first()}}</strong>
                        </div>
                    @endif
                    <div class="separator">
                        <div>
                            <h1><i class="fa fa-rocket" style="font-size: 26px;"></i>&nbsp; Marian Marinov's Blog</h1>

                            <p>©2015 All Rights Reserved.</p>
                        </div>
                    </div>
                {!! Form::close() !!}
                <!-- form -->
            </section>
            <!-- content -->
        </div>
    </div>

    <script type="text/javascript">
            $('body').attr('style', 'background:#F7F7F7');
    </script>
@stop
