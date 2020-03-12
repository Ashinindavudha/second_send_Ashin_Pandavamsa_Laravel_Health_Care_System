@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.show') }} {{ trans('cruds.treatment.title') }}
        </h4>
    </div>


    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.treatment.fields.id') }}
                        </th>
                        <td>
                            {{ $history->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.treatment.fields.name') }}
                        </th>
                        <td>
                            {{ $history->patient->name ?? '' }}
                        </td>
                    </tr>
                    
                    <tr>
                        <th>
                            {{ trans('cruds.treatment.fields.disease') }}
                        </th>
                         <td>
                            @foreach($history->diseases as $key => $item)
                            <span class="badge badge-info">{{ $item->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.treatment.fields.blood') }}
                        </th>
                        <td>
                            {{ $history->blood_group }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.treatment.fields.bloodp') }}
                        </th>
                        <td>
                            {{ $history->blood_pressure }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.treatment.fields.weight') }}
                        </th>
                        <td>
                            {{ $history->weight }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.treatment.fields.temp') }}
                        </th>
                        <td>
                            {{ $history->temperature }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.treatment.fields.xray') }}
                        </th>
                        <td>
                            {{ App\Model\Admin\PatientHistory::XRAY_SELECT[$history->xray] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.treatment.fields.operation') }}
                        </th>
                        <td>
                            {{ App\Model\Admin\PatientHistory::OPERATION_SELECT[$history->operation] ?? '' }}
                        </td>
                    </tr>
                     <tr>
                        <th>
                            {{ trans('cruds.treatment.fields.doctor') }}
                        </th>
                        <td>
                            {{ $history->doctor->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.treatment.fields.medicine') }}
                        </th>
                        <td>
                            @foreach($history->medicines as $key => $medicine)
                                <span class="label label-info">{{ $medicine->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.treatment.fields.check_patient') }}
                        </th>
                        <td>
                            {{ App\Model\Admin\PatientHistory::CHECK_PATIENT_RADIO[$history->check_patient] ?? '' }}
                        </td>
                    </tr>
                    
                    <tr>
                        <th>
                            {{ trans('cruds.treatment.fields.desc') }}
                        </th>
                        <td>
                            {!! htmlspecialchars_decode($history->remark) !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.treatment.fields.start_treatment_date') }}
                        </th>
                        <td>
                            {{ $history->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.treatment.fields.updated_at') }}
                        </th>
                        <td>
                            {{ $history->updated_at }}
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
