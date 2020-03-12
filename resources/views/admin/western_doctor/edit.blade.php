@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.create') }} {{ trans('cruds.western_doctor.title_singular') }}
        </h4>
    </div>

    <div class="card-body">
       <form method="POST" action="{{ route('westerndoctors.update', [$physician->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.western_doctor.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $physician->name) }}" required>
                @if($errors->has('name'))
                <p class="help-block">
                    {{ $errors->first('name') }}
                </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.western_doctor.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.western_doctor.fields.gender') }}</label>
                <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender" id="gender">
                    <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Model\Admin\Doctor::GENDER_SELECT as $key => $label)
                    <option value="{{ $key }}" {{ old('gender', $physician->gender) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('gender'))
                <span class="text-danger">{{ $errors->first('gender') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.western_doctor.fields.gender_helper') }}</span>
            </div>
            <div class="form-group {{ $errors->has('diseases') ? 'has-error' : '' }}">
                <label for="diseases">{{ trans('cruds.western_doctor.fields.disease') }}*
                    <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label>
                    <select name="diseases[]" id="diseases" class="form-control select2" multiple="multiple" required>
                        @foreach($diseases as $id => $disease)
                        <option value="{{ $id }}" {{ (in_array($id, old('diseases', [])) || $physician->diseases->contains($id)) ? 'selected' : '' }}>{{ $disease }}</option>
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

                <div class="form-group">
                    <label>{{ trans('cruds.western_doctor.fields.day') }}</label>
                    <select class="form-control {{ $errors->has('duty_day') ? 'is-invalid' : '' }}" name="duty_day" id="duty_day">
                        <option value disabled {{ old('duty_day', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Model\Admin\Doctor::DUTY_DAY_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('duty_day', $physician->duty_day) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('duty_day'))
                    <span class="text-danger">{{ $errors->first('duty_day') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.western_doctor.fields.day_helper') }}</span>
                </div>

                <div class="form-group">
                <label for="duty_time">{{ trans('cruds.western_doctor.fields.duty_time') }}</label>
                <input class="form-control timepicker {{ $errors->has('duty_time') ? 'is-invalid' : '' }}" type="text" name="duty_time" id="duty_time" value="{{ old('duty_time', $physician->duty_time) }}">
                @if($errors->has('duty_time'))
                    <span class="text-danger">{{ $errors->first('duty_time') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.western_doctor.fields.duty_time_helper') }}</span>
            </div>
            <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                <label for="phone">{{ trans('cruds.western_doctor.fields.phone') }}*</label>
                <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', $physician->phone) }}">
                @if($errors->has('phone'))
                <p class="help-block">
                    {{ $errors->first('phone') }}
                </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.western_doctor.fields.phone_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email">{{ trans('cruds.western_doctor.fields.email') }}*</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $physician->email) }}">
                @if($errors->has('phone'))
                <p class="help-block">
                    {{ $errors->first('email') }}
                </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.western_doctor.fields.email_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
            <label for="description">{{ trans('cruds.western_disease.fields.desc') }}</label>
            <textarea id="description" name="description" class="form-control ">{!! old('description', $physician->description) !!}</textarea>
            @if($errors->has('description'))
            <em class="invalid-feedback">
                {{ $errors->first('description') }}
            </em>
            @endif
            <p class="helper-block">
                {{ trans('cruds.western_disease.fields.desc_helper') }}
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
<!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
 -->
<script>
$(function () {
CKEDITOR.replace('description');
$(".textarea").wysihtml5();
});
</script>
@stop