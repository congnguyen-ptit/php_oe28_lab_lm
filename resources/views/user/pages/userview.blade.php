@extends('user.layouts.app')

@section('title', trans('page.detail', ['book' => $user->name]))

@section('content')
<section class="page-banner news-listing-banner services-banner">
    <div class="container">
        <div class="banner-header">
            <h2>{{ trans('page.detail', ['book' => $user->name]) }}</h2>
            <span class="underline center"></span>
            <p class="lead">{{ trans('page.st1') }}</p>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="{{ route('home') }}">{{ trans('page.home') }}</a></li>
                <li>{{ trans('page.detail', ['book' => $user->name]) }}</li>
            </ul>
        </div>
    </div>
</section>
    <div id="content" class="site-content">
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
                <div class="main-news-list">
                    <div class="container">
                        <section class="search-filters">
                            <div class="container">
                                <div class="filter-box">
                                    <h3>{{ trans('page.search') }}</h3>
                                    <form action="{{ route('book.search') }}" method="GET">
                                        <div class="col-md-5 col-sm-6">
                                            <div class="form-group">
                                                <label class="sr-only" for="keywords">{{ trans('page.keyword') }}</label>
                                                <input class="form-control" placeholder="{{ trans('page.keyword') }}" id="keywords" name="keywords" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-5 col-sm-6">
                                            <div class="form-group">
                                                <select name="category" id="category" class="form-control">
                                                    <option value="all">{{ trans('page.All') }}</option>
                                                    @foreach ($child_categories as $child_category)
                                                        <option value="{{ $child_category->slug }}">{{ $child_category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-sm-6">
                                            <div class="form-group">
                                                <input class="form-control" type="submit" value="{{ trans('page.s') }}">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </section>
                        <div class="row">
                            <div class="col-md-9 col-md-push-3 news-events-list-view">
                                <div class="news-list-box">
                                    <div class="single-news-list">
                                        <div class="social-content">
                                            <div class="social-share">
                                                <ul>
                                                    <li><i class="fa fa-book" aria-hidden="true"></i> {{ $user->books->count() }}</li>
                                                    <li><i class="fa fa-users" aria-hidden="true"></i> {{ $user->followed->count() }}</li>
                                                    <li><i class="fa fa-binoculars" aria-hidden="true"></i> {{ $user->following->count() }}</li>
                                                </ul>
                                            </div>
                                            <div class="social-media">
                                                <input type="hidden" id="user_id" value="{{ $user->id }}">
                                                <ul>
                                                    @if (Auth::id() != $user->id)
                                                        {{ $follow ?? '' }}
                                                        @if (!$follow)
                                                            <li>
                                                                <a href="#" id="follow">
                                                                    <i class="fa fa-user-plus" aria-hidden="true"></i>
                                                                </a>
                                                            </li>
                                                        @else
                                                            <li>
                                                                <a href="#" id="unfollow">
                                                                    <i class="fa fa-minus-square" aria-hidden="true"></i>
                                                                </a>
                                                            </li>
                                                        @endif
                                                        <li><a href="#." target="_blank"><i class="fa fa-facebook"></i></a></li>
                                                        <li><a href="#." target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                        <figure>
                                            <a href="{{ route('user.detail', $user->user_slug) }}"><img src="images/smurf.png" alt="News &amp; Event"></a>
                                        </figure>
                                        <div class="content-block">
                                            <div class="member-info">
                                                <div class="content_meta_category">
                                                    @if ($user->role_id == config('const.author'))
                                                    <span class="arrow-right"></span>
                                                    <a href="#." rel="category tag">{{ trans('page.author') }}</a>
                                                    @elseif ($user->role_id == config('const.user'))
                                                    <span class="arrow-right"></span>
                                                    <a href="#." rel="category tag">{{ trans('page.user') }}</a>
                                                    @endif
                                                </div>
                                                <ul class="news-event-info">
                                                    <li>
                                                        <a href="#" target="_blank">
                                                            <i class="fa fa-calendar"></i>
                                                            {{ $user->created_at }}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" target="_blank">
                                                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                                            {{ $user->email }}
                                                        </a>
                                                    </li>
                                                </ul>
                                                <h3><a href="{{ route('user.detail', $user->user_slug) }}">{{ $user->name }}</a></h3>
                                                <p>{{ trans('page.sd') }}</p>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="table-tabs" id="responsiveTabs">
                                            <ul class="nav nav-tabs">
                                                <li class="active">
                                                    <b class="arrow-up"></b>
                                                    <a data-toggle="tab" href="#sectionA">{{ trans('page.books') }} &#x28;{{ isset($user->books) ? $user->books->count() : config('const.empty') }}&#x29;</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div id="sectionA" class="tab-pane fade in active">
                                                    <div class="comments-area" id="comments">
                                                        <div class="comment-bg">
                                                            <h4 class="comments-title">{{ trans('page.books') }}</h4>
                                                            <span class="underline left"></span>
                                                            @if ($user->books->count() > config('const.empty'))
                                                                @foreach ($user->books as $book)
                                                                    <ol class="comment-list">
                                                                        <li class="comment even thread-even depth-1 parent">
                                                                            <div class="comment-body">
                                                                                <div class="comment-author vcard">
                                                                                    <b class="fn">
                                                                                        <img src="{{ $book->image }}">
                                                                                        <a class="url" rel="external nofollow" href="{{ route('book.detail', $book->slug) }}">{{ $book->name }}</a>
                                                                                    </b>
                                                                                </div>
                                                                                <footer class="comment-meta">
                                                                                    <div class="left-arrow"></div>
                                                                                    <div class="comment-metadata">
                                                                                        <b> {{ $book->category->name }}&#58; <a href="{{ route('book.detail', $book->slug) }}">{{ $book->name }}</a></b>
                                                                                    </div>
                                                                                    <div class="comment-content">
                                                                                        <p>{{ $book->content }}
                                                                                        </p>
                                                                                    </div>
                                                                                </footer>
                                                                            </div>
                                                                        </li>
                                                                    </ol>
                                                                @endforeach
                                                            @else
                                                                <h4>{{ trans('page.nobook') }}</h4>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-md-pull-9">
                                <aside id="secondary" class="sidebar widget-area" data-accordion-group>
                                    <div class="widget widget_related_search open" data-accordion>
                                        <h4 class="widget-title" data-control>{{ trans('page.rs') }}</h4>
                                        <div data-content>
                                            <div data-accordion>
                                                <h5 class="widget-sub-title" data-control>{{ trans('page.categories') }}</h5>
                                                <div class="widget_categories" data-content>
                                                    <ul>
                                                        @foreach ($child_categories as $child_category)
                                                            <li>
                                                                <a href="{{ route('book.category', $child_category->slug) }}">{{ $child_category->name }}
                                                                    <span>&#40;{{ $child_category->books->count() }}&#41;</span>
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                            <div data-accordion>
                                                <h5 class="widget-sub-title" data-control>{{ trans('page.authors') }}</h5>
                                                <div class="widget_categories" data-content>
                                                    <ul>
                                                        @foreach ($authors as $author)
                                                            <li>
                                                                <a href="{{ route('book.author', $author->user_slug) }}">{{ $author->name }}
                                                                    <span>&#40;{{ $author->books->count() }}&#41;</span>
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div data-accordion>
                                                <h5 class="widget-sub-title" data-control>{{ trans('page.publishers') }}</h5>
                                                <div class="widget_categories" data-content>
                                                    <ul>
                                                        @foreach ($publishers as $publisher)
                                                            <li>
                                                                <a href="{{ route('book.publisher', $publisher->slug) }}">{{ $publisher->name }}
                                                                    <span>&#40;{{ $publisher->books->count() }}&#41;</span>
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </aside>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
