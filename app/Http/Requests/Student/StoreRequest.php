<?php

namespace App\Http\Requests\Student;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->role === 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => [
                'required',
                'integer',
                'exists:users,id,role,student',
                'unique:students,user_id',
            ],
            'nisn' => ['required', 'string', 'max:255', 'unique:students,nisn'],
            'nis' => ['required', 'string', 'max:255', 'unique:students,nis'],
            'class' => ['required', 'string', 'max:255'],
            'major' => ['required', 'string', 'max:255'],
            'school_year' => ['required', 'string', 'max:255'],
        ];
    }
}
