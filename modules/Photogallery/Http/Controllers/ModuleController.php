<?php

namespace Modules\Photogallery\Http\Controllers;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Module\Entity;
use App\Models\Photogallery\Photogallery;
use App\Models\Web\Theme;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Photogallery\Http\Requests\ModuleRequest;
use Modules\Photogallery\Models\Configuration;

class ModuleController extends AdminController
{
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $configuration = Configuration::getDefault();

        $views = $this->getAllViews();
        $photogalleries = Photogallery::whereLanguage($this->getLanguage())->pluck('title', 'id');
        return view('module-photogallery::configuration.form', compact('configuration', 'views', 'photogalleries'));
    }


    /**
     * Store new module
     * @return Response
     */
    public function store(ModuleRequest $request)
    {
        $configuration = Configuration::create($request->only('photogallery_id', 'view'));

        $entity = new Entity([ 'module' => 'Photogallery' ]);
        $entity->configuration_id = $configuration->id;
        $entity->save();

        return response()->json([
            'id' => $entity->id,
            'content' => view('module-photogallery::module_preview', compact('configuration') )->render()
        ]);
    }


    /**
     * Show the form for editing specified resource.
     * @return Response
     */
    public function edit(Configuration $configuration)
    {
        $views = $this->getAllViews();
        $photogalleries = Photogallery::whereLanguage($this->getLanguage())->pluck('title', 'id');
        return view('module-photogallery::configuration.form', compact('configuration', 'views', 'photogalleries'));
    }


    /**
     * Store new module
     *
     * @param ModuleRequest $request
     * @return mixed
     */
    public function update(ModuleRequest $request, Configuration $configuration)
    {
        $configuration->update($request->only('photogallery_id', 'view'));

        return response()->json([
            'content' => view('module-photogallery::module_preview', compact('configuration') )->render()
        ]);
    }


    /**
     * Return all available views
     *
     * @return array
     */
    private function getAllViews(){
        $views =  [
            'Veřejné' => $this->getFrontendViews()
        ];

        $theme = Theme::getDefault();
        $views["Šablona " . $theme->name] = $this->getThemeViews($theme);

        return $views;
    }


    /**
     * Get all frontend views
     *
     * @return array
     */
    private function getFrontendViews(){
        $views = [];

        $files = \File::allFiles($viewsPath = resource_path('views'));
        foreach ($files as $file)
        {
            if(!ends_with($file, '.blade.php')) continue;
            $file = str_replace($viewsPath, '', $file);
            if(starts_with($file, '/admin')) continue;

            $viewName = str_replace('/', '.', substr($file, 1, strlen($file) - strlen('.blade.php') - 1));

            $views[$viewName] = $viewName;
        }

        return $views;
    }


    /**
     * Get all theme views
     *
     * @param Theme $theme
     * @return array
     */
    private function getThemeViews(Theme $theme){
        $views = [];

        $files = \File::allFiles($viewsPath = $theme->view_path);
        foreach ($files as $file)
        {
            if(!ends_with($file, '.blade.php')) continue;
            $file = str_replace($viewsPath, '', $file);
            if(starts_with($file, '/admin')) continue;

            $viewName = str_replace('/', '.', substr($file, 1, strlen($file) - strlen('.blade.php') - 1));

            $views['theme::' . $viewName] = $viewName;
        }

        return $views;
    }
}
