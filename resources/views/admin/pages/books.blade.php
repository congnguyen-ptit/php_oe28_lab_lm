@extends('admin.layouts.app')

@section('title', trans('page.allB'))

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            {{ trans('page.books') }}
        </h1>
    </section>
    <div class="container">
        <div class="table-wrapper">
            <table class="table table-striped " cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="th-sm">{{ trans('page.id') }}
                        </th>
                        <th class="th-sm">{{ trans('page.name') }}
                        </th>
                        <th class="th-sm">{{ trans('page.author') }}
                        </th>
                        <th class="th-sm">{{ trans('page.quantity') }}
                        </th>
                        <th class="th-sm">{{ trans('page.publisher') }}
                        </th>
                        <th class="th-sm">{{ trans('page.category') }}
                        </th>
                        <th class="th-sm">{{ trans('page.action') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($books as $key => $book)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $book->name }}</td>
                        <td>{{ $book->user->name }}</td>
                        <td>{{ $book->quantity }}</td>
                        <td>{{ $book->publisher->name }}</td>
                        <td>{{ $book->category->name }}</td>
                        <td id="action">
                            <a href="{{ route('book.edit', $book->id) }}" >
                                <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                            </a>
                            <a href="#" data-url="{{ route('books.destroy', $book->id) }}" class="delete">
                                <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $books->links() }}
        </div>
    </div>
</div>
@endsection
