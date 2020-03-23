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
                                                        <p class="lead">{{ trans('auth.wrong') }}</p>
                                                        @endif
                                                        <p class="form-row form-row-first input-required">
                                                            <label>
                                                                <span class="first-letter">{{ trans('page.username') }}</span>
                                                                <span class="second-letter">&#42;</span>
                                                            </label>
                                                            <input type="text"  id="username" name="username" class="input-text">
                                                         </p>
                                                        <p class="form-row form-row-last input-required">
                                                            <label>
                                                                <span class="first-letter">{{ trans('page.password') }}</span>
                                                                <span class="second-letter">&#42;</span>
                                                            </label>
                                                            <input type="password" id="password" name="password" class="input-text">
                                                        </p>
                                                        <div class="clear"></div>
                                                        <div class="password-form-row">
                                                            <p class="form-row input-checkbox">
                                                                <input type="checkbox" value="forever" id="rememberme" name="rememberme">
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
                                                        <h2>{{ trans('page.create') }}</h2>
                                                        <span class="underline left"></span>
                                                        <p></p>
                                                    </div>
                                                    <form class="login" method="POST">
                                                        @csrf
                                                        <p class="form-row form-row-first input-required">
                                                            <label>
                                                                <span class="first-letter">{{ trans('page.username') }}</span>
                                                                <span class="second-letter">&#42;</span>
                                                            </label>
                                                            <input type="text" id="username1" name="username" class="input-text">
                                                        </p>
                                                        <p class="form-row input-required">
                                                            <label>
                                                                <span class="first-letter">{{ trans('page.password') }}</span>
                                                                <span class="second-letter">&#42;</span>
                                                            </label>
                                                            <input type="password" id="password1" name="password" class="input-text">
                                                        </p>
                                                        <p class="form-row form-row-first input-required">
                                                            <label>
                                                                <span class="first-letter">{{ trans('page.mail') }}</span>
                                                                <span class="second-letter">&#42;</span>
                                                            </label>
                                                            <input type="text" id="username1" name="username" class="input-text">
                                                        </p>
                                                        <p class="form-row form-row-first input-required">
                                                            <label>
                                                                <span class="first-letter">{{ trans('page.phonenumber') }}</span>
                                                                <span class="second-letter">&#42;</span>
                                                            </label>
                                                            <input type="text" id="username1" name="username" class="input-text">
                                                        </p>
                                                        <p class="form-row form-row-first input-required">
                                                            <label>
                                                                <span class="first-letter">{{ trans('page.apartment_number') }}</span>
                                                                <span class="second-letter">&#42;</span>
                                                            </label>
                                                            <input type="text" id="username1" name="username" class="input-text">
                                                        </p>
                                                        <p class="form-row form-row-first input-required">
                                                            <label>
                                                                <span class="first-letter">{{ trans('page.street') }}</span>
                                                                <span class="second-letter">&#42;</span>
                                                            </label>
                                                            <input type="text" id="username1" name="username" class="input-text">
                                                        </p>
                                                        <p class="form-row form-row-first input-required">
                                                            <label>
                                                                <span class="first-letter">{{ trans('page.ward') }}</span>
                                                                <span class="second-letter">&#42;</span>
                                                            </label>
                                                            <input type="text" id="username1" name="username" class="input-text">
                                                        </p>
                                                        <p class="form-row form-row-first input-required">
                                                            <label>
                                                                <span class="first-letter">{{ trans('page.district') }}</span>
                                                                <span class="second-letter">&#42;</span>
                                                            </label>
                                                            <input type="text" id="username1" name="username" class="input-text">
                                                        </p>
                                                        <p class="form-row form-row-first input-required">
                                                            <label>
                                                                <span class="first-letter">{{ trans('page.city') }}</span>
                                                                <span class="second-letter">&#42;</span>
                                                            </label>
                                                            <input type="text" id="username1" name="username" class="input-text">
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
