@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <div class="post-preview">
                <a href="#">
                    <h2 class="post-title">
                        Blog posts coming soon
                    </h2>
                    <h3 class="post-subtitle">
                        The site is still in development phase. Expect the real posts soon.
                    </h3>
                </a>
                <p class="post-meta">Posted by <a href="#">Marian Marinov</a> on August 17, 2015</p>
            </div>
            <hr>
            <!-- Pager -->
            <ul class="pager">
                <li class="next disabled">
                    <a href="#">Older Posts &rarr;</a>
                </li>
            </ul>
        </div>
    </div>
@stop
