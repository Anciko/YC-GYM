<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkoutRequest extends FormRequest
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
            'workoutname' => 'required',
            'calories' => 'required',
            'workoutlevel' => 'required',
            'gendertype' => 'required',
            'image' => 'required',
            'video' => 'required'
        ];
    }
}
