<?php

namespace Modules\Link\Http\Requests;

use App\Models\Article\Article;
use App\Models\Page\Page;
use App\Models\Photogallery\Photogallery;
use App\Models\Service;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Link\Models\Configuration;

class ModuleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'text' => 'required',
            'url' => 'required_if:custom_url,1',
            'model_type' => 'required_without:custom_url|in:' . join(',', array_keys(Configuration::$modelTypeClass))
        ];

        foreach(Configuration::$modelTypeClass as $type => $class){
            $rules["{$type}_id"] = "required_if:model_type,{$type}|exists:" . $class::getTableName() . ",id";
        }

        return $rules;
    }

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
     * Get form values
     *
     * @return array
     */
    public function getValues(){
        $output = $this->only([ 'view', 'url', 'text' ]);

        $output['model'] = null;
        $output['model_id'] = null;

        // Model
        if(!$this->input('custom_url')){
            $output['url'] = null;
            $output['model'] = Configuration::$modelTypeClass[$model = $this->input('model_type')];
            $output['model_id'] = $this->input($model . '_id');
        }

        // View
        if(isset($output['view']) && !strlen($output['view'])){
            $output['view'] = null;
        }

        // Attributes
        $tags = [];
        $tagKeys = $this->input('attribute_key', []);
        $tagValues = $this->input('attribute_value', []);
        foreach($tagKeys as $i => $tagKey){
            if(!$tagKey) continue;
            $tags[$tagKey] = htmlspecialchars($tagValues[$i]);
        }

        $output['tags'] = $tags ? json_encode($tags) : null;

        return $output;
    }
}
