@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.edit') }} {{ trans('cruds.western.title_singular') }}
        </h4>
    </div>

    <div class="card-body">
        <form action="{{ route('patients.update', [$patient->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.patient.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($patient) ? $patient->name : '') }}" required>
                @if($errors->has('name'))
                    <p class="help-block">
                        {{ $errors->first('name') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.patient.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('disease_id') ? 'has-error' : '' }}">
                    <label for="disease_id">{{ trans('cruds.patient.fields.special') }}*</label>
                    <select name="disease_id" id="disease_id" class="form-control select2" required>
                        @foreach($doctors as $id => $member)
                            <option value="{{ $id }}" {{ (isset($patient) && $patient->member ? $patient->member->id : old('disease_id')) == $id ? 'selected' : '' }}>{{ $member }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('disease_id'))
                        <em class="invalid-feedback">
                            {{ $errors->first('disease_id') }}
                        </em>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('age') ? 'has-error' : '' }}">
                <label for="age">{{ trans('cruds.patient.fields.age') }}*</label>
                <input type="text" id="age" name="age" class="form-control" value="{{ old('name', isset($patient) ? $patient->age : '') }}" required>
                @if($errors->has('age'))
                    <p class="help-block">
                        {{ $errors->first('age') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.patient.fields.age_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                <label for="phone">{{ trans('cruds.patient.fields.phone') }}*</label>
                <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', isset($patient) ? $patient->phone : '') }}" required>
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
                <input type="text" id="address" name="address" class="form-control" value="{{ old('address', isset($patient) ? $patient->address : '') }}" required>
                @if($errors->has('address'))
                    <p class="help-block">
                        {{ $errors->first('address') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.patient.fields.email_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('remark') ? 'has-error' : '' }}">
                <label for="remark">{{ trans('cruds.patient.fields.desc') }}</label>
                <textarea id="remark" name="remark" class="form-control ">{{ old('remark', isset($patient) ? $patient->remark : '') }}</textarea>
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
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>

<script>
  $(function () {
    CKEDITOR.replace('remark');
    $(".textarea").wysihtml5();
});
</script>
@stop