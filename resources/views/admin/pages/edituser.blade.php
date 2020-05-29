@extends('admin.layouts.app')

@section('title', trans('page.edit'))

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('page.edit') }}&#58; {{ $user->name }}</h3>
                </div>
                <form role="form" data-url="{{ route('user.save', $user->id) }}" action="" method="POST" id="editUserForm">
                    @csrf
                    @method('PATCH')
                    <div class="box-body">
                        <div class="form-group">
                            <label>{{ trans('page.name') }}</label>
                            <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                            @error('name')
                                <div class="form-group has-error">
                                    <span class="help-block">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{ trans('page.mail') }}</label>
                            <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                            @error('email')
                                <div class="form-group has-error">
                                    <span class="help-block">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{ trans('page.phonenumber') }}</label>
                            <input type="text" class="form-control" name="phone_number" value="{{ $user->phone_number }}" required>
                            @error('phone_number')
                                <div class="form-group has-error">
                                    <span class="help-block">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{ trans('page.username') }}</label>
                            <input type="text" class="form-control" name="username" value="{{ $user->username }}" required>
                            @error('username')
                                <div class="form-group has-error">
                                    <span class="help-block">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        @foreach ($user->locations as $location)
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label>{{ trans('page.apartment_number') }}</label>
                                    <input type="text" class="form-control" name="apartment_number[]" value="{{ $location->apartment_number }}">
                                </div>
                                @error('apartment_number')
                                    <div class="form-group has-error">
                                        <span class="help-block">{{ $message }}</span>
                                    </div>
                                @enderror
                                <div class="form-group col-md-2">
                                    <label>{{ trans('page.street') }}</label>
                                    <input type="text" class="form-control" name="street[]" value="{{ $location->street }}">
                                </div>
                                @error('street')
                                    <div class="form-group has-error">
                                        <span class="help-block">{{ $message }}</span>
                                    </div>
                                @enderror
                                <div class="form-group col-md-2">
                                    <label>{{ trans('page.ward') }}</label>
                                    <input type="text" class="form-control" name="ward[]" value="{{ $location->ward }}">
                                </div>
                                @error('ward')
                                    <div class="form-group has-error">
                                        <span class="help-block">{{ $message }}</span>
                                    </div>
                                @enderror
                                <div class="form-group col-md-2">
                                    <label>{{ trans('page.district') }}</label>
                                    <input type="text" class="form-control" name="district[]" value="{{ $location->district }}">
                                </div>
                                @error('district')
                                    <div class="form-group has-error">
                                        <span class="help-block">{{ $message }}</span>
                                    </div>
                                @enderror
                                <div class="form-group col-md-2">
                                    <label>{{ trans('page.city') }}</label>
                                    <input type="text" class="form-control" name="city[]" value="{{ $location->city }}">
                                </div>
                                @error('city')
                                    <div class="form-group has-error">
                                        <span class="help-block">{{ $message }}</span>
                                    </div>
                                @enderror
                                <div class="form-group col-md-2">
                                    <a href="#" class="delete_location" >
                                        <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>{{ trans('page.authority') }}</label>
                                <select name="role_id" class="form-control">
                                    <option value="{{ $user->role_id }}">{{ $user->role->name }}</option>
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button class="btn-success btn" type="submit">{{ trans('page.save') }}
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                        </button>
                        <a href="{{ route('user.list') }}" class="btn btn-primary">{{ trans('page.cancel') }}</a>
                        <a href="#" data-url="{{ route('user.delete', $user->id) }}" class="delete"><button class="btn btn-danger">{{ trans('page.delete') }}</button></a>
                    </div>
                </form>
            </div>
        </div>
    </section>
    @if ($user->borrowerRecords->count() != config('const.empty'))
        <div class="container">
            <div class="banner-header">
                <br>
                <h1 class="btn btn-primary">{{ trans('page.history') }}</h1>
            </div>
            <br>
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
                                        &#124;
                                        <a href="{{ route('record.delete', $record->id) }}" data-toggle="   tooltip">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if (session('am'))
                             <label>{{ session('am') }}</label>
                        @endif
                        @if (session('mm'))
                             <label>{{ session('mm') }}</label>
                        @endif
                        @if (session('nm'))
                             <label>{{ session('nm') }}</label>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif
</div>
@endsection
