<?php

namespace App\Http\Requests;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AssetRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<string|ValidationRule|Closure>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'category_id' => ['required', 'integer'],
            'assigned_user_id' => ['nullable', 'integer'],
            'image_id' => ['nullable', 'integer'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
