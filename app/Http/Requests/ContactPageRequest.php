<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactPageRequest extends FormRequest
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
        if (request()->ismethod('put')) {
           $rules = [
            'section_heading' => 'required',
            'contact_form_heading' => 'required',
            'social_links_heading' => 'required',

             'content' => 'required',
           ];
        }
        return $rules;
    }

    public function attributes()
    {
       return [
        'section_heading' => 'Heading',
        'contact_form_heading' => 'Contact Form Heading',
        'social_links_heading' => ' Social Links Heading',

        'content' => 'Content',
       ];
    }
}
