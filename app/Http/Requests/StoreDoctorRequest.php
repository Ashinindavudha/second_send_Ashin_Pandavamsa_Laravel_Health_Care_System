<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Model\Admin\Doctor;


class StoreDoctorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        abort_if(Gate::denies('western_doctor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'name'       => [
                'required'],
            'diseases.*' => [
                'integer'],
            'diseases'   => [
                'required',
                'array'],
            'duty_time'  => [
                'date_format:' . config('panel.time_format'),
                'nullable'],
        ];

    }
}
