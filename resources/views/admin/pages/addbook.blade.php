@extends('admin.layouts.app')

@section('title', trans('page.add'))

@section('content')
    <div class="content-wrapper">
        <div class="container">
            <br>
            <br>
            <div class="banner-header">
                <h1 class="btn btn-primary">{{ trans('page.create') }}</h1>
                @if (session('createsucccessfully'))
                    <span class="label label-success">{{ session('createsucccessfully') }}</span>
                @endif
            </div>
            <br>
            <br>
            <form action="{{ route('book.store') }}" method="POST" name="user_product">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <span class="badge badge-light"><h4>{{ trans('page.bn') }}</h4></span>
                        <input type="text" class="form-control" name="name" value="{{ trans('page.book') }}" required>
                    </div>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <span class="badge badge-light"><h4>{{ trans('page.author') }}</h4></span>
                        <select name="user_id" required>
                            <option value="{{ trans('page.author') }}">{{ trans('page.cus') }}</option>
                            @foreach ($authors as $author)
                                <option value="{{ $author->id }}">{{ $author->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <a href="{{ route('user.add') }}" data-toggle="tooltip"><i class="fa fa-plus-square-o" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <span class="badge badge-light"><h4>{{ trans('page.publisher') }}</h4></span>
                        <select name="publisher_id" required>
                            <option value="{{ trans('page.publisher') }}">{{ trans('page.cps') }}</option>
                            @foreach ($publishers as $publisher)
                                <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <a href="{{ route('publisher.add') }}" data-toggle="tooltip"><i class="fa fa-plus-square-o" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <span class="badge badge-light"><h4>{{ trans('page.category') }}</h4></span>
                        <select name="category_id" required>
                            <option value="{{ trans('page.category') }}">{{ trans('page.ccs') }}</option>
                            @foreach ($child_categories as $child)
                                <option value="{{ $child->id }}">{{ $child->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <a href="{{ route('category.add') }}" data-toggle="tooltip"><i class="fa fa-plus-square-o" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <span class="badge badge-light"><h4>{{ trans('page.content') }}</h4></span>
                        <textarea class="form-control" name="content" rows="7" required>{{ trans('page.content') }}</textarea>
                    </div>
                    @error('content')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group col-md-6">
                       <span class="badge badge-light"><h4>{{ trans('page.description') }}</h4></span>
                        <textarea class="form-control" name="description" rows="7">{{ trans('page.description') }}</textarea>
                    </div>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group col-md-3">
                        <span class="badge badge-light"><h4>{{ trans('page.quantity') }}</h4></span>
                        <input type="text" class="form-control" name="quantity" value="{{ trans('page.quantity') }}" required>
                    </div>
                    @error('quantity')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group col-md-8">
                        <span class="badge badge-light"><h4>{{ trans('page.img') }}</h4></span>
                        <input type="file" class="form-control" name="image" value="{{ trans('page.upload') }}" required>
                    </div>
                </div>
                <p class="form-submit">
                    <button class="btn-primary btn" name="submit" type="submit">{{ trans('page.con') }}</button>
                </p>
            </form>
            <br>
            <a href="{{ route('book.list') }}"><button type="submit" class="btn btn-primary">{{ trans('page.cancel') }}</button>
        </div>
    </div>
@endsection
