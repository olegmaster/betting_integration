<?php

namespace App\Http\Requests\Admin\Bot;

use Illuminate\Foundation\Http\FormRequest;

class BotSaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'bot' => 'file|min:1'
        ];
    }
}
