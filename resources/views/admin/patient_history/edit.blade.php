@extends('layouts.admin')
@section('content')

<div class="card">
<div class="card-header card-header-primary">
    <h4 class="card-title">
        {{ trans('global.create') }} {{ trans('cruds.treatment.title') }}
    </h4>
</div>

<div class="card-body">
    <form action="{{ route('histories.store') }}" method="POST" enctype="multipart/form-data">
        <!-- <form action="{{ route('histories.update', [$cure->id]) }}" method="POST" enctype="multipart/form-data"> -->
       
        @csrf
        <div class="form-group">
                <label class="required" for="patient_id">{{ trans('cruds.treatment.fields.name') }}</label>
                <select class="form-control select2 {{ $errors->has('patient') ? 'is-invalid' : '' }}" name="patient_id" id="patient_id" required>
                    @foreach($patients as $id => $patient)
                        <option value="{{ $id }}" {{ ($cure->patient ? $cure->patient->id : old('patient_id')) == $id ? 'selected' : '' }}>{{ $patient }}</option>
                    @endforeach
                </select>
                @if($errors->has('patient'))
                    <span class="text-danger">{{ $errors->first('patient') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.treatment.fields.name_helper') }}</span>
            </div>
            <div class="form-group {{ $errors->has('blood_group') ? 'has-error' : '' }}">
                <label for="blood_group">{{ trans('cruds.treatment.fields.blood') }}*</label>
                <input type="text" id="blood_group" name="blood_group" class="form-control" value="{{ old('blood_group', $cure->blood_group) }}" required>
                @if($errors->has('blood_group'))
                <p class="help-block">
                    {{ $errors->first('blood_group') }}
                </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.treatment.fields.blood_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('blood_pressure') ? 'has-error' : '' }}">
                <label for="blood_pressure">{{ trans('cruds.treatment.fields.bloodp') }}*</label>
                <input type="text" id="blood_pressure" name="blood_pressure" class="form-control" value="{{ old('blood_pressure', $cure->blood_pressure) }}" required>
                @if($errors->has('blood_pressure'))
                <p class="help-block">
                    {{ $errors->first('blood_pressure') }}
                </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.treatment.fields.bloodp_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('weight') ? 'has-error' : '' }}">
                <label for="weight">{{ trans('cruds.treatment.fields.weight') }}*</label>
                <input type="text" id="weight" name="weight" class="form-control" value="{{ old('weight', $cure->weight) }}" required>
                @if($errors->has('weight'))
                <p class="help-block">
                    {{ $errors->first('weight') }}
                </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.treatment.fields.weight_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('temperature') ? 'has-error' : '' }}">
                <label for="temperature">{{ trans('cruds.treatment.fields.temp') }}*</label>
                <input type="text" id="temperature" name="temperature" class="form-control" value="{{ old('temperature', $cure->temperature) }}" required>
                @if($errors->has('temperature'))
                <p class="help-block">
                    {{ $errors->first('temperature') }}
                </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.treatment.fields.temp_helper') }}
                </p>
            </div>
            <div class="form-group">
                <label for="diseases">{{ trans('cruds.treatment.fields.disease') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('diseases') ? 'is-invalid' : '' }}" name="diseases[]" id="diseases" multiple>
                    @foreach($diseases as $id => $disease)
                        <option value="{{ $id }}" {{ (in_array($id, old('diseases', [])) || $cure->diseases->contains($id)) ? 'selected' : '' }}>{{ $disease }}</option>
                    @endforeach
                </select>
                @if($errors->has('diseases'))
                    <span class="text-danger">{{ $errors->first('diseases') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.treatment.fields.disease_helper') }}</span>
            </div>
                <div class="form-group">
                    <label>{{ trans('cruds.treatment.fields.xray') }}</label>
                    <select class="form-control {{ $errors->has('xray') ? 'is-invalid' : '' }}" name="xray" id="xray">
                        <option value disabled {{ old('xray', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Model\Admin\PatientHistory::XRAY_SELECT as $key => $label)
                    <option value="{{ $key }}" {{ old('xray', $cure->xray) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('xray'))
                    <span class="text-danger">{{ $errors->first('xray') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.treatment.fields.xray_helper') }}</span>
                </div>
                <div class="form-group">
                <label class="required" for="doctor_id">{{ trans('cruds.treatment.fields.doctor') }}</label>
                <select class="form-control select2 {{ $errors->has('doctor') ? 'is-invalid' : '' }}" name="doctor_id" id="doctor_id" required>
                    @foreach($doctors as $id => $doctor)
                        <option value="{{ $id }}" {{ ($cure->doctor ? $cure->doctor->id : old('doctor_id')) == $id ? 'selected' : '' }}>{{ $doctor }}</option>
                    @endforeach
                </select>
                @if($errors->has('doctor'))
                    <span class="text-danger">{{ $errors->first('doctor') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.treatment.fields.doctor_helper') }}</span>
            </div>
                    <div class="form-group">
                        <label>{{ trans('cruds.treatment.fields.operation') }}</label>
                        <select class="form-control {{ $errors->has('operation') ? 'is-invalid' : '' }}" name="operation" id="operation">
                            <option value disabled {{ old('operation', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Model\Admin\PatientHistory::OPERATION_SELECT as $key => $label)
                    <option value="{{ $key }}" {{ old('operation', $cure->operation) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('operation'))
                        <span class="text-danger">{{ $errors->first('operation') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.treatment.fields.operation_helper') }}</span>
                    </div>

                    <div class="form-group">
                        <label>{{ trans('cruds.treatment.fields.check_patient') }}</label>
                        <select class="form-control {{ $errors->has('check_patient') ? 'is-invalid' : '' }}" name="check_patient" id="check_patient">
                             <label>{{ trans('cruds.treatment.fields.check_patient') }}</label>
                            @foreach(App\Model\Admin\PatientHistory::CHECK_PATIENT_RADIO as $key => $label)
                            <option value="{{ $key }}" {{ old('check_patient', $cure->check_patient) === (string) $key ? 'checked' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('check_patient'))
                        <span class="text-danger">{{ $errors->first('check_patient') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.treatment.fields.check_patient_helper') }}</span>
                    </div>
                    <div class="form-group">
                <label for="medicines">{{ trans('cruds.treatment.fields.medicine') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('medicines') ? 'is-invalid' : '' }}" name="medicines[]" id="medicines" multiple>
                    @foreach($medicines as $id => $medicine)
                        <option value="{{ $id }}" {{ (in_array($id, old('medicines', [])) || $cure->medicines->contains($id)) ? 'selected' : '' }}>{{ $medicine }}</option>
                    @endforeach
                </select>
                @if($errors->has('medicines'))
                    <span class="text-danger">{{ $errors->first('medicines') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.treatment.fields.medicine_helper') }}</span>
            </div>

                    
                <div class="form-group {{ $errors->has('remark') ? 'has-error' : '' }}">
                    <label for="remark">{{ trans('cruds.treatment.fields.desc') }}</label>
                    <textarea id="remark" name="remark" class="form-control ">{!! old('remark', $cure->remark) !!}</textarea>
                    @if($errors->has('remark'))
                    <em class="invalid-feedback">
                        {{ $errors->first('remark') }}
                    </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.treatment.fields.desc_helper') }}
                    </p>
                </div>

                <div>
                    <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                </div>
            </form>
                </div>
            </div>
            @endsection
            @section('scripts')
            <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script> -->

            <script>
              $(function () {
                CKEDITOR.replace('remark');
                $(".textarea").wysihtml5();
            });
        </script>
        @stop