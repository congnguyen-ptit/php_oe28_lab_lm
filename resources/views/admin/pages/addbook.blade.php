@extends('admin.layouts.app')

@section('title', trans('page.add'))

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('page.create') }}</h3>
                </div>
                <form role="form" action="" method="POST" id="addBookForm" data-url="{{ route('books.store') }}">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label>{{ trans('page.bn') }}</label>
                            <input type="text" class="form-control" name="name">
                            <div class="form-group has-error">
                                <span class="help-block" id="name_error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4">
                                <label>{{ trans('page.author') }}</label>
                                <select name="user_id">
                                    <option value="{{ trans('page.author') }}">{{ trans('page.cus') }}</option>
                                    @foreach ($authors as $author)
                                        <option value="{{ $author->id }}">{{ $author->name }}</option>
                                    @endforeach
                                </select>
                                <div class="form-group has-error">
                                    <span class="help-block" id="user_error"></span>
                                </div>
                                <a href="{{ route('user.add') }}" data-toggle="tooltip"><i class="fa fa-plus-square-o" aria-hidden="true"></i></a>
                            </div>
                            <div class="col-md-4">
                                <label>{{ trans('page.publisher') }}</label>
                                <select name="publisher_id">
                                    <option value="{{ trans('page.publisher') }}">{{ trans('page.cps') }}</option>
                                    @foreach ($publishers as $publisher)
                                        <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                                    @endforeach
                                </select>
                                <div class="form-group has-error">
                                    <span class="help-block" id="publisher_error"></span>
                                </div>
                                <a href="{{ route('publisher.add') }}" data-toggle="tooltip"><i class="fa fa-plus-square-o" aria-hidden="true"></i></a>
                            </div>
                            <div class="col-md-4">
                                <label>{{ trans('page.category') }}</label>
                                <select name="category_id">
                                    <option value="{{ trans('page.category') }}">{{ trans('page.ccs') }}</option>
                                    @foreach ($child_categories as $child)
                                        <option value="{{ $child->id }}">{{ $child->name }}</option>
                                    @endforeach
                                </select>
                                <div class="form-group has-error">
                                    <span class="help-block" id="category_error"></span>
                                </div>
                                <a href="{{ route('category.add') }}" data-toggle="tooltip"><i class="fa fa-plus-square-o" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('page.content') }}</label>
                            <textarea class="form-control" name="content" rows="7"></textarea>
                            <div class="form-group has-error">
                                <span class="help-block" id="content_error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('page.description') }}</label>
                            <textarea class="form-control" name="description" rows="7"></textarea>
                            <div class="form-group has-error">
                                <span class="help-block" id="description_error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4">
                                <label>{{ trans('page.quantity') }}</label>
                                <input type="text" class="form-control" name="quantity">
                                <div class="form-group has-error">
                                    <span class="help-block" id="quantity_error"></span>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <label>{{ trans('page.img') }}</label>
                                <input type="file" class="form-control" name="image">
                            </div>
                            <div class="form-group has-error">
                                <span class="help-block" id="image_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button class="btn-success btn" name="submit" type="submit">{{ trans('page.con') }}
                        </button>
                        <a href="{{ route('book.list') }}" class="btn btn-primary">{{ trans('page.cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
