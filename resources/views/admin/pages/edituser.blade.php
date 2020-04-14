@extends('admin.layouts.app')

@section('title', trans('page.edit'))

@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="banner-header">
                <br>
                <h1 class="btn btn-primary">{{ trans('page.edit') }}&#58; {{ $user->name }}</h1>
                @if (session('success'))
                    <span class="label label-success">{{ session('success') }}</span>
                @endif
            </div>
            <br>
            <br>
            <form action="{{ route('user.save', $user->id) }}" method="POST" name="user_product">
                @csrf
                @method('PATCH')
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <span class="badge badge-light"><h4>{{ trans('page.name') }}</h4></span>
                        <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                    </div>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group col-md-6">
                        <span class="badge badge-light"><h4>{{ trans('page.mail') }}</h4></span>
                        <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <span class="badge badge-light"><h4>{{ trans('page.phonenumber') }}</h4></span>
                        <input type="text" class="form-control" name="phone_number" value="{{ $user->phone_number }}">
                    </div>
                    @error('phone_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group col-md-6">
                         <span class="badge badge-light"><h4>{{ trans('page.username') }}</h4></span>
                        <input type="text" class="form-control" name="username" value="{{ $user->username }}">
                    </div>
                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                @foreach ($user->locations as $location)
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <span class="badge badge-light"><h4>{{ trans('page.apartment_number') }}</h4></span>
                        <input type="text" class="form-control" name="apartment_number[]" value="{{ $location->apartment_number }}">
                    </div>
                    @error('apartment_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group col-md-2">
                        <span class="badge badge-light"><h4>{{ trans('page.street') }}</h4></span>
                        <input type="text" class="form-control" name="street[]" value="{{ $location->street }}">
                    </div>
                    @error('street')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group col-md-2">
                        <span class="badge badge-light"><h4>{{ trans('page.ward') }}</h4></span>
                        <input type="text" class="form-control" name="ward[]" value="{{ $location->ward }}">
                    </div>
                    @error('ward')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group col-md-3">
                        <span class="badge badge-light"><h4>{{ trans('page.district') }}</h4></span>
                        <input type="text" class="form-control" name="district[]" value="{{ $location->district }}">
                    </div>
                    @error('district')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group col-md-3">
                        <span class="badge badge-light"><h4>{{ trans('page.city') }}</h4></span>
                        <input type="text" class="form-control" name="city[]" value="{{ $location->city }}">
                    </div>
                    @error('city')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                @endforeach
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <span class="badge badge-light"><h4>{{ trans('page.authority') }}</h4></span>
                        <select name="role_id">
                            <option value="{{ $user->role_id }}">{{ $user->role->name }}</option>
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @if ($user->books->count() > config('const.empty'))
                    <div class="form-row">
                        <div class="container">
                            <div class="table-wrapper">
                                <table id="records-table" class="table table-striped " cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="th-sm">{{ trans('page.id') }}
                                            </th>
                                            <th class="th-sm">{{ trans('page.code') }}
                                            </th>
                                            <th class="th-sm">{{ trans('page.book') }}
                                            </th>
                                            <th class="th-sm">{{ trans('page.publisher') }}
                                            </th>
                                            <th class="th-sm">{{ trans('page.category') }}
                                            </th>
                                            <th class="th-sm">{{ trans('page.quantity') }}
                                            </th>
                                            <th class="th-sm">{{ trans('page.description') }}
                                            </th>
                                            <th class="th-sm">{{ trans('page.created_at') }}
                                            </th>
                                            <th class="th-sm">{{ trans('page.updated') }}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user->books as $book)
                                        <tr>
                                            <td>{{ $book->id }}</td>
                                            <td>{{ $book->code }}</td>
                                            <td>{{ $book->name }}</td>
                                            <td>{{ $book->publisher->name }}</td>
                                            <td>{{ $book->category->name }}</td>
                                            <td>{{ $book->quantity }}</td>
                                            <td>{{ $book->description }}</td>
                                            <td>{{ $book->created_at }}</td>
                                            <td>{{ $book->updated_at }}</td>
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
                @endif
                <p class="form-submit">
                    <button class="btn-primary btn" name="submit" type="submit">{{ trans('page.save') }}
                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                    </button>
                </p>
            </form>
            <br>
            <a href="{{ route('user.list') }}"><button type="submit" class="btn btn-primary">{{ trans('page.cancel') }}</button></a>
            <br>
            <br>
            <form method="POST" action="{{ route('user.delete', $user->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger sm"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
            </form>
        </div>
        <br>
        <br>
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
