<?php

namespace App\Http\Requests;
// logo1680522220.jpg
use Illuminate\Foundation\Http\FormRequest;

class GeneralRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required',
            'homepage_title' => 'required',
            'homepage_subtitle' => 'required',
            'logo' => 'image',
            'favicon' => 'image',
            // 'logo' => 'mimetypes:text/plain,image/png,image/jpeg',
            //  'favicon' => 'image|mimetypes:text/plain,image/png,image/jpeg,image/svg , image/png , image/webp',
            //  'favicon' => 'image|mimetypes:text/plain,image/png,image/jpeg,image/svg , image/png , image/webp',
            'footer_contact' => 'required',
            'footer_address' => 'required',
            'footer_content' => 'required',

        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Name',
            'email' => 'Email',
            'homepage_title' => 'Title',
            'homepage_subtitle' => 'Subtitle',
            'logo' => 'Logo' ,
            'favicon' => 'Favicon',
            'footer_contact' => 'Footer Contact',
            'footer_address' => 'Footer Address',
            'footer_content' => 'Footer Content',

        ];
    }
}
