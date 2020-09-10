@extends('user.layouts.app')

@section('title', trans('page.myaccount'))

@section('content')
<section class="page-banner services-banner">
    <div class="container">
        <div class="banner-header">
            <h2>{{ trans('page.myaccount') }}</h2>
            <span class="underline center"></span>
            <p class="lead">{{ trans('page.sd') }}</p>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="{{ route('home')}}">{{trans('page.home') }}</a></li>
                <li>{{ trans('page.myaccount') }}</li>
            </ul>
        </div>
    </div>
</section>
<div id="content" class="site-content">
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <div class="books-media-gird">
                <div class="container">
                    <div class="row">
                        <br>
                        <br>
                        <h1>{{ trans('page.editaccount') }}</h1>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="text-center">
                                    <img src="images/smurf.png" class="avatar img-circle" alt="avatar">
                                </div>
                                <br>
                                <div class="text-center">
                                    <h2><span class="label label-info">{{ $user->role->name }}</span></h2>
                                </div>
                                <br>
                                @can('Create')
                                <br>
                                <div class="text-center">
                                    <a href="{{ route('user.book') }}" class="btn btn-warning">{{ trans('page.ab') }}</a>
                                </div>
                                @endcan
                            </div>
                            <div class="col-md-9 personal-info">
                                <br>
                                <h2><span class="label label-info">{{ trans('page.personal') }}</span></h2>
                                <br>
                                <br>
                                <form class="form-horizontal" role="form" action="" data-url="{{ route('user.save', $user->id) }}" id="editForm" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">{{ trans('page.name') }}</label>
                                        <div class="col-lg-8">
                                            <input class="form-control" type="text" value="{{ $user->name }}" name="name">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">{{ trans('page.authority') }}</label>
                                            <div class="col-lg-8">
                                                <select name="role_id" class="form-control">
                                                    <option value="{{ $user->role_id }}">{{ $user->role->name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">{{ trans('page.username') }}</label>
                                        <div class="col-lg-8">
                                            <input class="form-control" type="text" value="{{ $user->username }}" name="username">
                                            @error('username')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">{{ trans('page.mail') }}</label>
                                        <div class="col-lg-8">
                                            <input class="form-control" type="text" value="{{ Auth::user()->email }}" name="email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">{{ trans('page.phonenumber') }}</label>
                                        <div class="col-lg-8">
                                            <input class="form-control" type="text" value="{{ $user->phone_number }}" name="phone_number">
                                            @error('phone_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="role_id" value="{{ $user->role_id }}">
                                    </div>
                                    <div class="row">
                                        @foreach ($user->locations as $location)
                                        <div class="col-md-12"s>
                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">{{ trans('page.apartment_number') }}</label>
                                                <div class="col-lg-8">
                                                    <input class="form-control" type="text" value="{{ $location->apartment_number }}" name="apartment_number[]">
                                                    @error('apartment_number')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">{{ trans('page.street') }}</label>
                                                <div class="col-lg-8">
                                                    <input class="form-control" type="text" value="{{ $location->street }}" name="street[]">
                                                    @error('street')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">{{ trans('page.ward') }}</label>
                                                <div class="col-lg-8">
                                                    <input class="form-control" type="text" value="{{ $location->ward }}" name="ward[]">
                                                    @error('ward')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">{{ trans('page.district') }}</label>
                                                <div class="col-lg-8">
                                                    <input class="form-control" type="text" value="{{ $location->district }}" name="district[]">
                                                    @error('district')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">{{ trans('page.city') }}</label>
                                                <div class="col-lg-8">
                                                    <input class="form-control" type="text" value="{{ $location->city }}" name="city[]">
                                                    @error('city')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach


                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label"></label>
                                        <div class="col-md-8">
                                            <button type="submit" class="btn btn-primary">
                                                <span><i class="fa fa-floppy-o" aria-hidden="true"></i></span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
