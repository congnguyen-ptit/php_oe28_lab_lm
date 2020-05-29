@extends('admin.layouts.app')

@section('title', trans('page.allus'))

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            {{ $title }}
        </h1>
    </section>
    <div class="container">
        <div class="table-wrapper">
            <table class="table table-striped " cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="th-sm">&#35;
                        </th>
                        <th class="th-sm">{{ trans('page.code') }}
                        </th>
                        <th class="th-sm">{{ trans('page.name') }}
                        </th>
                        <th class="th-sm">{{ trans('page.location') }}
                        </th>
                        <th class="th-sm">{{ trans('page.phonenumber') }}
                        </th>
                        <th class="th-sm">{{ trans('page.mail') }}
                        </th>
                        <th class="th-sm">{{ trans('page.created_at') }}
                        </th>
                        <th class="th-sm">{{ trans('page.action') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $key => $user)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $user->code }}</td>
                        <td>{{ $user->name }}</td>
                        <td>
                            @foreach ($user->locations as $location)
                            &#8227;
                            {{ $location->apartment_number }}&#44;
                            {{ $location->street }}&#44;
                            {{ $location->ward }}&#44;
                            {{ $location->district }}&#44;
                            {{ $location->city }}&#46;
                            <br>
                            @endforeach
                        </td>
                        <td>{{ $user->phone_number }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td id="action">
                            <a href="{{ route('user.edit', $user->id) }}" >
                                <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                            </a>
                            <a href="#" data-url="{{ route('user.delete', $user->id) }}" class="delete" >
                                <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
