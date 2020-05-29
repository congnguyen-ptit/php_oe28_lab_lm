@extends('user.layouts.app')

@section('title', trans('page.ab'))

@section('content')
<section class="page-banner services-banner">
    <div class="container">
        <div class="banner-header">
            <h2>{{ trans('page.ab') }}</h2>
            <span class="underline center"></span>
            <p class="lead">{{ trans('page.sd') }}</p>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="{{ route('home')}}">{{trans('page.home') }}</a></li>
                <li>{{ trans('page.ab') }}</li>
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
                        <br>
                        <br>
                        <h1>{{ trans('page.ab') }}</h1>
                        <hr>
                        @if (session('cu'))
                            <h2><span class="label label-success">{{ session('cu') }}</span></h2>
                        @endif
                        <div class="row">
                            <div class="col-md-9 personal-info">
                                 <form action="{{ route('books.store') }}" method="POST" name="user_product">
                                    @csrf
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">{{ trans('page.bn') }}</label>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" name="name" value="{{ trans('page.book') }}" required>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">{{ trans('page.author') }}</label>
                                        <div class="col-lg-8">
                                            <select name="user_id" required>
                                                <option value="{{ Auth::id() }}">{{ Auth::user()->name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">{{ trans('page.publisher') }}</label>
                                        <div class="col-lg-8">
                                            <select name="publisher_id" required>
                                                @foreach ($publishers as $publisher)
                                                    <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">{{ trans('page.category') }}</label>
                                        <div class="col-lg-8">
                                            <select name="category_id" required>
                                                @foreach ($child_categories as $child)
                                                    <option value="{{ $child->id }}">{{ $child->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">{{ trans('page.content') }}</label>
                                        <div class="col-lg-8">
                                            <textarea class="form-control" name="content" rows="7" required>{{ trans('page.content') }}</textarea>
                                        </div>
                                        @error('content')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">{{ trans('page.description') }}</label>
                                        <div class="col-lg-8">
                                            <textarea class="form-control" name="description" rows="7">{{ trans('page.description') }}</textarea>
                                        </div>
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">{{ trans('page.quantity') }}</label>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" name="quantity" value="{{ trans('page.quantity') }}" required>
                                        </div>
                                        @error('quantity')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">{{ trans('page.img') }}</label>
                                        <div class="col-lg-8">
                                            <input type="file" class="form-control" name="image" value="{{ trans('page.upload') }}" required>
                                        </div>
                                    </div>
                                    <p class="form-submit">
                                        <button class="btn-primary btn" name="submit" type="submit">{{ trans('page.con') }}</button>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
