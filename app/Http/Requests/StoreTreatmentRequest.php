<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Model\Admin\Treatment;
use Gate;
use Symfony\Component\HttpFoundation\Response;


class StoreTreatmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        abort_if(Gate::denies('treatment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            
            'medicines.*'          => [
                'integer'],
            'medicines'            => [
                'array'],
            'start_treatment_date' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable'],
            'diseases.*'           => [
                'integer'],
            'diseases'             => [
                'array'],
        ];

    }

}
