@extends('admin.layouts.app')

@section('title', trans('page.add'))

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
                    <h3 class="box-title">{{ trans('page.add') }}</h3>
                </div>
                <form role="form" data-url="{{ route('category.store') }}" method="POST" id="addCategoryForm">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label>{{ trans('page.cname') }}</label>
                            <input type="text" class="form-control" name="name">
                            <div class="form-group has-error">
                                <span class="help-block" id="name_error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('page.description') }}</label>
                            <textarea class="form-control" name="description" rows="7"></textarea required>
                            @error('description')
                            <div class="form-group has-error">
                                <span class="help-block">{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">{{ trans('page.category') }}</label>
                            <select name="parent_id" >
                                <option value="{{ config('const.empty') }}">{{ trans('page.newcategory') }}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button class="btn btn-warning" type="submit" >{{ trans('page.con') }}
                        </button>
                        <a href="{{ route('book.list') }}" class="btn btn-primary">{{ trans('page.cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
