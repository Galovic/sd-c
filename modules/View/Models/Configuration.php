<?php

namespace Modules\View\Models;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    /**
     * @var string Table name of the model
     */
    protected $table = 'module_view_configurations';

    /**
     * Mass assignable attributes
     *
     * @var array
     */
    protected $fillable = [ 'view' ];


    /**
     * Get default configuration
     *
     * @return Configuration
     */
    static function getDefault(){
        return new self([
            'view' => ''
        ]);
    }


    /**
     * Render module
     *
     * @return string
     */
    public function render(){
        return view($this->view)->render();
    }
}
