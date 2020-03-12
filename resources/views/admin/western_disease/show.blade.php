@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.show') }} {{ trans('cruds.western_disease.title') }}
        </h4>
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.western_disease.fields.id') }}
                        </th>
                        <td>
                            {{ $disease->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.western_disease.fields.name') }}
                        </th>
                        <td>
                            {{ $disease->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.western_disease.fields.desc') }}
                        </th>
                        <td>
                            {!! htmlspecialchars_decode($disease->description) !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>

        <nav class="mb-3">
            <div class="nav nav-tabs">

            </div>
        </nav>
        <div class="tab-content">

        </div>
    </div>
</div>
@endsection
