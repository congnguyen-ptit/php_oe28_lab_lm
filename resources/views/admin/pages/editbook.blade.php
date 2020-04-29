@extends('admin.layouts.app')

@section('title', trans('page.edit'))

@section('content')
    <div class="content-wrapper">
        <div class="container">
            <br>
            <br>
            <div class="banner-header">
                <h1 class="btn btn-primary">{{ trans('page.edit') }}&#58; {{ $book->name }}</h1>
                @if (session('success'))
                    <span class="label label-success">{{ session('success') }}</span>
                @endif
            </div>
            <br>
            <br>
            <form action="{{ route('books.update', $book->id) }}" method="POST" name="user_product">
                @csrf
                @method('PATCH')
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>{{ trans('page.bn') }}</label>
                        <input type="text" class="form-control" name="name" value="{{ $book->name }}" required>
                    </div>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group col-md-2">
                        <label>{{ trans('page.author') }}</label>
                        <select name="user_id" required>
                            <option value="{{ $book->user_id }}">{{ $book->user->name }}</option>
                            @foreach ($authors as $author)
                                <option value="{{ $author->id }}">{{ $author->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label>{{ trans('page.publisher') }}</label>
                        <select name="publisher_id" required>
                            <option value="{{ $book->publisher_id }}">{{ $book->publisher->name }}</option>
                            @foreach ($publishers as $publisher)
                                <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label>{{ trans('page.category') }}</label>
                        <select name="category_id" required>
                            <option value="{{ $book->category_id }}">{{ $book->category->name }}</option>
                            @foreach ($child_categories as $child)
                                <option value="{{ $child->id }}">{{ $child->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>{{ trans('page.content') }}</label>
                        <textarea class="form-control" name="content" rows="7" required>{{ $book->content }}</textarea>
                    </div>
                    @error('content')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group col-md-6">
                        <label>{{ trans('page.description') }}</label>
                        <textarea class="form-control" name="description" rows="7">{{ $book->description }}</textarea>
                    </div>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group col-md-3">
                        <label>{{ trans('page.quantity') }}</label>
                        <input type="text" class="form-control" name="quantity" value="{{ $book->quantity }}" required>
                    </div>
                    @error('quantity')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group col-md-8">
                        <label>{{ trans('page.img') }}</label>
                        <input type="file" class="form-control" name="image" value="{{ $book->image }}">
                    </div>
                </div>
                <p class="form-submit">
                    <button class="btn-primary btn" name="submit" type="submit">{{ trans('page.save') }}
                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                    </button>
                </p>
            </form>
            <br>
            <a href="{{ route('book.list') }}"><button type="submit" class="btn btn-primary">{{ trans('page.cancel') }}</button></a>
                <br>
                <br>
            <form action="{{ route('book.list', $book->id) }}" method="POST">
                @csrf
                @method("DELETE")
                <button onclick="return confirm('Are you sure?')" class="btn btn-danger sm">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </button>
            </form>
        </div>
    </div>
@endsection
