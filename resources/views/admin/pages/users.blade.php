@extends('admin.layouts.app')

@section('title', "abc")

@section('content')
<div class="content-wrapper">
    <div class="container">
        <div class="table-wrapper">
            <table id="users-table" class="table table-striped " cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="th-sm">{{ trans('page.id') }}
                        </th>
                        <th class="th-sm">{{ trans('page.name') }}
                        </th>
                        <th class="th-sm">{{ trans('page.location') }}
                        </th>
                        <th class="th-sm">{{ trans('page.phonenumber') }}
                        </th>
                        <th class="th-sm">{{ trans('page.mail') }}
                        </th>
                        <th class="th-sm">{{ trans('page.created_at') }}
                        </th>
                        <th class="th-sm">{{ trans('page.action') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th class="th-sm">{{ trans('page.id') }}
                        </th>
                        <th class="th-sm">{{ trans('page.name') }}
                        </th>
                        <th class="th-sm">{{ trans('page.location') }}
                        </th>
                        <th class="th-sm">{{ trans('page.phonenumber') }}
                        </th>
                        <th class="th-sm">{{ trans('page.mail') }}
                        </th>
                        <th class="th-sm">{{ trans('page.created_at') }}
                        </th>
                        <th class="th-sm">{{ trans('page.action') }}
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@Stop

@push('script')
<script type="text/javascript">
$(function() {
    var table = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('user.data' ) }}",
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'location', name: 'location' },
            { data: 'phone_number', name: 'phone_number' },
            { data: 'email', name: 'email' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action' },
        ]
    });
});
</script>
@endpush
