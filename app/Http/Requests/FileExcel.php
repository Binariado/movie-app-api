<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileExcel extends FormRequest
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
        return [
            "files" => "required|array",
            "files.*" => "required|mimes:xlsx|max:3000",
        ];
    }
}
