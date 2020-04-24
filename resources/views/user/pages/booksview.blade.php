@extends('user.layouts.app')

@section('title', trans('page.books'))

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
                <li><a href="{{ route('home')}}">{{trans('page.home') }}</a></li>
                <li>{{ trans('page.books') }}</li>
            </ul>
        </div>
    </div>
</section>
<div id="content" class="site-content">
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <div class="books-media-gird">
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
                            @if ($books->count() > 0)
                                <div class="books-gird">
                                    <ul>
                                        @foreach ($books as $book)
                                            <li>
                                                <figure>
                                                    <img src="{{ $book->image }}" alt="{{ trans('page.book') }}">
                                                    <figcaption>
                                                        <p><strong>{{ $book->name }}
                                                            @if ($book->quantity == config('const.empty'))
                                                                <label id="out"> &#40;{{ trans('page.out') }} &#41;</label>
                                                            @endif
                                                        </strong></p>
                                                        <p><strong>{{ trans('page.author') }}&#58;</strong> {{ $book->user->name }}</p>
                                                    </figcaption>
                                                </figure>
                                                <div class="single-book-box">
                                                    <div class="post-detail">
                                                        <div class="books-social-sharing">
                                                            <ul>
                                                                <li><a href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                                                <li><a href="#" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                                                <li><a href="#" target="_blank"><i class="fa fa-rss"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        @if ($book->quantity != config('const.empty'))
                                                            <div class="optional-links">
                                                                <ul>
                                                                    <li>
                                                                        <input type="hidden" id="book_id" value="{{ $book->id }}">
                                                                        <a href="#" id="addbook">
                                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        @endif
                                                        <header class="entry-header">
                                                            <h3 class="entry-title">
                                                                <a href="{{ route('book.detail', $book->slug) }}">{{ $book->name }}</a>
                                                            </h3>
                                                            <ul>
                                                                <li><strong>{{ trans('page.author') }}&#58;</strong>
                                                                    <a href="{{ route('user.detail', $book->user->user_slug) }}"> {{ $book->user->name }}</a>
                                                                </li>
                                                                <li><strong>{{ trans('page.code') }}&#58;</strong> {{ $book->code }}</li>
                                                            </ul>
                                                        </header>
                                                        <div class="entry-content">
                                                            <p>{{ trans('page.sd') }}</p>
                                                        </div>
                                                        <footer class="entry-footer">
                                                            <a class="btn btn-primary" href="{{ route('book.detail', $book->slug) }}">{{ trans('page.readmore') }}</a>
                                                        </footer>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                {{ $books->links() }}
                            @else
                               <div class="books-gird">
                                   <h3>{{ trans('page.seeya') }}</h3>
                               </div>
                            @endif
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
                                        <br>
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
                                        <br>
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
