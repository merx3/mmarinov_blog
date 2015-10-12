@extends('layouts.master')

@section('content')
<link href="/css/prism.css" rel="stylesheet" />

<div class="mobile-fixed-social">
	<div class="open-fixed-social">&lt;</div>
	<div class="close-fixed-social" style="display:none">&gt;</div>
</div>
<aside class="fixed-social">
	<div class="share-button">
		<div class="slide-link">
			<a class="post-share twitter" href="https://twitter.com/intent/tweet?url={{$articleUrl}}&via=marian_mmarinov&text={{$article->title}}" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
				<img src="/images/twitter.png" alt="Twitter share" style="height: 48px" />		
			</a>
		</div>
		@if($sharesCount['twitter'])
			<div class="counter twitter" style="width: {{ 35 + 10 * strlen(strval($sharesCount['twitter'])) }}px">{{ $sharesCount['twitter'] }}</div>
		@endif
	</div>

	<div class="share-button">
		<div class="slide-link">
			<a class="post-share facebook" href="{{$articleUrl}}"
				data-name="{{ $article->title }}"
				data-caption="{{ substr(url(), 7) }}" 
				data-description="{{ $article->description }}">
				<img src="/images/facebook.png" alt="Facebook share" style="height: 48px" />
			</a>
		</div>
		@if($sharesCount['facebook'])
			<div class="counter facebook" style="width: {{ 35 + 10 * strlen(strval($sharesCount['facebook'])) }}px">{{ $sharesCount['facebook'] }}</div>
		@endif
	</div>

	<div class="share-button">
		<div class="slide-link">
			<a class="post-share google-plus" id="ref_gp" href="https://plus.google.com/share?url={{$articleUrl}}"
				onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=600,width=600');return false">
				<img src="/images/google.png" alt="Google Plus share" style="height: 48px"/>
			</a>
		</div>
		@if($sharesCount['google'])
			<div class="counter google" style="width: {{ 35 + 10 * strlen(strval($sharesCount['google'])) }}px">{{ $sharesCount['google'] }}</div>
		@endif
	</div>

	<div class="share-button">
		<div class="slide-link">
			<a class="post-share linkedin" className="fa fa-linkedin share-base share-linked-in spacing-left-5" href="http://www.linkedin.com/shareArticle?mini=true&url={{$articleUrl}}&title={{urlencode($article->title)}}&summary={{urlencode($article->description)}}"
				onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=600,width=600');return false">
				<img src="/images/linkedin.png" alt="Linkedin share" style="height: 48px"/>
			</a>
		</div>
		@if($sharesCount['linkedin'])
			<div class="counter linkedin" style="width: {{ 35 + 10 * strlen(strval($sharesCount['linkedin'])) }}px">{{ $sharesCount['linkedin'] }}</div>
		@endif
	</div>

	<script>
	  // facebook's jssdk loading
	  window.fbAsyncInit = function() {
	    FB.init({
	      appId      : "{{ env('FB_APP_ID') }}",
	      xfbml      : true,
	      version    : 'v2.4'
	    });
	  };

	  (function(d, s, id){
	     var js, fjs = d.getElementsByTagName(s)[0];
	     if (d.getElementById(id)) {return;}
	     js = d.createElement(s); js.id = id;
	     js.src = "//connect.facebook.net/en_US/sdk.js";
	     fjs.parentNode.insertBefore(js, fjs);
	   }(document, 'script', 'facebook-jssdk'));
	</script>
</aside>

<div class="row">
    <div class="post col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
        <div class="post-title">
        	<h1>{{ $article->title }}</h1>
        	<h2 class="post-description">{{ $article->description }}</h2>
        	<div class="post-meta">
        		Posted by 
        		<span class="author meta-author">
        			<a href="{{ route('contact.index') }}">{{ $article->author->name }},</a>
    			</span>
        		<span class="last-updated" title="Published on">
        			&nbsp;<span class="glyphicon glyphicon-calendar"></span> {{ $article->published_at_formatted }}
    			</span>	
        		<div class="meta-categories"> 
        			Categories:
        			<span class="categories-list">{!! $article->categoriesLinks !!}</span>
    			</div>
        	</div>
        </div>
        <br>
        <section class="post-content">
        	{!! $article->content !!}
        </section>
        <br><br>
        <section class="post-comments">
        	<div id="disqus_thread"></div>
			<script type="text/javascript">
			    /* * * CONFIGURATION VARIABLES * * */
			    var disqus_shortname = 'mmarinov';
			    
			    /* * * DON'T EDIT BELOW THIS LINE * * */
			    (function() {
			        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
			        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
			        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
			    })();
			</script>
			<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
        </section>
    </div>
</div>

<script type="text/javascript" src="/js/prism.js"></script>
@stop
