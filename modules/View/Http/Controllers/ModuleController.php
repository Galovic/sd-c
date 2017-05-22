<?php

namespace Modules\View\Http\Controllers;

use App\Models\Module\Entity;
use App\Models\Web\Theme;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\View\Http\Requests\ModuleRequest;
use Modules\View\Models\Configuration;

class ModuleController extends Controller
{
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $configuration = Configuration::getDefault();

        $views = $this->getAllViews();
        return view('module-view::configuration.form', compact('configuration', 'views'));
    }


    /**
     * Store new module
     * @return Response
     */
    public function store(ModuleRequest $request)
    {
        $configuration = Configuration::create($request->only('view'));

        $entity = new Entity([ 'module' => 'View' ]);
        $entity->configuration_id = $configuration->id;
        $entity->save();

        return response()->json([
            'id' => $entity->id,
            'content' => view('module-view::module_preview', compact('configuration') )->render()
        ]);
    }


    /**
     * Show the form for editing specified resource.
     * @return Response
     */
    public function edit(Configuration $configuration)
    {
        $views = $this->getAllViews();
        return view('module-view::configuration.form', compact('configuration', 'views'));
    }


    /**
     * Update existing module configuration
     *
     * @param ModuleRequest $request
     * @return mixed
     */
    public function update(ModuleRequest $request, Configuration $configuration)
    {
        $configuration->update($request->only('view'));

        return response()->json([
            'content' => view('module-view::module_preview', compact('configuration') )->render()
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
