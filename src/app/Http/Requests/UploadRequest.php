<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadRequest extends FormRequest
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
     * max 100mb (102400kb) is allowed
     *
     * @return array
     */
    public function rules()
    {
        return [
            'file' => 'required|file|mimes:xls,xlsx,csv|max:102400'
        ];
    }
}
