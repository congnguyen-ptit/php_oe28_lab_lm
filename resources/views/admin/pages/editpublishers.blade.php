@extends('admin.layouts.app')

@section('title', trans('page.edit'))

@section('content')
    <div class="content-wrapper">
        <div class="container">
            <br>
            <br>
            <div class="banner-header">
                <h1 class="btn btn-primary">{{ trans('page.edit') }}&#58; {{ $publisher->name }}</h1>
                @if (session('success'))
                    <span class="label label-success">{{ session('success') }}</span>
                @endif
            </div>
            <br>
            <br>
            <form action="{{ route('publisher.save', $publisher->id) }}" method="POST" name="user_product">
                @csrf
                @method('PATCH')
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <span class="badge badge-light"><h4>{{ trans('page.n') }}</h4></span>
                        <input type="text" class="form-control" name="name" value="{{ $publisher->name }}">
                    </div>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group col-md-6">
                        <span class="badge badge-light"><h4>{{ trans('page.location') }}</h4></span>
                        <input type="text" class="form-control" name="location" value="{{ $publisher->location }}">
                    </div>
                    @error('location')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <p class="form-submit">
                    <button class="btn-primary btn" name="submit" type="submit">{{ trans('page.save') }}
                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                    </button>
                </p>
            </form>
            <br>
            <a href="{{ route('publisher.all') }}"><button type="submit" class="btn btn-primary">{{ trans('page.cancel') }}</button></a>
            <br>
            <br>
            <form action="{{ route('publisher.delete', $publisher->id) }}" method="POST">
                @csrf
                @method("DELETE")
                <button onclick="return confirm('Are you sure?')" class="btn btn-danger sm">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </button>
            </form>
        </div>
        <br>
        <br>
        <div class="container">
            @if ($publisher->books->count() > config('const.empty'))
                <div class="form-row">
                    <div class="container">
                        <div class="table-wrapper">
                            <table id="records-table" class="table table-striped " cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="th-sm">{{ trans('page.id') }}
                                        </th>
                                        <th class="th-sm">{{ trans('page.code') }}
                                        </th>
                                        <th class="th-sm">{{ trans('page.book') }}
                                        </th>
                                        <th class="th-sm">{{ trans('page.category') }}
                                        </th>
                                        <th class="th-sm">{{ trans('page.quantity') }}
                                        </th>
                                        <th class="th-sm">{{ trans('page.description') }}
                                        </th>
                                        <th class="th-sm">{{ trans('page.created_at') }}
                                        </th>
                                        <th class="th-sm">{{ trans('page.updated') }}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($publisher->books as $book)
                                    <tr>
                                        <td>{{ $book->id }}</td>
                                        <td>{{ $book->code }}</td>
                                        <td>{{ $book->name }}</td>
                                        <td>{{ $book->category->name }}</td>
                                        <td>{{ $book->quantity }}</td>
                                        <td>{{ $book->description }}</td>
                                        <td>{{ $book->created_at }}</td>
                                        <td>{{ $book->updated_at }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
