@extends('admin.layouts.app')

@section('title', trans('page.add'))

@section('content')
    <div class="content-wrapper">
        <div class="container">
            <br>
            <br>
            <div class="banner-header">
                <h1 class="btn btn-primary">{{ trans('page.add') }}</h1>
            </div>
            <br>
            <br>
            <form action="{{ route('publisher.store') }}" method="POST" name="user_product">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <span class="badge badge-light"><h4>{{ trans('page.n') }}</h4></span>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <span class="badge badge-light"><h4>{{ trans('page.location') }}</h4></span>
                        <input type="text" class="form-control" name="location" required>
                    </div>
                    @error('location')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <p class="form-submit">
                    <button class="btn-primary btn" name="submit" type="submit">{{ trans('page.con') }}</button>
                </p>
            </form>
            <br>
            <a href="{{ route('publisher.all') }}"><button type="submit" class="btn btn-primary">{{ trans('page.cancel') }}</button></a>
        </div>
        <br>
        <br>
    </div>
@endsection
