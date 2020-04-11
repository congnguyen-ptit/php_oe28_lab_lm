@extends('admin.layouts.app')

@section('title', trans('page.allB'))

@section('content')
<div class="content-wrapper">
    <div class="container">
        <div class="table-wrapper">
            <table id="books-table" class="table table-striped " cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="th-sm">{{ trans('page.id') }}
                        </th>
                        <th class="th-sm">{{ trans('page.name') }}
                        </th>
                        <th class="th-sm">{{ trans('page.author') }}
                        </th>
                        <th class="th-sm">{{ trans('page.quantity') }}
                        </th>
                        <th class="th-sm">{{ trans('page.publisher') }}
                        </th>
                        <th class="th-sm">{{ trans('page.category') }}
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
