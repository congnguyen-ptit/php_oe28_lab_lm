@extends('user.layouts.app')

@section('title', trans('page.allca'))

@section('content')
        <!-- Start: Page Banner -->
        <section class="page-banner services-banner">
            <div class="container">
                <div class="banner-header">
                    <h2>{{ trans('page.category') }}</h2>
                    <span class="underline center"></span>
                    <p class="lead">{{ trans('page.slogan1') }}</p>
                </div>
                <div class="breadcrumb">
                    <ul>
                        <li><a href="index-2.html">{{ trans('page.home') }}</a></li>
                        <li>{{ trans('page.categories') }}</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Start: Services Section -->
        <div id="content" class="site-content">
            <div id="primary" class="content-area">
                <main id="main" class="site-main">
                    <div class="services-main">
                        <div class="services-pg">
                            <section class="services-offering">
                                <div class="container">
                                    <div class="center-content">
                                        <h2 class="section-title">{{ trans('page.allca') }}</h2>
                                        <span class="underline center"></span>
                                        <p class="lead">{{ trans('page.slogan1') }}</p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="contact-location">
                                        @foreach ($child_category as $child_cate)
                                        <div class="flipcard">
                                            <div class="front">
                                                <div class="top-info">
                                                    <h3><span>{{ $child_cate->name }}</span></h3>
                                                </div>
                                                <div class="bottom-info">
                                                    <span class="top-arrow"></span>
                                                    <p>{{ $child_cate->description }}</p>
                                                </div>
                                            </div>
                                            <div class="back">
                                                <div class="bottom-info orange-bg">
                                                    <span class="bottom-arrow"></span>
                                                    <p>{{ $child_cate->description }}</p>
                                                </div>
                                                <div class="top-info dark-bg">
                                                    <a href="{{ route('book.category', $child_cate->slug) }}">
                                                        <h3><span>{{ trans('page.readmore') }}</span></h3>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <!-- End: Services Section -->
@endsection
