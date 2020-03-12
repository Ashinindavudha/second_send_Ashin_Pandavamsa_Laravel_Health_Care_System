extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.treatment.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.treatment.fields.id') }}
                        </th>
                        <td>
                            {{ $treatment->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.treatment.fields.patient') }}
                        </th>
                        <td>
                            {{ $treatment->patient->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.treatment.fields.blood_group') }}
                        </th>
                        <td>
                            {{ $treatment->blood_group }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.treatment.fields.blood_pressure') }}
                        </th>
                        <td>
                            {{ $treatment->blood_pressure }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.treatment.fields.weight') }}
                        </th>
                        <td>
                            {{ $treatment->weight }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.treatment.fields.temperature') }}
                        </th>
                        <td>
                            {{ $treatment->temperature }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.treatment.fields.doctor') }}
                        </th>
                        <td>
                            {{ $treatment->doctor->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.treatment.fields.medicine') }}
                        </th>
                        <td>
                            @foreach($treatment->medicines as $key => $medicine)
                                <span class="label label-info">{{ $medicine->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.treatment.fields.check_patient') }}
                        </th>
                        <td>
                            {{ App\Model\Admin\PatientHistory::CHECK_PATIENT_RADIO[$treatment->check_patient] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.treatment.fields.start_treatment_date') }}
                        </th>
                        <td>
                            {{ $treatment->start_treatment_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.treatment.fields.remark') }}
                        </th>
                        <td>
                            {!! $treatment->remark !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.treatment.fields.xray') }}
                        </th>
                        <td>
                            {{ App\Model\Admin\PatientHistory::XRAY_SELECT[$treatment->xray] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.treatment.fields.operation') }}
                        </th>
                        <td>
                            {{ App\Model\Admin\PatientHistory::OPERATION_SELECT[$treatment->operation] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.treatment.fields.disease') }}
                        </th>
                        <td>
                            @foreach($treatment->diseases as $key => $disease)
                                <span class="label label-info">{{ $disease->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
            </div>
        </div>
    </div>
</div>



@endsection