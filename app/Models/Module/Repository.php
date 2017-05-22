<?php

namespace App\Models\Module;

use Nwidart\Modules\Json;

class Repository extends \Nwidart\Modules\Repository
{
    /**
     * Get & scan all modules.
     *
     * @return array
     */
    public function scan()
    {
        $paths = $this->getScanPaths();
        $modules = [];
        foreach ($paths as $key => $path) {
            $manifests = $this->app['files']->glob("{$path}/module.json");
            is_array($manifests) || $manifests = [];
            foreach ($manifests as $manifest) {
                $name = Json::make($manifest)->get('name');
                $modules[$name] = new Module($this->app, $name, dirname($manifest));
            }
        }
        return $modules;
    }
}
