<?php

namespace App\Http\Requests;

use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;

class AlbumRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|filled|min:3',
            'description' => 'required|filled|min:3',
            'public' => 'required|filled|bool',
        ];
    }

    /**
     * Bad validation errors output.
     *
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->response(
            $this->formatErrors($validator)
        ));
    }

    /**
     * Response output format.
     *
     * @param array $errors
     * @return JsonResponse
     */
    public function response(array $errors)
    {
        return new JsonResponse($errors, 422);
    }

}
