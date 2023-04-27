<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'titolo' => 'required|max:150|unique:projects,titolo',
            'cliente' => 'required|max:100|min:2',
            'descrizione'=>'nullable|string',
            'link'=>'required|url',
            'type_id' => 'nullable|exists:types,id'
        ];
    }
}
