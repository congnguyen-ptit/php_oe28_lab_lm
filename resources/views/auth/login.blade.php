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
                                                    <form class="login" method="POST" action="{{ route('login') }}">
                                                        @csrf
                                                        @if ($errors->any())
                                                        <p class="lead">{{ trans('auth.failed') }}</p>
                                                        @endif
                                                        <p class="form-row form-row-first input-required">
                                                            <input type="text"  id="username" name="username" class="input-text" placeholder="{{ trans('page.username') }}&#42;">
                                                         </p>
                                                        <p class="form-row form-row-last input-required">
                                                            <input type="password" id="password" name="password" class="input-text" placeholder="{{ trans('page.password') }}&#42;">
                                                        </p>
                                                        <div class="clear"></div>
                                                        <div class="password-form-row">
                                                            <p class="form-row input-checkbox">
                                                                <input type="checkbox" value="forever" id="rememberme" name="remember">
                                                                <label class="inline" for="rememberme">{{ trans('page.remember') }}</label>
                                                            </p>
                                                            <p class="lost_password">
                                                                <a href="#">{{ trans('page.forgot') }}</a>
                                                            </p>
                                                        </div>
                                                        <input type="submit" value="{{ trans('page.login') }}" name="login" class="button btn btn-default" />
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
                                                    <form class="login" method="POST" action="{{ route('register') }}">
                                                        @csrf
                                                        <p class="form-row form-row-first input-required">
                                                            <input type="text" id="username1" name="name" class="input-text" value="{{ old('name') }}" placeholder="{{ trans('page.name') }}&#42;">
                                                            @error('name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </p>
                                                        <p class="form-row form-row-first input-required">
                                                            <input type="text" id="username1" name="username" class="input-text" value="{{ old('username') }}" placeholder="{{ trans('page.username') }}&#42;">
                                                            @error('username')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </p>
                                                        <p class="form-row input-required">
                                                            <input type="password" id="password1" name="password" class="input-text"
                                                            required autocomplete="new-password" placeholder="{{ trans('page.password') }}&#42;">
                                                            @error('password')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </p>
                                                        <p class="form-row input-required">
                                                            <input type="password" id="password1" name="password_confirmation" class="input-text" required autocomplete="new-password" placeholder="{{ trans('page.passwordconfirmed') }}&#42;">
                                                        </p>
                                                        <p class="form-row form-row-first input-required">
                                                            <input type="text" id="username1" name="email" class="input-text" value="{{ old('email') }}" placeholder="{{ trans('page.mail') }}&#42;">
                                                            @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </p>
                                                        <p class="form-row form-row-first input-required">
                                                            <input type="text" id="username1" name="phone_number" class="input-text"
                                                            value="{{ old('phone_number') }}" placeholder="{{ trans('page.phonenumber') }}&#42;">
                                                            @error('phone_number')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </p>
                                                        <p class="form-row form-row-first input-required">
                                                            <input type="text" id="username1" name="apartment_number" class="input-text" value="{{ old('aparment_number') }}" placeholder="{{ trans('page.apartment_number') }}&#42;">
                                                            @error('apartment_number')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </p>
                                                        <p class="form-row form-row-first input-required">
                                                            <input type="text" id="username1" name="street" class="input-text" value="{{ old('street') }}" placeholder="{{ trans('page.street') }}&#42;">
                                                            @error('street')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </p>
                                                        <p class="form-row form-row-first input-required">
                                                            <input type="text" id="username1" name="ward" class="input-text" value="{{ old('ward') }}" placeholder="{{ trans('page.ward') }}&#42;">
                                                            @error('ward')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </p>
                                                        <p class="form-row form-row-first input-required">
                                                            <input type="text" id="username1" name="district" class="input-text" value="{{ old('district') }}" placeholder="{{ trans('page.district') }}&#42;">
                                                            @error('district')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </p>
                                                        <p class="form-row form-row-first input-required">
                                                            <input type="text" id="username1" name="city" class="input-text" value="{{ old('city') }}" placeholder="{{ trans('page.city') }}&#42;">
                                                            @error('city')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </p>
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
