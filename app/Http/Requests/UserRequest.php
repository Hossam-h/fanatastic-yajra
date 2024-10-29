<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . ($this->user->id ?? 'NULL'),
            'password' => [
                $this->isMethod('post') ? 'required' : 'nullable',
                'confirmed', // Checks that `password_confirmation` matches `password`
                'min:8'
            ],
        ];
    
        return $rules;
    }
}
