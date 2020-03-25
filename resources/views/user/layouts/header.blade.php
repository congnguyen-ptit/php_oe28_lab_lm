<header id="header-v1" class="navbar-wrapper">
    <div class="container">
        <div class="row">
            <nav class="navbar navbar-default">
                <div class="row">
                    <div class="col-md-3">
                        <div class="navbar-header">
                            <div class="navbar-brand">
                                <h1>
                                    <a href="{{ route('home') }}">
                                        <img src="bower_components/bower_package/images/libraria-logo-v1.png" alt="{{ trans('page.li') }}" />
                                    </a>
                                </h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="header-topbar hidden-sm hidden-xs">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="topbar-info">
                                        <a href="{{ trans('page.tel') }}"><i class="fa fa-phone"></i>{{ trans('page.0916718468') }}</a>
                                        <span>&#47;</span>
                                        <a href="{{ trans('page.mt') }}"><i class="fa fa-envelope"></i>{{ trans('page.email') }}</a>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="topbar-links">
                                        @guest
                                            <a href="{{ route('login') }}"><i class="fa fa-lock"></i>{{ trans('page.loginandregister') }}</a>
                                            <span>&#124;</span>
                                        @else
                                            <a href="#"><i class="fa fa-lock"></i>{{ Auth::user()->name }}</a>
                                            <span>&#47;</span>
                                            <a href="{{ route('logout') }}">{{ trans('page.logout') }}
                                            </a>
                                        @endguest
                                        <div class="header-cart dropdown">
                                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                                <i class="fa fa-shopping-cart"></i>
                                                <small>{{ trans('page.0') }}</small>
                                            </a>
                                            <div class="dropdown-menu cart-dropdown">
                                                <ul>
                                                    <li class="clearfix">
                                                        <img src="bower_components/bower_package/images/header-cart-image-01.jpg" alt="cart item" />
                                                        <div class="item-info">
                                                            <div class="name">
                                                                <a href="#">{{ trans('page.gastby') }}</a>
                                                            </div>
                                                            <div class="author"><strong>{{ trans('page.author') }}&#58;</strong> </div>
                                                            <div class="price">1</div>
                                                        </div>
                                                        <a class="remove" href="#"><i class="fa fa-trash-o"></i></a>
                                                    </li>
                                                </ul>
                                                <div class="cart-buttons">
                                                    <a href="#" class="btn btn-dark-gray">{{ trans('page.viewcart') }}</a>
                                                    <a href="#" class="btn btn-primary">{{ trans('page.checkout') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="navbar-collapse hidden-sm hidden-xs">
                            <ul class="nav navbar-nav">
                                <li class="dropdown active">
                                    <a data-toggle="dropdown" class="dropdown-toggle disabled" href="{{ route('home') }}">{{ trans('page.home') }}</a>
                                </li>
                                <li class="dropdown">
                                    <a data-toggle="dropdown" class="dropdown-toggle disabled" href="{{ route('books.list') }}">{{ trans('page.category') }}</a>
                                    <ul class="dropdown-menu">
                                        @foreach ($categories as $category)
                                            <li >
                                                <a href="#">{{ $category->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a data-toggle="dropdown" class="dropdown-toggle disabled" href="#">{{ trans('page.newsandevents') }}</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">{{ trans('page.newsandevents') }}</a></li>
                                        <li><a href="#">{{ trans('page.newsandevents') }}</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a data-toggle="dropdown" class="dropdown-toggle disabled" href="blog.html">{{ trans('page.blog') }}</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">{{ trans('page.bloggridview') }}</a></li>
                                        <li><a href="#">{{ trans('page.blogdetail') }}</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">{{ trans('page.services') }}</a></li>
                                <li><a href="#">{{ trans('page.contact') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="mobile-menu hidden-lg hidden-md">
                    <a href="#mobile-menu"><i class="fa fa-navicon"></i></a>
                    <div id="mobile-menu">
                        <ul>
                            <li class="mobile-title">
                                <h4>{{ trans('page.navigator') }}</h4>
                                <a href="#" class="close"></a>
                            </li>
                            <li>
                                <a href="{{ route('home') }}">{{ trans('page.home') }}</a>
                            </li>
                            <li>
                                <a href="#">{{ trans('page.category') }}</a>
                                <ul>
                                    <li><a href="#">{{ trans('page.category') }}</a></li>
                                    <li><a href="#">{{ trans('page.category') }}</a></li>
                                    <li><a href="#">{{ trans('page.category') }}</a></li>
                                    <li><a href="#">{{ trans('page.category') }}</a></li>
                                    <li><a href="#">{{ trans('page.category') }}</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="">{{ trans('page.newsandevents') }}</a>
                                <ul>
                                    <li><a href="#">{{ trans('page.newsandevents') }}</a></li>
                                    <li><a href="#">{{ trans('page.newsandevents') }}</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">{{ trans('page.blog') }}</a>
                                <ul>
                                    <li><a href="">{{ trans('page.bloggridview') }}</a></li>
                                    <li><a href="">{{ trans('page.blogdetail') }}</a></li>
                                </ul>
                            </li>
                            <li><a href="#">{{ trans('page.services') }}</a></li>
                            <li><a href="#">{{ trans('page.contact') }}</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>
