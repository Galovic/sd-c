<?php

namespace Modules\Photogallery\Models;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    /**
     * @var string Table name of the model
     */
    protected $table = 'module_photogallery_configurations';

    /**
     * Mass assignable attributes
     *
     * @var array
     */
    protected $fillable = [ 'view', 'photogallery_id' ];


    /**
     * Get default configuration
     *
     * @return Configuration
     */
    static function getDefault(){
        return new self([
            'view' => 'photogallery.index'
        ]);
    }


    /**
     * Photogallery
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function photogallery(){
        return $this->hasOne('App\Models\Photogallery\Photogallery', 'id', 'photogallery_id');
    }


    /**
     * Render module
     *
     * @return string
     */
    public function render(){
        return view($this->view, [
            'photogallery' => $this->photogallery
        ])->render();
    }


    /**
     * Render module
     *
     * @return string
     */
    public function renderPreview(){
        return view($this->view, [
            'photogallery' => $this->photogallery
        ])->render();
    }
}
