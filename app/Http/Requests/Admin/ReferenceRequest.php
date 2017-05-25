<?php

namespace App\Http\Requests\Admin;

use App\Models\Reference;
use Illuminate\Foundation\Http\FormRequest;

class ReferenceRequest extends FormRequest
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
        $rules = [
            'title' => 'required|max:250',
            'url' => 'required|max:250',
            'perex' => 'required',
            'seo_title' => 'max:60',
            'seo_description' => 'max:160',
            'sort' => 'numeric'
        ];

        // Creating new
        if($this->method() == 'POST'){
            $rules['image'] = 'required|image';
        }

        return $rules;
    }


    /**
     * Return input values
     *
     * @return array
     */
    public function getValues(){

        $input = $this->only([
            'title', 'perex', 'text', 'seo_title', 'seo_description',
            'seo_keywords', 'sort'
        ]);

        // Url
        $reference = $this->route('reference');

        $urlAdd = 0;
        $checkedUrl = $url = $this->input('url');
        while($foundReference = Reference::findByUrl($checkedUrl)){
            if($reference && $foundReference->id == $reference->id) break;

            $urlAdd++;
            $checkedUrl = $url . '-' . $urlAdd;
        }

        $input['url'] = $checkedUrl;

        return $input;

    }
}
