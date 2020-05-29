@extends('admin.layouts.app')

@section('title', trans('page.rd', ['number' => $borrower_record->id]))

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('page.edit') }}&#58; {{ $borrower_record->id }}</h3>
                </div>
                <form role="form" id="editRecordForm" action="" data-url="{{ route('record.reply', $borrower_record->id) }}" method="POST">
                    @csrf
                    @method("PATCH")
                    <div class="box-body">
                        <div class="form-group">
                            <label>{{ trans('page.name') }}</label>
                            <input type="text" class="form-control" name="user_id" value="{{ $borrower_record->user->name }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('page.book') }}</label>
                            <input type="text" class="form-control" name="book_id" value="{{ $borrower_record->book->name }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('page.status') }}</label>
                            @if ($borrower_record->status == config('const.request'))
                            <span class="label label-warning">{{ trans('page.request') }}</span>
                            @elseif ($borrower_record->status == config('const.borrowed'))
                            <span class="label label-info">{{ trans('page.borrowed') }}</span>
                            @elseif ($borrower_record->status == config('const.returned'))
                            <span class="label label-success">{{ trans('page.returned') }}</span>
                            @elseif ($borrower_record->status == config('const.rejected'))
                            <span class="label label-danger">{{ trans('page.rejected') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{ trans('page.start_date') }}</label>
                            <input type="text" class="form-control" name="start_date" value="{{ $borrower_record->start_date }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('page.end_date') }}</label>
                            <input type="text" class="form-control" name="end_date" value="{{ $borrower_record->end_date }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('page.created_at') }}</label>
                            <input type="text" class="form-control" name="created_at" value="{{ $borrower_record->created_at }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('page.updated') }}</label>
                            <input type="text" class="form-control" name="updated_at" value="{{ $borrower_record->updated_at }}" disabled>
                        </div>
                    </div>
                    <div class="box-footer">
                        @if ($borrower_record->status != config('const.returned') && $borrower_record->status != config('const.borrowed') && $borrower_record->status != config('const.rejected'))
                            <button class="btn-info btn" type="submit">{{ trans('page.con') }}</button>
                        @endif
                        @if ($borrower_record->status == config('const.borrowed') && $borrower_record->status != config('const.rejected'))
                            <a href="#" data-url="{{ route('record.return', $borrower_record->id) }}" class="return">
                                <button class="btn-success btn">
                                    <i class="fa fa-undo" aria-hidden="true"></i>
                                </button>
                            </a>
                        @endif
                        @if ($borrower_record->status != config('const.returned') && $borrower_record->status != config('const.borrowed') && $borrower_record->status != config('const.rejected'))
                            <a href="#" data-url="{{ route('record.reject', $borrower_record->id) }}" class="reject">
                                <button class="btn btn-danger sm">
                                    <i class="fa fa-ban" aria-hidden="true"></i>
                                </button>
                            </a>
                        @endif
                        <a href="{{ route('record.list') }}" class="btn btn-primary" >{{ trans('page.back') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="form-row">
            <div class="container">
                <div class="table-wrapper">
                    <table class="table table-striped " cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="th-sm">{{ trans('page.id') }}
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
                                <th class="th-sm">{{ trans('page.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user->borrowerRecords as $record)
                            <tr>
                                <td>{{ $record->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $record->book->name }}</td>
                                <td>{{ $record->start_date }}</td>
                                <td>{{ $record->end_date }}</td>
                                @if ($record->status == config('const.request'))
                                    <td><span class="label label-warning">{{ trans('page.request') }}</span></td>
                                @elseif ($record->status == config('const.borrowed'))
                                    <td><span class="label label-info">{{ trans('page.borrowed') }}</span></td>
                                @elseif ($record->status == config('const.returned'))
                                    <td><span class="label label-success">{{ trans('page.returned') }}</span></td>
                                @elseif ($record->status == config('const.rejected'))
                                    <td><span class="label label-danger">{{ trans('page.rejected') }}</span></td>
                                @endif
                                <td>{{ $record->created_at }}</td>
                                <td>{{ $record->updated_at }}</td>
                                <td><a href="{{ route('record.detail', $record->id) }}"data-toggle="tooltip">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
