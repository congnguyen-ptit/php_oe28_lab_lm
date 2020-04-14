@extends('admin.layouts.app')

@section('title', trans('page.add'))

@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="banner-header">
                <br>
                <h1 class="btn btn-primary">{{ trans('page.auser') }}</h1>
            </div>
            <br>
            <br>
            <form action="{{ route('user.store') }}" method="POST" name="user_product">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <span class="badge badge-light"><h4>{{ trans('page.name') }}</h4></span>
                        <input type="text" class="form-control" name="name" required value="{{ old('name') }}">
                    </div>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <span class="badge badge-light"><h4>{{ trans('page.mail') }}</h4></span>
                        <input type="email" class="form-control" name="email" required value="{{ old('email') }}">
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                         <span class="badge badge-light"><h4>{{ trans('page.username') }}</h4></span>
                        <input type="text" class="form-control" name="username" required value="{{ old('username') }}">
                    </div>
                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <span class="badge badge-light"><h4>{{ trans('page.phonenumber') }}</h4></span>
                        <input type="text" class="form-control" name="phone_number" required value="{{ old('phone_number') }}">
                    </div>
                    @error('phone_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <span class="badge badge-light"><h4>{{ trans('page.password') }}</h4></span>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="form-group col-md-6">
                        <span class="badge badge-light"><h4>{{ trans('page.passwordconfirmed') }}</h4></span>
                        <input type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <span class="badge badge-light"><h4>{{ trans('page.apartment_number') }}</h4></span>
                        <input type="text" class="form-control" name="apartment_number" required >
                    </div>
                    @error('apartment_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group col-md-2">
                        <span class="badge badge-light"><h4>{{ trans('page.street') }}</h4></span>
                        <input type="text" class="form-control" name="street" required>
                    </div>
                    @error('street')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group col-md-2">
                        <span class="badge badge-light"><h4>{{ trans('page.ward') }}</h4></span>
                        <input type="text" class="form-control" name="ward" required>
                    </div>
                    @error('ward')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group col-md-3">
                        <span class="badge badge-light"><h4>{{ trans('page.district') }}</h4></span>
                        <input type="text" class="form-control" name="district" required>
                    </div>
                    @error('district')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group col-md-3">
                        <span class="badge badge-light"><h4>{{ trans('page.city') }}</h4></span>
                        <input type="text" class="form-control" name="city" required>
                    </div>
                    @error('city')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <span class="badge badge-light"><h4>{{ trans('page.authority') }}</h4></span>
                        <select name="role_id">
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <p class="form-submit">
                    <button class="btn-primary btn" name="submit" type="submit">{{ trans('page.con') }}</button>
                </p>
            </form>
            <br>
            <a href="{{ route('user.list') }}"><button type="submit" class="btn btn-primary">{{ trans('page.cancel') }}</button></a>
        </div>
    </div>
@endsection
