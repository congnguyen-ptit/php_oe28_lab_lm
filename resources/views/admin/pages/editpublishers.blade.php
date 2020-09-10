@extends('admin.layouts.app')

@section('title', trans('page.edit'))

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('page.edit') }}&#58; {{ $publisher->name }}</h3>
                </div>
                <form role="form" id="editPublisherForm" data-url="{{ route('publisher.save', $publisher->id) }}" action="" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="box-body">
                        <div class="form-group">
                            <label>{{ trans('page.n') }}</label>
                            <input type="text" class="form-control" name="name" value="{{ $publisher->name }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{ trans('page.location') }}</label>
                            <input type="text" class="form-control" name="location" value="{{ $publisher->location }}">
                            @error('location')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="box-footer">
                        <button class="btn-success btn" type="submit">{{ trans('page.save') }}
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                        </button>
                        <a href="{{ route('publisher.all') }}"><button type="submit" class="btn btn-primary">{{ trans('page.cancel') }}</button></a>
                        <a href="#" data-url="{{ route('publisher.delete', $publisher->id) }}" class="delete"><button class="btn btn-danger">{{ trans('page.delete') }}</button></a>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <div class="container">
        @if ($publisher->books->count() > config('const.empty'))
            <div class="form-row">
                <div class="container">
                    <div class="table-wrapper">
                        <table class="table table-striped " cellspacing="0" width="100%">
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
