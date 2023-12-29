<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TaskListRequest extends FormRequest
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
            'subject' => 'required|max:255',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required',
            'priority' => 'required',
        ];
    }

    public function messages() 
    {
        return [
            'subject.required' => 'Subject is required !!',
            'subject.max' => 'Subject is not more than 255 characters !!',
            'description.required' => 'Description is required !!',
            'start_date.required' => 'Start date is required !!',
            'end_date.required' => 'End date is required !!',
            'status.required' => 'Status is required !!',
            'priority.required' => 'Priority is required !!',
        ];
    }
}
