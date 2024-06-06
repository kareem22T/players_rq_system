<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            "name" => "required",
            "phone" => "required",
            "sec_phone" => "nullable",
            "position" => "required",
            "age_group" => "required",
            "code" => "required",
            "phase" => "nullable",
        ];
    }

    public function messages(): array {
        return [
            "name.required" => "ادخل اسم اللاعب",
            "phone.required" => "ادخل رقم هاتف اللاعب",
            "position.required" => "ادخل مركز اللاعب",
            "code.required" => "ادخل رمز اللاعب",
            "age_group.required" => "ادخل عمر اللاعب",
        ];
    }
}
