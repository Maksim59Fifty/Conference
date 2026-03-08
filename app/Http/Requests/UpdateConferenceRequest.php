<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateConferenceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'lecturers' => 'required|string|max:500',
            'date' => 'required|date',
            'time' => 'required|string|max:20',
            'address' => 'required|string|max:500',
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => __('validation.attributes.title'),
            'description' => __('validation.attributes.description'),
            'lecturers' => __('validation.attributes.lecturers'),
            'date' => __('validation.attributes.date'),
            'time' => __('validation.attributes.time'),
            'address' => __('validation.attributes.address'),
        ];
    }
}
