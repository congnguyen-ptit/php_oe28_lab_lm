@extends('admin.layouts.app')

@section('title', trans('page.edit'))

@section('content')
    <div class="content-wrapper">
        <a href="#" id="hello"> asdasd</a>
        <div class="container">
            <form action="{{ route('category.save', $category->id) }}" method="POST" id="formEditCategory">
                @csrf
                @method("PATCH")
                <input type="hidden" name="id" id="category_id" value="{{ $category->id }}">
                <div class="form-group">
                    <label>{{ trans('page.cname') }}</label>
                    <input type="text" class="form-control" name="name" value="{{ $category->name }}">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>{{ trans('page.description') }}</label>
                    <textarea class="form-control" name="description" rows="7">{{ $category->description }}</textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>{{ trans('page.category') }}</label>
                    <select name="parent_id" >
                        <option value="{{ $category->parent_id }}">{{ $category->name }}</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <p class="form-submit">
                    <button class="btn btn-success" name="submit" type="submit">{{ trans('page.save') }}
                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                    </button>
                </p>
            </form>
            <br>
            <a href="{{ route('category.list') }}"><button type="submit" class="btn btn-primary">{{ trans('page.cancel') }}</button></a>
        </div>
    </div>
@endsection
