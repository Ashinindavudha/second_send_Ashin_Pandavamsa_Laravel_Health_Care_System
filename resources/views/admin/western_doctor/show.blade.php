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
                            {{ trans('cruds.western_doctor.fields.id') }}
                        </th>
                        <td>
                            {{ $surgeon->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.western_doctor.fields.name') }}
                        </th>
                        <td>
                            {{ $surgeon->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.western_doctor.fields.disease') }}
                        </th>
                         <td>
                            @foreach($surgeon->diseases as $key => $item)
                            <span class="badge badge-info">{{ $item->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.western_doctor.fields.day') }}
                        </th>
                        <td>
                            {{ $surgeon->duty_day }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.western_doctor.fields.duty_time') }}
                        </th>
                        <td>
                            {{ $surgeon->duty_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.western_doctor.fields.phone') }}
                        </th>
                        <td>
                            {{ $surgeon->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.western_doctor.fields.email') }}
                        </th>
                        <td>
                            {{ $surgeon->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.western_doctor.fields.desc') }}
                        </th>
                        <td>
                            {!! htmlspecialchars_decode($surgeon->description) !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.western_doctor.fields.created_at') }}
                        </th>
                        <td>
                            {{ $surgeon->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.western_doctor.fields.updated_at') }}
                        </th>
                        <td>
                            {{ $surgeon->updated_at }}
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
