<?php

namespace App\Http\Requests\Telegram;

use Illuminate\Foundation\Http\FormRequest;

class TelegramSearchWordGroupRequest extends FormRequest
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
            'chatUsername' => [
                'required',
                'string',
                'max:255',
            ],
            'query' => [
                'nullable',
                'string',
                'max:512',
            ],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'chatUsername.required' => 'Поле чат/канал обязательно для заполнения.',
            'query.max' => 'Поисковый запрос не должен превышать 512 символов.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        if ($this->has('chatUsername')) {
            $this->merge([
                'chatUsername' => trim($this->chatUsername),
            ]);
        }
    }
}
