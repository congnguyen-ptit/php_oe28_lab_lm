@extends('admin.layouts.app')

@section('title', trans('page.home'))

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            {{ trans('page.dashboard') }}
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua">
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ trans('page.members') }}</span>
                        <span class="info-box-number">{{ $users->count() }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red">
                        <i class="fa fa-book" aria-hidden="true"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ trans('page.books') }}</span>
                        <span class="info-box-number">{{ $books->count() }}</span>
                    </div>
                </div>
            </div>
            <div class="clearfix visible-sm-block"></div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green">
                        <i class="fa fa-users" aria-hidden="true"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ trans('page.publishers') }}</span>
                        <span class="info-box-number">{{ $publishers->count() }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow">
                        <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ trans('page.total') }}</span>
                        <span class="info-box-number">{{ $borrower_records->count() }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">{{ trans('page.latest') }}</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                  <th>{{ trans('page.code') }}</th>
                                  <th>{{ trans('page.book') }}</th>
                                  <th>{{ trans('page.quantity') }}</th>
                                  <th>{{ trans('page.created_at') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($latest_books as $latest_book)
                                <tr>
                                    <td><a href="pages/examples/invoice.html">{{ $latest_book->code }}</a></td>
                                    <td>{{ $latest_book->name }}</td>
                                    <td><span class="label label-success">{{ $latest_book->quantity }}</span></td>
                                    <td>
                                    <div class="sparkbar" data-color="#00a65a" data-height="20">{{ $latest_book->created_at }}</div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer clearfix">
                    <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">{{ trans('page.add') }}</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="info-box bg-yellow">
                    <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><a href="{{ route('record.request') }}">{{ trans('page.request') }}</a></span>
                        <span class="info-box-number">{{ $request->count() }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="fa fa-check" aria-hidden="true"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><a href="{{ route('record.borrowed') }}">{{ trans('page.borrowed') }}</a></span>
                        <span class="info-box-number">{{ $borrowed->count() }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box bg-green">
                    <span class="info-box-icon"><i class="fa fa-undo" aria-hidden="true"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><a href="{{ route('record.returned') }}">{{ trans('page.returned') }}</a></span>
                        <span class="info-box-number">{{ $returned->count() }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box bg-red">
                    <span class="info-box-icon"><i class="fa fa-ban" aria-hidden="true"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><a href="{{ route('record.rejected') }}">{{ trans('page.rejected') }}</a></span>
                        <span class="info-box-number">{{ $rejected->count() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
