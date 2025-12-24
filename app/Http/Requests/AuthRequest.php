<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

//Добавить нового пользвователя
class AuthRequest extends FormRequest
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
            'login' => 'required|min:2|max:255',
            'passwd' => ['required', 'min:4', 'max:255'],
            'is_admin' => 'required|boolean'
        ];
    }

    public function messages() {
        return [
            'login.required' => 'Login required',
            'passwd.required' => 'Password required'
        ];
    }
}
