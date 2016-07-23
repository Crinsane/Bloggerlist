<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateProjectRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->type == 'company';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'images' => 'array',
            'images.*' => 'image',
            'steps' => 'array',
            'steps.*.title' => 'required',
            'steps.*.description' => 'required',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.*' => 'Please supply a project title.',
            'description.*' => 'Please supply a project description.',
            'category_id.*' => 'Please select a category for the project.',
        ];
    }

    /**
     * Get all of the input and files for the request.
     *
     * @return array
     */
    public function all()
    {
        $all = parent::all();

        $all['steps'] = array_map(function ($step) {
            return json_decode($step, true);
        }, $all['steps']);

        return $all;
    }
}
