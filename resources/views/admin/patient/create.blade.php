@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.create') }} {{ trans('cruds.patient.title_singular') }}
        </h4>
    </div>

    <div class="card-body">
        <form action="{{ route('patients.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.patient.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($doctor) ? $doctor->name : '') }}" required>
                @if($errors->has('name'))
                <p class="help-block">
                    {{ $errors->first('name') }}
                </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.patient.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('age') ? 'has-error' : '' }}">
                <label for="age">{{ trans('cruds.patient.fields.age') }}*</label>
                <input type="text" id="age" name="age" class="form-control" value="{{ old('age', isset($doctor) ? $doctor->age : '') }}" required>
                @if($errors->has('age'))
                <p class="help-block">
                    {{ $errors->first('age') }}
                </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.patient.fields.age_helper') }}
                </p>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.patient.fields.gender') }}</label>
                <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender" id="gender">
                    <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Model\Admin\Patient::GENDER_SELECT as $key => $label)
                    <option value="{{ $key }}" {{ old('gender', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('gender'))
                <span class="text-danger">{{ $errors->first('gender') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.gender_helper') }}</span>
            </div>
            <div class="form-group {{ $errors->has('diseases') ? 'has-error' : '' }}">
                <label for="diseases">{{ trans('cruds.western_doctor.fields.disease') }}*
                    <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label>
                    <select name="diseases[]" id="diseases" class="form-control select2" multiple="multiple" required>
                        @foreach($diseases as $id => $disease)
                        <option value="{{ $id }}" {{ in_array($id, old('diseases', [])) ? 'selected' : '' }}>{{ $disease }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('diseases'))
                    <p class="help-block">
                        {{ $errors->first('diseases') }}
                    </p>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.western_doctor.fields.disease_helper') }}
                    </p>
                </div>

                <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                    <label for="phone">{{ trans('cruds.patient.fields.phone') }}*</label>
                    <input type="text" id="phone" name="phone" class="form-control" value="{{ old('name', isset($doctor) ? $doctor->phone : '') }}" required>
                    @if($errors->has('phone'))
                    <p class="help-block">
                        {{ $errors->first('phone') }}
                    </p>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.patient.fields.phone_helper') }}
                    </p>
                </div>
                <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                    <label for="address">{{ trans('cruds.patient.fields.address') }}*</label>
                    <input type="textarea" id="address" name="address" class="form-control" value="{{ old('name', isset($doctor) ? $doctor->address : '') }}" required>
                    @if($errors->has('phone'))
                    <p class="help-block">
                        {{ $errors->first('address') }}
                    </p>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.patient.fields.address_helper') }}
                    </p>
                </div>
                <div class="form-group {{ $errors->has('remark') ? 'has-error' : '' }}">
                    <label for="remark">{{ trans('cruds.patient.fields.desc') }}</label>
                    <textarea id="remark" name="remark" class="form-control "></textarea>
                    @if($errors->has('remark'))
                    <em class="invalid-feedback">
                        {{ $errors->first('remark') }}
                    </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.patient.fields.desc_helper') }}
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