@extends('admin.layouts.app')

@section('title', trans('page.add'))

@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="banner-header">
                <br>
                <h1 class="btn btn-primary">{{ trans('page.add') }}</h1>
            </div>
            <br>
            <br>
            <form action="{{ route('role.store') }}" method="POST" name="user_product">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <span class="badge badge-light"><h4>{{ trans('page.rolename') }}</h4></span>
                        <input type="text" class="form-control" name="name" >
                    </div>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <span class="badge badge-light"><h4>{{ trans('page.description') }}</h4></span>
                        <textarea type="text" class="form-control" name="description" ></textarea>
                    </div>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <span class="badge badge-light"><h4>{{ trans('page.permissions') }}</h4></span>
                        @foreach ($permissions as $permission)
                        <div class="checkbox">
                            <input type="checkbox" name="permission_id[]" value="{{ $permission->id }}">
                            <label >{{ $permission->name }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>
                <p class="form-submit">
                    <button class="btn-primary btn" name="submit" type="submit">{{ trans('page.con') }}</button>
                </p>
            </form>
            <br>
            <a href="{{ route('role.list') }}"><button type="submit" class="btn btn-primary">{{ trans('page.cancel') }}</button></a>
        </div>
    </div>
@endsection
