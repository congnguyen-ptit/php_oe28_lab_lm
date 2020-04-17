@extends('user.layouts.app')

@section('title', trans('page.home') )

@section('slide')
    <div data-ride="carousel" class="carousel slide" id="home-v1-header-carousel">
        <div class="carousel-inner">
            <div class="item active">
                <figure>
                    <img alt="{{ trans('page.homeslide') }}" src="bower_components/bower_package/images/header-slider/home-v1/header-slide.jpg" />
                </figure>
                <div class="container">
                    <div class="carousel-caption">
                        <h3>{{ trans('page.slogan1') }}</h3>
                        <h2>{{ trans('page.st1') }}</h2>
                        <p>{{ trans('page.slogan2') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <a class="left carousel-control" href="#home-v1-header-carousel" data-slide="prev"></a>
        <a class="right carousel-control" href="#home-v1-header-carousel" data-slide="next"></a>
    </div>
@endsection

@section('searchfilter')
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
@endsection

@section('welcome')
    <section class="welcome-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="welcome-wrap">
                        <div class="welcome-text">
                            <h2 class="section-title">{{ trans('page.welcome') }}
                            </h2>
                            <span class="underline left"></span>
                            <p class="lead">{{ trans('page.st2') }}</p>
                            <p>{{ trans('page.lorem') }}</p>
                            <a class="btn btn-primary" href="#">{{ trans('page.readmore') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="welcome-image"></div>
    </section>
@endsection

@section('categoryfilter')
<section class="category-filter section-padding">
        <div class="container">
            <div class="center-content">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <h2 class="section-title">{{ trans('page.checkout') }}</h2>
                        <span class="underline center"></span>
                        <p class="lead">{{ trans('page.sd') }}</p>
                    </div>
                </div>
            </div>
            <div class="filter-buttons">
                <div class="filter btn" data-filter="all">{{ trans('page.all') }}</div>
                @foreach ($child_categories as $child_category)
                <div class="filter btn" data-filter="&#46;{{ $child_category->slug }}">
                    {{ $child_category->name }}
                </div>
                @endforeach
            </div>
        </div>
        <div id="category-filter">
            <ul class="category-list">
                @foreach ($books as $book)
                <li class="category-item {{ $book->category->slug }}">
                <figure>
                    <img src="images/smurf.png" alt="{{ trans('page.releaase') }}" />
                        <figcaption class="bg-orange">
                            <div class="info-block">
                                <a href="{{ route('book.detail', $book->slug) }}"><h4>{{ $book->name }}</h4></a>
                                <span class="author"><strong>{{ trans('page.author') }}&#58; </strong> {{ $book->user->name }}</span>
                                <span class="author"><strong>{{ trans('page.code') }}&#58; </strong> {{ $book->code }}</span>
                                <div class="rating">
                                    <span>☆</span>
                                    <span>☆</span>
                                    <span>☆</span>
                                    <span>☆</span>
                                    <span>☆</span>
                                </div>
                                <p>{{ trans('page.sd') }}</p>
                                <a href="{{ route('book.detail', $book->slug) }}">{{ trans('page.readmore') }}<i class="fa fa-long-arrow-right"></i></a>
                                <ol>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-shopping-cart"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-heart"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-share-alt"></i>
                                        </a>
                                    </li>
                                </ol>
                            </div>
                        </figcaption>
                </figure>
                </li>
                @endforeach
            </ul>
            <div class="center-content">
                <a href="{{ route('book.books.list') }}" class="btn btn-primary">{{ trans('page.viewmore') }}</a>
            </div>
            <div class="clearfix"></div>
        </div>
</section>
@endsection
