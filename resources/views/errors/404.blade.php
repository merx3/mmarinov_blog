@extends('layouts.master')

@section('content')
	<style type="text/css">
		/*
		HTML 5 Template Name: 
		File: 404 - 22 CSS
		Author: OS Templates
		Author URI: http://www.os-templates.com/
		Licence: <a href="http://www.os-templates.com/template-terms">Website Template Licence</a>
		*/

		#fof{display:block; width:100%; margin:100px 0; line-height:1.6em; text-align:center;}
		#fof .hgroup{text-transform:uppercase;}
		#fof .hgroup h1{margin-bottom:25px; font-size:80px;}
		#fof .hgroup h1 span{display:inline-block; margin-left:5px; padding:2px; border:1px solid #CCCCCC; overflow:hidden;}
		#fof .hgroup h1 span strong{display:inline-block; padding:0 20px 20px; border:1px solid #CCCCCC; font-weight:normal;}
		#fof .hgroup h2{font-size:60px;}
		#fof .hgroup h2 span{display:block; font-size:30px;}
		#fof p{margin:25px 0 0 0; padding:0; font-size:16px;}
		#fof p:first-child{margin-top:0;}

		/*----------------------------------------------HTML 5 Overrides-------------------------------------*/

		address, article, aside, figcaption, figure, footer, header, hgroup, nav, section{display:block; margin:0; padding:0;}

		/* ----------------------------------------------Wrapper-------------------------------------*/

		div.wrapper{display:block; width:100%; margin:0; padding:0; text-align:left;}

		.row1, .row1 a{color:#C0BAB6; background-color:#333333;}
		.row2{color:#979797; background-color:#FFFFFF;}
		.row2 a{color:#FF9900; background-color:#FFFFFF;}
		.row3, .row3 a{color:#919191; background-color:#232323;}

		div.wrapper h1, div.wrapper h2, div.wrapper h3, div.wrapper h4, div.wrapper h5, div.wrapper h6{
			margin:0 0 15px 0;
			padding:0;
			font-size:20px;
			font-weight:normal;
			line-height:normal;
		}
	</style>

	<div class="wrapper row2">
	  <div class="clear" id="container">
	    <div class="clear" id="fof">
	      <div class="hgroup">
	        <h1><span><strong>4</strong></span><span><strong>0</strong></span><span><strong>4</strong></span></h1>
	        <h2>Error ! <span>Page Not Found</span></h2>
	      </div>
	      <p>For Some Reason The Page You Requested Could Not Be Found</p>
	      <p><a href="javascript:history.go(-1)">« Go Back</a> / <a href="{{ route('articles.index') }}">Go Home »</a></p>
	    </div>
	  </div>
	</div>
@stop
