<!-- Navigation -->
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand page-scroll" href="{{ route('articles.index') }}">
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
                <li class="dropdown">
                    {!! link_to_route('articles.index', 'Articles'); !!}
                     <ul class="sub-menu">
                        @foreach($navCategories as $category)
                            <li><a href="{{ route('articles.index', ['category' => $category->name]) }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li>
                    {!! link_to_route('about', 'About'); !!}
                </li>
                <li>
                    {!! link_to_route('contact.index', 'Contact Me'); !!}
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>