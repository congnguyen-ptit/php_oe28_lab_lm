@extends('admin.layouts.app')

@section('title', trans('page.edit'))

@section('content')
    <div class="content-wrapper">
        <div class="container">
<br>
            <br>
            <div class="banner-header">
                <h1 class="btn btn-primary">{{ trans('page.edit') }}&#58; {{ $category->name }}</h1>
            </div>
            <br>
            <br>
            <form action="{{ route('category.save', $category->id) }}" method="POST" name="user_product">
                @csrf
                @method("PATCH")
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>{{ trans('page.cname') }}</label>
                        <input type="text" class="form-control" name="name" value="{{ $category->name }}">
                    </div>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group col-md-6">
                        <label>{{ trans('page.description') }}</label>
                        <textarea class="form-control" name="description" rows="7">{{ $category->description }}</textarea>
                    </div>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group col-md-3">
                        <label>{{ trans('page.category') }}</label>
                        <select name="parent_id" >
                            <option value="{{ $category->parent_id }}">{{ $category->name }}</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <p class="form-submit">
                    <button class="btn-primary btn" name="submit" type="submit">{{ trans('page.save') }}
                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                    </button>
                </p>
            </form>
            <br>
            <a href="{{ route('category.list') }}"><button type="submit" class="btn btn-primary">{{ trans('page.cancel') }}</button></a>
        </div>
    </div>
@endsection
