<?php

namespace App\Models\Module;

use Illuminate\Database\Eloquent\Model;
use Module;

class Entity extends Model
{
    /**
     * Model table
     *
     * @var string
     */
    protected $table = 'modules';

    /**
     * Mass assignable attributes
     *
     * @var array
     */
    protected $fillable = [ 'module', 'enabled' ];


    /**
     * Get entity configuration
     *
     * @return mixed
     */
    public function getConfigurationAttribute(){
        return Module::findOrFail($this->module)->getConfiguration($this->configuration_id);
    }


    /**
     * Render entity content
     *
     * @return mixed
     */
    public function render($options = []){
        return $this->configuration->render($options);
    }


    /**
     * Get module
     *
     * @return Module
     */
    public function getModule(){
        return Module::findOrFail($this->module);
    }


    /**
     * Render entity preview
     *
     * @return mixed
     */
    public function renderPreview(){
        return $this->getModule()->view('module_preview', [
            'configuration' => $this->configuration
        ])->render();
    }
}
