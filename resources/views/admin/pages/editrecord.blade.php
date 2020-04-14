@extends('admin.layouts.app')

@section('title', trans('page.rd', ['number' => $borrower_record->id]))

@section('content')
    <div class="content-wrapper">
        <div class="container">
            <br>
            <br>
            <div class="banner-header">
                <h1 class="btn btn-primary">{{ trans('page.rd', ['number' => $borrower_record->id]) }}</h1>
                @if (session('am'))
                    <span class="label label-warning">{{ session('am') }}</span>
                @endif
                @if (session('mm'))
                    <span class="label label-warning">{{ session('mm') }}</span>
                @endif
                @if (session('nm'))
                    <span class="label label-warning">{{ session('nm') }}</span>
                @endif
            </div>
            <br>
            <br>
            <form action="{{ route('record.reply', $borrower_record->id) }}" method="POST" name="user_product">
                @csrf
                @method('PATCH')
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <span class="badge badge-light"><h4>{{ trans('page.name') }}</h4></span>
                        <input type="text" class="form-control" name="user_id" value="{{ $borrower_record->user->name }}" disabled>
                    </div>
                    <div class="form-group col-md-4">
                        <span class="badge badge-light"><h4>{{ trans('page.book') }}</h4></span>
                        <input type="text" class="form-control" name="book_id" value="{{ $borrower_record->book->name }}" disabled>
                    </div>
                    <div class="form-group col-md-2">
                        <span class="badge badge-light"><h4>{{ trans('page.status') }}</h4></span>
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
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <span class="badge badge-light"><h4>{{ trans('page.start_date') }}</h4></span>
                        <input type="text" class="form-control" name="start_date" value="{{ $borrower_record->start_date }}" disabled>
                    </div>
                    <div class="form-group col-md-3">
                        <span class="badge badge-light"><h4>{{ trans('page.end_date') }}</h4></span>
                        <input type="text" class="form-control" name="end_date" value="{{ $borrower_record->end_date }}" disabled>
                    </div>
                    <div class="form-group col-md-3">
                        <span class="badge badge-light"><h4>{{ trans('page.created_at') }}</h4></span>
                        <input type="text" class="form-control" name="created_at" value="{{ $borrower_record->created_at }}" disabled>
                    </div>
                    <div class="form-group col-md-3">
                        <span class="badge badge-light"><h4>{{ trans('page.updated') }}</h4></span>
                        <input type="text" class="form-control" name="updated_at" value="{{ $borrower_record->updated_at }}" disabled>
                    </div>
                </div>
                @if ($borrower_record->status != config('const.returned') && $borrower_record->status != config('const.borrowed'))
                <p class="form-submit">
                    <button class="btn-info btn" name="submit" type="submit">{{ trans('page.con') }}</button>
                </p>
                @endif
            </form>
            <br>
            <a href="{{ route('record.list') }}" class="btn btn-primary" >{{ trans('page.back') }}</a>
            @if ($borrower_record->status != config('const.returned') && $borrower_record->status != config('const.borrowed'))
                <br>
                <br>
                <form action="{{ route('record.reject', $borrower_record->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button onclick="return confirm('Are you sure?')" class="btn btn-danger sm">
                        <i class="fa fa-ban" aria-hidden="true"></i>
                    </button>
                </form>
            @endif
            @if ($borrower_record->status == config('const.borrowed'))
                <br>
                <br>
                <form action="{{ route('record.return', $borrower_record->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button onclick="return confirm('Are you sure?')" class="btn btn-success sm">
                        <i class="fa fa-undo" aria-hidden="true"></i>
                    </button>
                </form>
            @endif
        </div>
        <br>
        <br>
        <div class="container">
            <div class="form-row">
                <div class="container">
                    <div class="table-wrapper">
                        <table id="records-table" class="table table-striped " cellspacing="0" width="100%">
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
                                        &#124;
                                        <a href="{{ route('record.delete', $record->id) }}" data-toggle="   tooltip">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
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
