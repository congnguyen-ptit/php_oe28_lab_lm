@extends('admin.layouts.app')

@section('title', trans('page.add'))

@section('content')
    <div class="content-wrapper">
        <section class="content">
        <div class="row">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('page.auser') }}</h3>
                </div>
                <form role="form" action="" method="POST" id="addUserForm" data-url="{{ route('user.store') }}">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label>{{ trans('page.name') }}</label>
                            <input type="text" class="form-control" name="name">
                            <div class="form-group has-error">
                                <span class="help-block" id="name_error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('page.mail') }}</label>
                            <input type="email" class="form-control" name="email">
                            <div class="form-group has-error">
                                <span class="help-block" id="email_error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('page.phonenumber') }}</label>
                            <input type="text" class="form-control" name="phone_number">
                            <div class="form-group has-error">
                                <span class="help-block" id="phone_error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('page.username') }}</label>
                            <input type="text" class="form-control" name="username">
                            <div class="form-group has-error">
                                <span class="help-block" id="username_error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('page.password') }}</label>
                            <input type="password" class="form-control" name="password">
                            <div class="form-group has-error">
                                <span class="help-block" id="password_error"></span>
                            </div>
                            <label>{{ trans('page.passwordconfirmed') }}</label>
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label>{{ trans('page.apartment_number') }}</label>
                                <input type="text" class="form-control" name="apartment_number">
                            </div>
                            <div class="form-group has-error">
                                <span class="help-block" id="apartment_number_error"></span>
                            </div>
                            <div class="form-group col-md-2">
                                <label>{{ trans('page.street') }}</label>
                                <input type="text" class="form-control" name="street">
                            </div>
                            <div class="form-group has-error">
                                <span class="help-block" id="street_error"></span>
                            </div>
                            <div class="form-group col-md-2">
                                <label>{{ trans('page.ward') }}</label>
                                <input type="text" class="form-control" name="ward">
                            </div>
                            <div class="form-group has-error">
                                <span class="help-block" id="ward_error"></span>
                            </div>
                            <div class="form-group col-md-3">
                                <label>{{ trans('page.district') }}</label>
                                <input type="text" class="form-control" name="district">
                            </div>
                            <div class="form-group has-error">
                                <span class="help-block" id="district_error"></span>
                            </div>
                            <div class="form-group col-md-3">
                                <label>{{ trans('page.city') }}</label>
                                <input type="text" class="form-control" name="city">
                            </div>
                            <div class="form-group has-error">
                                <span class="help-block" id="city_error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('page.authority') }}</label>
                            <select class="form-control" name="role_id">
                                @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button class="btn-warning btn" name="submit" type="submit">{{ trans('page.con') }}
                        </button>
                        <a href="{{ route('user.list') }}"  class="btn btn-primary">{{ trans('page.cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
