@extends('admin.layouts.app')

@section('title', trans('page.roles'))

@section('content')
<div class="content-wrapper">
    <div class="container">
        <div class="table-wrapper">
            <table class="table table-striped " cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="th-sm">&#35;
                        </th>
                        <th class="th-sm">{{ trans('page.name') }}
                        </th>
                        <th class="th-sm">{{ trans('page.description') }}
                        </th>
                        <th class="th-sm">{{ trans('page.created_at') }}
                        </th>
                        <th class="th-sm">{{ trans('page.action') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $key => $role)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->description }}</td>
                            <td>{{ $role->created_at }}</td>
                            <td>
                                <a href="{{ route('role.edit', $role->id) }}" >
                                    <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                                </a>
                                <a href="#" data-url="{{ route('role.delete', $role->id) }}" class="delete">
                                    <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
