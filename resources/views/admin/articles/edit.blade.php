@extends('layouts.admin_master')

@section('content')
    <link type="text/css" rel="stylesheet" href="/css/bootstrap-datepicker.min.css">
    <div class="main_container">

        @include('partials.admin.sidebar')

        @include('partials.admin.top_nav')

        <div class="right_col" role="main">
            <div class="x_panel">
                @include('partials.admin.article_form')
            </div>
        </div>
    </div>
@stop