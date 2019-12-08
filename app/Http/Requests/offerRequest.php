<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class offerRequest extends FormRequest
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
            'section' => ['required', 'string'],
            'theme' => ['required', 'string'],
            'mainText' => ['string', 'nullable', 'max:16000'],
            'files' => ['JSON', 'nullable'],
            'description'=> ['string', 'nullable', 'max:254'],
            'url'=> ['URL','nullable'],
//            'deadline'=> [''], //TODO: добавить правила после добавления полей в offerForm
//            'publishing'=> [], //TODO: добавить правила после добавления полей в offerForm
        ];
    }

    public function messages()
    {
        return [
            'section.required' => 'Поле раздел обязательно для заполнения',
            'section.string'  => 'Поле раздел должно быть строкой',

            'theme.required' => 'Поле тема обязательно для заполнения',
            'theme.string'  => 'Поле тема должно быть строкой',

            'mainText.string' => 'Ожидался текст',

            'files.json' => 'Ожидались данные в JSON формате',

            'description.string' => 'Ожидалась строка',
            'description.max' => 'Максимум 254 символа',

            'url.url' => 'Ожидалась ссылка'
        ];
    }

}
