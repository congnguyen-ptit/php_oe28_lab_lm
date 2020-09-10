@extends('admin.layouts.app')

@section('title', trans('page.allc'))

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            {{ trans('page.categories') }}
        </h1>
    </section>
    <div class="container">
        <div class="table-wrapper">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="th-sm">&#35;
                        </th>
                        <th class="th-sm">{{ trans('page.cname') }}
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
                        <td>
                            @if ($category->parent_id == config('const.empty'))
                                {{ $category->name }}
                            @else
                                {{ $category->parent['name'] }}
                            @endif
                        </td>
                        <td>{{ $category->created_at }}</td>
                        <td id="action">
                            <a href="{{ route('category.edit', $category->id) }}">
                                <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                            </a>
                            <a href="javascript:;" data-url="{{ route('category.delete', $category->id) }}" class="delete">
                                <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $categories->links() }}
        </div>
    </div>
</div>
@endsection
