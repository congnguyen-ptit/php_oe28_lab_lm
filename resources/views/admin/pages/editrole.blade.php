@extends('admin.layouts.app')

@section('title', trans('page.edit'))

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('page.edit') }}&#58; {{ $role->name }}</h3>
                </div>
                <form role="form" id="editRoleForm" data-url="{{ route('role.save', $role->id) }}" method="POST" action="">
                    @csrf
                    @method("PATCH")
                    <div class="box-body">
                        <div class="form-group">
                            <label>{{ trans('page.rolename') }}</label>
                            <input type="text" class="form-control" name="name" value="{{ $role->name }}" required>
                            @error('name')
                                <div class="form-group has-error">
                                    <span class="help-block">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{ trans('page.description') }}</label>
                            <input type="text" class="form-control" name="description" value="{{ $role->description }}">
                            @error('description')
                                <div class="form-group has-error">
                                    <span class="help-block">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{ trans('page.permissions') }}</label>
                            @foreach ($permissions as $permission)
                                <div class="checkbox">
                                    <input type="checkbox" name="permission_id[]" class="perCheckbox" value="{{ $permission->id }}" {{ $role->permissions->contains($permission->id) ? 'checked' : '' }} />
                                    <label >{{ $permission->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="box-footer">
                        <button class="btn-success btn" type="submit">{{ trans('page.save') }}
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                        </button>
                        <a href="{{ route('role.list') }}" class="btn btn-primary">{{ trans('page.cancel') }}</a>
                        <a href="#" data-url="{{ route('role.delete', $role->id) }}" class="delete">
                            <button class="btn btn-danger">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
