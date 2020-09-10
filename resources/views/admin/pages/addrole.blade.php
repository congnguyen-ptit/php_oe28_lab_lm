@extends('admin.layouts.app')

@section('title', trans('page.add'))

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('page.add') }}</h3>
                </div>
                <form role="form" action="" method="POST" data-url="{{ route('role.store') }}" id="addRoleForm">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label>{{ trans('page.rolename') }}</label>
                            <input type="text" class="form-control" name="name">
                            <div class="form-group has-error">
                                <span class="help-block" id="name_error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('page.description') }}</label>
                            <input type="text" class="form-control" name="description">
                            <div class="form-group has-error">
                                <span class="help-block" id="description_error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('page.permissions') }}</label>
                            @foreach ($permissions as $permission)
                                <div class="checkbox">
                                    <input type="checkbox" class="perCheckbox" name="permission_id[]" value="{{ $permission->id }}">
                                    <label >{{ $permission->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="box-footer">
                        <button class="btn-warning btn" name="submit" type="submit">{{ trans('page.con') }}
                        </button>
                        <a href="{{ route('role.list') }}" class="btn btn-primary">{{ trans('page.cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
