<?php

namespace GameSheets\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeveloppeurRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->editeur ? ',' . $this->editeur->id : '';
        return $rules = [
            'nom' => 'required|string|max:255|unique:editeurs,nom' . $id,
        ];
    }
}
