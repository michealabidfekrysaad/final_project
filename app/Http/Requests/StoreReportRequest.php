<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReportRequest extends FormRequest
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
            'name' => 'required',
            'age' => 'required',
            'gender' => 'required',
            'image' => 'required',
            'type' => 'required',
            'special_mark' => 'required',
            'eye_color' => 'required',
            'hair_color' => 'required',
            'city' => 'required',
            'region' => 'required',
            'location' => 'required',
            'last_seen_on' => 'required',
            'last_seen_at' => 'required',
            'lost_since' => 'required',
            'found_since' => 'required',
            'height' => 'required',
            'weight' => 'required',
            

        ];
    }
}
