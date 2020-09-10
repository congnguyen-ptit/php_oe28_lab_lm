@extends('user.layouts.app')

@section('title', trans('page.viewcart'))

@section('content')
<section class="page-banner services-banner">
    <div class="container">
        <div class="banner-header">
            <h2>{{ trans('page.viewcart') }}</h2>
            <span class="underline center"></span>
            <p class="lead">{{ trans('page.st2') }}</p>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="{{ route('home') }}">{{ trans('page.home') }}</a></li>
                <li>{{ trans('page.viewcart') }}</li>
            </ul>
        </div>
    </div>
</section>
<div id="content" class="site-content">
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <div class="cart-main">
                <div class="container">
                    <div class="row">
                        <div class="cart-head">
                            @auth
                                <div class="col-xs-12 col-sm-6 account-option">
                                    <strong>{{ Auth::user()->name }}</strong>
                                </div>
                                <div class="col-xs-12 col-sm-6 account-option">
                                    <strong>{{ trans('page.mail') }}&#58; {{ Auth::user()->email }}</strong>
                                </div>
                            @endauth
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-md-12">
                            <div class="page type-page status-publish hentry">
                                <div class="entry-content">
                                    <div class="woocommerce table-tabs" id="responsiveTabs">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><b class="arrow-up"></b><a data-toggle="tab" href="#sectionA">{{ trans('page.viewcart') }}</a></li>
                                            @auth
                                            <li><b class="arrow-up"></b><a data-toggle="tab" href="#sectionB">{{ trans('page.requesting') }}</a></li>
                                            <li><b class="arrow-up"></b><a data-toggle="tab" href="#sectionC">{{ trans('page.borrowed') }}</a></li>
                                            @endauth
                                        </ul>
                                        <div class="tab-content">
                                            <div id="sectionA" class="tab-pane fade in active">
                                                <form method="POST" id="bookbag" data-url="{{ route('user.request') }}" action="">
                                                    @csrf
                                                    @auth
                                                        <span><strong>{{ trans('page.user') }}&#58;</strong> {{ Auth::user()->name }}</span>
                                                        <br/>
                                                        <br/>
                                                        <span><strong>{{ trans('page.location') }}&#58;<br/></strong>
                                                        <br/>
                                                        @foreach (Auth::user()->locations as $location)
                                                            &#9679;
                                                            {{ $location->apartment_number }}&#44;
                                                            {{ $location->street }}&#44;
                                                            {{ $location->ward }}&#44;
                                                            {{ $location->district }}&#44;
                                                            {{ $location->city }}&#46;
                                                            <br/>
                                                        @endforeach
                                                        </span>
                                                        <br/>
                                                        <span><strong>{{ trans('page.phonenumber') }}&#58;</strong> {{ Auth::user()->phone_number }}</span>
                                                        <span><strong>{{ trans('page.email') }}&#58;</strong> {{ Auth::user()->email }}</span>
                                                        <br/>
                                                        <br/>
                                                    @endauth
                                                    <span>
                                                        <strong>{{ trans('page.from') }}&#58;</strong>
                                                    </span>
                                                    <input type="date" name="start_date" required="" value="{{ Carbon\Carbon::today()->toDateString() }}">
                                                    <span>
                                                        <strong>{{ trans('page.to') }}&#58;</strong>
                                                    </span>
                                                    <input type="date" name="end_date" required="" value="{{ old('end_date') }}">
                                                    @if(session()->has('fail'))
                                                        <strong>{{ session()->get('fail') }}</strong>
                                                    @endif
                                                    <br>
                                                    @if(session('over'))
                                                        <strong>{{ session('over') }}</strong>
                                                    @endif
                                                    <br>
                                                    <table class="table table-bordered shop_table cart">
                                                        <thead>
                                                            <tr>
                                                                <th class="product-name">{{ trans('page.product') }}</th>
                                                                <th>Price (VND)</th>
                                                                <th>Quantity</th>
                                                                <th class="product-subtotal"><button type="submit" class="btn btn-primary btn-sm" >{{ trans('page.request') }}</button></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if ($item)
                                                                @foreach ($item as $id => $value)
                                                                <tr class="cart_item">
                                                                    <td data-title="Product" class="product-name">
                                                                        <span class="product-thumbnail">
                                                                            <a href="{{ route('book.detail', $value['slug']) }}"><img src="{{ $value['img'] }}" alt="cart-product-1"></a>
                                                                        </span>
                                                                        <span class="product-detail">
                                                                            <a href="{{ route('book.detail', $value['slug']) }}"><strong>{{ $value['name'] }}</strong></a>
                                                                            <span><strong>{{ trans('page.author') }}&#58;</strong> {{ $value['author'] }}</span>
                                                                        </span>
                                                                    </td>
                                                                    <td class="product-remove">
                                                                        <strong>{{ $value['price'] }}</strong>
                                                                    </td>
                                                                    <td class="product-remove">
                                                                        <strong>{{ $value['quantity'] }}</strong>
                                                                    </td>
                                                                    <td class="product-remove">
                                                                        <a class="remove" href="{{ route('bookbag.remove', $value['id']) }}">
                                                                        <button type="button" class="btn btn-primary">
                                                                            <i class="fa fa-trash-o"></i>
                                                                        </button>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </form>
                                            </div>
                                            @auth
                                            <div id="sectionB" class="tab-pane fade in">
                                                <h5>{{ trans('page.requesting') }}</h5>
                                                <table class="table table-bordered shop_table cart">
                                                    <thead>
                                                        <tr>
                                                            <th class="product-name">&#35;</th>
                                                            <th class="product-name">{{ trans('page.product') }}</th>
                                                            <th class="product-subtotal">{{ trans('page.Information') }}</th>
                                                            <th class="product-subtotal">{{ trans('page.action') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($requestings as $key => $requesting)
                                                        <tr class="cart_item">
                                                            <td>{{ $key = $key + config('const.one') }}</td>
                                                            <td data-title="Product" class="product-name">
                                                                <span class="product-thumbnail">
                                                                    <a href="{{ route('book.detail', $requesting->book->slug) }}"><img src="{{ $requesting->book->image }}" alt="cart-product-1"></a>
                                                                </span>
                                                                <span class="product-detail">
                                                                    <a href="{{ route('book.detail', $requesting->book->slug) }}"><strong>{{ $requesting->book->name }}</strong></a>
                                                                    <span><strong>{{ trans('page.author') }}&#58;</strong> {{ $requesting->book->user->name }}</span>
                                                                </span>
                                                            </td>
                                                            <td class="product-detail">
                                                                <span>
                                                                    <strong>{{ trans('page.from') }}&#58;</strong>
                                                                </span>
                                                                <input type="date" name="start_date" disabled value="{{ $requesting->start_date }}">
                                                                <span>
                                                                    <strong>{{ trans('page.to') }}&#58;</strong>
                                                                </span>
                                                                <input type="date" name="end_date" disabled value="{{ $requesting->end_date }}">
                                                            </td>
                                                            <td class="product-remove">
                                                                <form action="{{ route('record.delete', $requesting->id) }}" method="POST">
                                                                    @csrf
                                                                    @method("DELETE")
                                                                    <button type="submit"><i class="fa fa-undo" aria-hidden="true"></i></button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div id="sectionC" class="tab-pane fade in">
                                                <h5>{{ trans('page.borrowed') }}</h5>
                                                <table class="table table-bordered shop_table cart">
                                                    <thead>
                                                        <tr>
                                                            <th class="product-name">&#35;</th>
                                                            <th class="product-name">{{ trans('page.product') }}</th>
                                                            <th class="product-subtotal">{{ trans('page.Information') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($borroweds as $key => $borrowed)
                                                        <tr class="cart_item">
                                                            <td>{{ $key = $key + config('const.one') }}</td>
                                                            <td data-title="Product" class="product-name">
                                                                <span class="product-thumbnail">
                                                                    <a href="{{ route('book.detail', $borrowed->book->slug) }}"></a>
                                                                </span>
                                                                <span class="product-detail">
                                                                    <a href="{{ route('book.detail', $borrowed->book->slug) }}"><strong>{{ $borrowed->book->name }}</strong></a>
                                                                    <span><strong>{{ trans('page.author') }}&#58;</strong> {{ $borrowed->book->user->name }}</span>
                                                                </span>
                                                            </td>
                                                            <td class="product-detail">
                                                                <span>
                                                                    <strong>{{ trans('page.from') }}&#58;</strong>
                                                                </span>
                                                                <input type="date" name="start_date" disabled value="{{ $borrowed->start_date }}">
                                                                <span>
                                                                    <strong>{{ trans('page.to') }}&#58;</strong>
                                                                </span>
                                                                <input type="date" name="end_date" disabled value="{{ $borrowed->end_date }}">
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
