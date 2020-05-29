@extends('admin.layouts.app')

@section('title', trans('page.edit'))

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            {{ trans('page.categories') }}
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('page.edit') }}</h3>
                </div>
                <form role="form" id="editCategoryForm" data-url="{{ route('category.save', $category->id) }}" method="POST" action="">
                    @csrf
                    @method("PATCH")
                    <div class="box-body">
                        <div class="form-group">
                            <label>{{ trans('page.cname') }}</label>
                            <input type="text" class="form-control" name="name" value="{{ $category->name }}" required="">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{ trans('page.description') }}</label>
                            <textarea class="form-control" name="description" rows="7">{{ $category->description }}</textarea required>
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
                                @foreach ($categories as $categoryi)
                                    <option value="{{ $categoryi->id }}">{{ $categoryi->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button class="btn btn-success">{{ trans('page.save') }}
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                        </button>
                        <a href="{{ route('category.list') }}" class="btn btn-primary">{{ trans('page.cancel') }}</a>
                        <a href="#" data-url="{{ route('category.delete', $category->id) }}" class="delete"><button class="btn btn-danger">{{ trans('page.delete') }}</button></a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
