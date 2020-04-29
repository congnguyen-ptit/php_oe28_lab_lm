@extends('admin.layouts.app')

@section('title', trans('page.allc'))

@section('content')
<div class="content-wrapper">
    <div class="container">
        <div class="table-wrapper">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="th-sm">{{ trans('page.id') }}
                        </th>
                        <th class="th-sm">{{ trans('page.name') }}
                        </th>
                        <th class="th-sm">{{ trans('page.description') }}
                        </th>
                        <th class="th-sm">{{ trans('page.parent') }}
                        </th>
                        <th class="th-sm">{{ trans('page.created_at') }}
                        </th>
                        <th class="th-sm">{{ trans('page.action') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $key => $category)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>{{ $category->parent_id }}</td>
                        <td>{{ $category->created_at }}</td>
                        <td id="action">
                            <a href="{{ route('category.edit', $category->id) }}" class="edit open-modal" data-toggle="modal">
                                <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                            </a>
                            <a onclick="event.preventDefault();deleteCategoryForm({{$category->id}});" href="#" class="delete" data-toggle="modal">
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

@include('admin.pages.categoryedit')
@endsection
