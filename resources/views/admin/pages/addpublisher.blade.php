@extends('admin.layouts.app')

@section('title', trans('page.add'))

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                {{ trans('page.add') }}
            </h1>
        </section>
        <section class="content">
        <div class="row">
            <div class="box box-primary">
                <div class="box-header with-border">
                </div>
                <form role="form" action="" data-url="{{ route('publisher.store') }}" method="POST" id="addPubForm">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label>{{ trans('page.n') }}</label>
                            <input type="text" class="form-control" name="name">
                            <div class="form-group has-error">
                                <span class="help-block" id="name_error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('page.location') }}</label>
                            <input type="text" class="form-control" name="location">
                            <div class="form-group has-error">
                                <span class="help-block" id="location_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button class="btn-warning btn" name="submit" type="submit">{{ trans('page.con') }}
                        </button>
                        <a href="{{ route('publisher.all') }}"><button type="submit" class="btn btn-primary">{{ trans('page.cancel') }}</button></a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
