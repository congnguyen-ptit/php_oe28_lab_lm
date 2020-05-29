@extends('admin.layouts.app')

@section('title', trans('page.edit'))

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('page.edit') }}&#58; {{ $book->name }}</h3>
                </div>
                <form role="form" id="editBookForm" method="POST" action="" data-url="{{ route('books.update', $book->id) }}">
                    @csrf
                    @method("PATCH")
                    <div class="box-body">
                        <div class="form-group">
                            <label>{{ trans('page.bn') }}</label>
                            <input type="text" class="form-control" name="name" value="{{ $book->name }}" required>
                            @error('name')
                            <div class="form-group has-error">
                                <span class="help-block">{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="col-md-4">
                                <label>{{ trans('page.author') }}</label>
                                <select name="user_id" required class="form-control">
                                    <option value="{{ $book->user_id }}">{{ $book->user->name }}</option>
                                    @foreach ($authors as $author)
                                        <option value="{{ $author->id }}">{{ $author->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>{{ trans('page.publisher') }}</label>
                                <select name="publisher_id" required class="form-control">
                                    <option value="{{ $book->publisher_id }}">{{ $book->publisher->name }}</option>
                                    @foreach ($publishers as $publisher)
                                        <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>{{ trans('page.category') }}</label>
                                <select name="category_id" required class="form-control">
                                    <option value="{{ $book->category_id }}">{{ $book->category->name }}</option>
                                    @foreach ($child_categories as $child)
                                        <option value="{{ $child->id }}">{{ $child->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('page.content') }}</label>
                            <textarea class="form-control" name="content" rows="7" required>{{ $book->content }}</textarea>
                            @error('content')
                            <div class="form-group has-error">
                                <span class="help-block">{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{ trans('page.description') }}</label>
                            <textarea class="form-control" name="description" rows="7">{{ $book->description }}</textarea>
                            @error('description')
                            <div class="form-group has-error">
                                <span class="help-block">{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="col-md-4">
                                <label>{{ trans('page.quantity') }}</label>
                                <input type="text" class="form-control" name="quantity" value="{{ $book->quantity }}" required>
                                @error('quantity')
                                <div class="form-group has-error">
                                    <span class="help-block">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-8">
                                <label>{{ trans('page.img') }}</label>
                                <input type="file" class="form-control" name="image" value="{{ $book->image }}">
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button class="btn-success btn" type="submit">{{ trans('page.save') }}
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                        </button>
                        <a href="{{ route('book.list') }}" class="btn btn-primary">{{ trans('page.cancel') }}</a>
                        <a href="#" data-url="{{ route('books.destroy', $book->id) }}" class="delete"><button class="btn btn-danger">{{ trans('page.delete') }}</button></a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
