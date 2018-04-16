<?php

namespace GameSheets\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenreRequest extends FormRequest
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
        $id = $this->genre ? ',' . $this->genre->id : '';
        return $rules = [
            'nom' => 'required|string|max:255|unique:genres,nom' . $id,
        ];
    }
}
