<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            
            // 1. Authorize and validate the custom username input
            'username' => [
                'required',
                'string',
                'alpha_dash', // Forces clean URLs (letters, numbers, dashes, underscores)
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id), // The "ignore me" condition
            ],
            
            // 2. Authorize and validate the optional bio input
            'bio' => ['nullable', 'string', 'max:1000'],
        ];
    }
}