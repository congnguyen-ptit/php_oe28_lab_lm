@extends('admin.layouts.app')

@section('title', trans('page.publishers'))

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            {{ trans('page.publishers') }}
        </h1>
    </section>
    <div class="container">
        <div class="table-wrapper">
            <table class="table table-striped " cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="th-sm">&#35;
                        </th>
                        <th class="th-sm">{{ trans('page.name') }}
                        </th>
                        <th class="th-sm">{{ trans('page.location') }}
                        </th>
                        <th class="th-sm">{{ trans('page.created_at') }}
                        </th>
                        <th class="th-sm">{{ trans('page.updated') }}
                        </th>
                        <th class="th-sm">{{ trans('page.action') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($publishers as $key => $publisher)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $publisher->name }}</td>
                        <td>{{ $publisher->location }}</td>
                        <td>{{ $publisher->created_at }}</td>
                        <td>{{ $publisher->updated_at }}</td>
                        <td id="action">
                            <a href="{{ route('publisher.edit', $publisher->id) }}" >
                                <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                            </a>
                            <a href="#" data-url="{{ route('publisher.delete', $publisher->id) }}" class="delete">
                                <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $publishers->links() }}
        </div>
    </div>
</div>
@endsection

