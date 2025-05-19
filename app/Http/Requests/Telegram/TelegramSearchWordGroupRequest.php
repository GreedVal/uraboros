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
                'regex:/^(@[a-zA-Z0-9_]{5,32}|t\.me\/[a-zA-Z0-9_]{5,32})$/'
            ],
            'query' => [
                'nullable',
                'string',
                'max:512',
            ],
            'minDate' => [
                'nullable',
                'date',
                'before_or_equal:maxDate',
            ],
            'maxDate' => [
                'nullable',
                'date',
                'after_or_equal:minDate',
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
            'chatUsername.regex' => 'Некорректный формат username. Используйте @username или t.me/username.',
            'query.max' => 'Поисковый запрос не должен превышать 512 символов.',
            'minDate.date' => 'Некорректный формат даты.',
            'minDate.before_or_equal' => 'Дата "от" должна быть раньше или равна дате "до".',
            'maxDate.date' => 'Некорректный формат даты.',
            'maxDate.after_or_equal' => 'Дата "до" должна быть позже или равна дате "от".',
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
