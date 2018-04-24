<?php

namespace Laraeast\Artisan\Scaffolding\Requests;

use Illuminate\Support\Str;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest as Request;

class FormRequest extends Request
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
        if (method_exists($this, Str::lower($this->method()).'Rules')) {
            return $this->{Str::lower($this->method()).'Rules'}();
        }

        return [];
    }

    /**
     * Get the validation rules for get method that apply to the request.
     *
     * @return array
     */
    public function getRules()
    {
        return [];
    }

    /**
     * Get the validation rules for post method that apply to the request.
     *
     * @return array
     */
    public function postRules()
    {
        return [];
    }

    /**
     * Get the validation rules for put method that apply to the request.
     *
     * @return array
     */
    public function putRules()
    {
        return [];
    }

    /**
     * Get the validation rules for patch method that apply to the request.
     *
     * @return array
     */
    public function patchRules()
    {
        return [];
    }

    /**
     * Get the validation rules for delete method that apply to the request.
     *
     * @return array
     */
    public function deleteRules()
    {
        return [];
    }

    /**
     * Format the errors from the given Validator instance.
     *
     * @param  \Illuminate\Contracts\Validation\Validator $validator
     * @return array
     */
    protected function formatErrors(Validator $validator)
    {
        if ($this->expectsJson()) {
            return ['errors' => $validator->getMessageBag()->toArray()];
        }

        return $validator->getMessageBag()->toArray();
    }
}
