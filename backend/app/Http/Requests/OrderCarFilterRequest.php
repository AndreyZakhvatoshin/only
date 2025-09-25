<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderCarFilterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'start_time' => 'required|date_format:Y-m-d G',
            'end_time' => 'required|date_format:Y-m-d G|after:start_time',
            'comfort_level' => 'array',
            'comfort_level.*' => 'nullable|integer|between:1,5',
            'model_id' => 'array',
            'model_id.*' => 'nullable|integer|exists:car_models,id',
        ];
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated($key, $default);

        if (isset($data['model_id']) && is_array($data['model_id'])) {
            $data['model_id'] = array_map('intval', $data['model_id']);
        }

        if (isset($data['comfort_level']) && is_array($data['comfort_level'])) {
            $data['comfort_level'] = array_map('intval', $data['comfort_level']);
        }

        return $data;
    }
}
