@extends('admin.layouts.app')

@section('title', trans('page.rt'))

@section('content')
<div class="content-wrapper">
    <div class="container">
        <div class="table-wrapper">
            <table id="requests-table" class="table table-striped " cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="th-sm">{{ trans('page.id') }}
                        </th>
                        <th class="th-sm">{{ trans('page.user') }}
                        </th>
                        <th class="th-sm">{{ trans('page.book') }}
                        </th>
                        <th class="th-sm">{{ trans('page.start_date') }}
                        </th>
                        <th class="th-sm">{{ trans('page.end_date') }}
                        </th>
                        <th class="th-sm">{{ trans('page.status') }}
                        </th>
                        <th class="th-sm">{{ trans('page.created_at') }}
                        </th>
                        <th class="th-sm">{{ trans('page.updated') }}
                        </th>
                        <th class="th-sm">{{ trans('page.action') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
