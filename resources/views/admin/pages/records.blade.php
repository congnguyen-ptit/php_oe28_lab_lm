@extends('admin.layouts.app')

@section('title', trans('page.bookrequest'))

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
                        <th class="th-sm">{{ trans('page.user') }}
                        </th>
                        <th class="th-sm">{{ trans('page.book') }}
                        </th>
                        <th class="th-sm">{{ trans('page.start_date') }}
                        </th>
                        <th class="th-sm">{{ trans('page.end_date') }}
                        </th>
                        <th class="th-sm">{{ trans('page.status') }}
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
                    @foreach($records as $key => $record)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $record->user->name }}</td>
                        <td>{{ $record->book->name }}</td>
                        <td>{{ $record->start_date }}</td>
                        <td>{{ $record->end_date }}</td>
                        <td>
                            @if ($record->status == config('const.request'))
                                <span class="label label-warning">{{ trans('page.request') }}</span>
                            @elseif ($record->status == config('const.borrowed'))
                                <span class="label label-info">{{ trans('page.borrowed') }}</span>
                            @elseif ($record->status == config('const.returned'))
                                <span class="label label-success">{{ trans('page.returned') }}</span>
                            @elseif ($record->status == config('const.rejected'))
                                <span class="label label-danger">{{ trans('page.rejected') }}</span>
                            @endif
                        </td>
                        <td>{{ $record->created_at }}</td>
                        <td>{{ $record->updated_at }}</td>
                        <td id="action">
                            <a href="{{ route('record.detail', $record->id) }}" >
                                <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                            </a>
                            @if ($record->status == config('const.request'))
                            <a href="" data-url="{{ route('record.reject', $record->id) }}" class="reject" title="Reject">
                                <i class="fa fa-ban" aria-hidden="true"></i>
                            </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $records->links() }}
        </div>
    </div>
</div>
@endsection
