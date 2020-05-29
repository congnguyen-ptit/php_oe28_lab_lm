@extends('user.layouts.app')

@section('title', trans('page.login'))

@section('content')
    <section class="page-banner services-banner">
            <div class="container">
                <div class="banner-header">
                    <h2>{{ trans('page.login') }}</h2>
                    <span class="underline center"></span>
                    <p class="lead">{{ trans('page.sd') }}</p>
                </div>
                <div class="breadcrumb">
                    <ul>
                        <li><a href="{{ route('home') }}">{{ trans('page.home') }}</a></li>
                        <li>{{ trans('login') }}</li>
                    </ul>
                </div>
            </div>
    </section>
    <div id="content" class="site-content">
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
                <div class="signin-main">
                    <div class="container">
                        <div class="woocommerce">
                            <div class="woocommerce-login">
                                <div class="company-info signin-register">
                                    <div class="col-md-5 col-md-offset-1 border-dark-left">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="company-detail bg-dark margin-left">
                                                    <div class="signin-head">
                                                        <h2>{{ trans('page.log_in')}}</h2>
                                                        <span class="underline left"></span>
                                                    </div>
                                                    <form method="POST" action="" id="loginForm"  data-url="{{ route('login') }}">
                                                        @csrf
                                                        <div class="form-group has-error">
                                                            <span class="help-block" id="login_error"></span>
                                                        </div>
                                                        <p class="form-row form-row-first input-required">
                                                            <input type="text"  id="username" name="username" class="input-text" placeholder="{{ trans('page.username') }}&#42;">
                                                         </p>
                                                        <p class="form-row form-row-last input-required">
                                                            <input type="password" id="password" name="password" class="input-text" placeholder="{{ trans('page.password') }}&#42;">
                                                        </p>
                                                        <div class="clear"></div>
                                                        <div class="password-form-row">
                                                            <p class="form-row input-checkbox">
                                                                <input type="checkbox" id="rememberme" name="remember">
                                                                <label class="inline" for="rememberme">{{ trans('page.remember') }}</label>
                                                            </p>
                                                        </div>
                                                        <input type="submit" value="{{ trans('page.login') }}" name="login" class="button btn btn-default" />
                                                        <a href="{{ route('login.service', ['google']) }}" class="button btn btn-defaul">Login with Google</a>
                                                        <a href="{{ route('login.service', ['facebook']) }}" class="button btn btn-defaul">Login with Facebook</a>
                                                        <div class="clear"></div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 border-dark new-user">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="company-detail new-account bg-light margin-right">
                                                    <div class="new-user-head">
                                                        <h2>{{ trans('page.createaccount') }}</h2>
                                                        <span class="underline left"></span>
                                                        <p></p>
                                                    </div>
                                                    <form id="registerForm" method="POST" action="" data-url="{{ route('register') }}">
                                                        @csrf
                                                        <p class="form-row form-row-first input-required">
                                                            <input type="text" name="name" class="input-text" value="{{ old('name') }}" placeholder="{{ trans('page.name') }}&#42;">
                                                            @error('name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </p>
                                                        <p class="form-row form-row-first input-required">
                                                            <input type="text" name="username" value="{{ old('username') }}" placeholder="{{ trans('page.username') }}&#42;">
                                                            <div class="form-group has-error">
                                                                <span class="help-block" id="username_error"></span>
                                                            </div>
                                                        </p>
                                                        <p class="form-row input-required">
                                                            <input type="password"  name="password"
                                                            required autocomplete="new-password" placeholder="{{ trans('page.password') }}&#42;">
                                                        </p>
                                                        <p class="form-row input-required">
                                                            <input type="password" name="password_confirmation" class="input-text" required autocomplete="new-password" placeholder="{{ trans('page.passwordconfirmed') }}&#42;">
                                                        </p>
                                                        <p class="form-row form-row-first input-required">
                                                            <input type="text" name="email" class="input-text" value="{{ old('email') }}" placeholder="{{ trans('page.mail') }}&#42;">
                                                            <div class="form-group has-error">
                                                                <span class="help-block" id="email_error"></span>
                                                            </div>
                                                        </p>
                                                        <p class="form-row form-row-first input-required">
                                                            <input type="text" name="phone_number" class="input-text"
                                                            value="{{ old('phone_number') }}" placeholder="{{ trans('page.phonenumber') }}&#42;">
                                                            <div class="form-group has-error">
                                                                <span class="help-block" id="phone_error"></span>
                                                            </div>
                                                        </p>
                                                        <p class="form-row form-row-first input-required">
                                                            <input type="text" name="apartment_number" class="input-text" value="{{ old('aparment_number') }}" placeholder="{{ trans('page.apartment_number') }}&#42;">
                                                            @error('apartment_number')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </p>
                                                        <p class="form-row form-row-first input-required">
                                                            <input type="text" name="street" class="input-text" value="{{ old('street') }}" placeholder="{{ trans('page.street') }}&#42;">
                                                            @error('street')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </p>
                                                        <p class="form-row form-row-first input-required">
                                                            <input type="text" name="ward" class="input-text" value="{{ old('ward') }}" placeholder="{{ trans('page.ward') }}&#42;">
                                                            @error('ward')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </p>
                                                        <p class="form-row form-row-first input-required">
                                                            <input type="text" name="district" class="input-text" value="{{ old('district') }}" placeholder="{{ trans('page.district') }}&#42;">
                                                            @error('district')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </p>
                                                        <p class="form-row form-row-first input-required">
                                                            <input type="text" name="city" class="input-text" value="{{ old('city') }}" placeholder="{{ trans('page.city') }}&#42;">
                                                            @error('city')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </p>
                                                        <input type="hidden" name="role_id" value="1">
                                                        <div class="clear"></div>
                                                        <input type="submit" value="Signup" name="signup" class="button btn btn-default">
                                                        <div class="clear"></div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
