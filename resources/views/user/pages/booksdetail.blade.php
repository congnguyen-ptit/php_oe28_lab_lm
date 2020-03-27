@extends('user.layouts.app')

@section('title', trans('page.detail', ['book' => $book->name]))

@section('content')
<section class="page-banner services-banner">
    <div class="container">
        <div class="banner-header">
            <h2>{{ trans('page.bookslist') }}</h2>
            <span class="underline center"></span>
            <p class="lead">{{ trans('page.sd') }}</p>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="{{ route('home') }}">{{ trans('page.home') }}</a></li>
                <li>{{ trans('page.books') }}</li>
            </ul>
        </div>
    </div>
</section>
<div id="content" class="site-content">
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <div class="booksmedia-detail-main">
                <div class="container">
                    <div class="row">
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
                    </div>
                    <div class="row">
                        <div class="col-md-9 col-md-push-3">
                            <div class="booksmedia-detail-box">
                                <div class="single-book-box">
                                    <div class="post-thumbnail">
                                        <div class="book-list-icon yellow-icon"></div>
                                        <img alt="{{ trans('page.book') }}" src="{{ $book->image }}" />
                                    </div>
                                    <div class="post-detail">
                                        <div class="books-social-sharing">
                                            <ul>
                                                <li><a href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                                <li><a href="#" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                                <li><a href="#" target="_blank"><i class="fa fa-rss"></i></a></li>
                                                <li><a href="#" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="optional-links">
                                            <ul>
                                                @if ($book->quantity != config('const.empty'))
                                                <li>
                                                    {{ $added ?? '' }}
                                                    @if (!$added)
                                                    <a href="{{ route('bookbag.add', $book->id) }}" target="_blank" data-toggle="blog-tags" data-placement="top" title="Add To Cart">
                                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                                    </a>
                                                    @else
                                                    <a href="{{ route('bookbag.remove', $book->id) }}" target="_blank" data-toggle="blog-tags" data-placement="top" title="Add To Cart">
                                                        <i class="fa3 fa-plus" aria-hidden="true"></i>
                                                    </a>
                                                    @endif
                                                </li>
                                                <li>
                                                    {{ $liked ?? '' }}
                                                    @if (!$liked)
                                                        <a href="{{ route('book.like', $book->id) }}" target="_blank" data-toggle="blog-tags" data-placement="top" title="Like">
                                                            <i class="fa fa-heart"></i>
                                                        </a>
                                                    @else
                                                        <a href="{{ route('book.unlike', $book->id) }}" target="_blank" data-toggle="blog-tags" data-placement="top" title="Like">
                                                            <i class="fa2 fa-heart"></i>
                                                        </a>
                                                    @endif
                                                </li>
                                                @endif
                                            </ul>
                                        </div>
                                        <header class="entry-header">
                                            <h2 class="entry-title">{{ $book->name }}</h2>
                                            <ul>
                                                <li><a href="{{ route('user.detail', $book->user->user_slug) }}"><strong>{{ trans('page.author') }}&#58;</strong> {{ $book->user->name }}</a></li>
                                                <li><strong>{{ trans('page.code') }}&#58;</strong> {{ $book->code }}</li>
                                                <li>
                                                    <div class="rating">
                                                        <strong>{{ trans('page.rating') }}&#58;</strong>
                                                        <span>☆</span>
                                                        <span>☆</span>
                                                        <span>☆</span>
                                                        <span>☆</span>
                                                        <span>☆</span>
                                                    </div>
                                                </li>
                                                <li><strong>{{ trans('page.publisher') }}&#58;</strong> {{ $book->publisher->name }}</li>
                                                <li><strong>{{ trans('page.category') }}&#58;</strong> {{ $book->category->name }}</li>
                                            </ul>
                                        </header>
                                        <div class="entry-content post-buttons">
                                            @if ($book->quantity == 0)
                                                <span class="btn btn-dark-gray">{{ trans('page.out') }}</span>
                                            @else
                                                <span class="btn btn-dark-gray">{{ trans('page.available') }}</span>
                                                <a href="#." class="btn btn-dark-gray">{{ trans('page.borrow') }}</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <p><strong>{{ trans('page.summary') }}&#58;</strong> {{ trans('page.sd') }}</p>
                                <div class="table-tabs" id="responsiveTabs">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <b class="arrow-up"></b>
                                            <a data-toggle="tab" href="#sectionA">{{ trans('page.comment') }} &#x28;{{ isset($book->comments) ? $book->comments->count() : config('const.empty') }}&#x29;</a>
                                        </li>
                                        <li>
                                            <b class="arrow-up"></b>
                                            <a data-toggle="tab" href="#sectionB">{{ trans('page.related') }}</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="sectionA" class="tab-pane fade in active">
                                            <div class="comments-area" id="comments">
                                                <div class="comment-bg">
                                                    <h4 class="comments-title">{{ trans('page.readercomments') }}</h4>
                                                    <span class="underline left"></span>
                                                    <ol class="comment-list">
                                                        <li class="comment even thread-even depth-1 parent">
                                                            @foreach ($book->comments as $comment)
                                                                <div class="comment-body">
                                                                    <div class="comment-author vcard">
                                                                        <img class="avatar avatar-32 photo avatar-default" src="images/smurf.png">
                                                                    </div>
                                                                    <footer class="comment-meta">
                                                                        <div class="comment-metadata">
                                                                            <b class="fn">
                                                                                <a class="url" rel="external nofollow" href="{{ route('user.detail', $comment->user->user_slug) }}">{{ $comment->user->username }}</a>
                                                                            </b>
                                                                            <time>
                                                                                <b> &#40;{{ $comment->created_at }} &#41;</b>
                                                                            </time>
                                                                        </div>
                                                                        <div class="comment-content">
                                                                            <p>{{ $comment->content }}</p>
                                                                        </div>
                                                                    </footer>
                                                                </div>
                                                             @endforeach
                                                        </li>
                                                    </ol>
                                                </div>
                                                <div class="comment-respond" id="respond">
                                                    <h4 class="comment-reply-title" id="reply-title">{{ trans('page.write') }}</h4>
                                                    <span class="underline left"></span>
                                                    <form class="comment-form" id="commentform" method="POST" action="{{ route('comments', $book->id) }}">
                                                        @csrf
                                                        <div class="row">
                                                            <p class="comment-form-comment">
                                                                <textarea name="comment" id="comment" placeholder="{{ trans('page.write') }}"></textarea>
                                                            </p>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <p class="form-submit">
                                                            <input value="{{ trans('page.post') }}" class="submit" id="submit" name="submit" type="submit">
                                                        </p>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="sectionB" class="tab-pane fade in">
                                            @foreach ($child_categories as $child_category)
                                                @foreach ($child_category->books->take(config('const.take')) as $book)
                                                    <h4><a href="{{ route('book.detail', $book->slug) }}">{{ $book->name }}</a></h4>
                                                    <h6>{{ trans('page.author') }}&#58; {{ $book->user->name }}</h6>
                                                    <p>{{ trans('page.sd') }}</p>
                                                @endforeach
                                            @endforeach
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
