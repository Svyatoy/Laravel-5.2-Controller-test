<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;

abstract class AlbumRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'description' => 'required|min:3',
        ];
    }
}
