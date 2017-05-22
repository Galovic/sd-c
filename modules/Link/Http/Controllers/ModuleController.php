<?php

namespace Modules\Link\Http\Controllers;

use App\Helpers\ViewHelper;
use App\Http\Controllers\Admin\AdminController;
use App\Models\Article\Article;
use App\Models\Module\Entity;
use App\Models\Page\Page;
use App\Models\Photogallery\Photogallery;
use App\Models\Service;
use Illuminate\Http\Response;
use Modules\Link\Http\Requests\ModuleRequest;
use Modules\Link\Models\Configuration;

class ModuleController extends AdminController
{
    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return $this->createForm(Configuration::getDefault());
    }


    /**
     * Show the form for editing specified resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Configuration $configuration)
    {
        return $this->createForm($configuration);
    }


    /**
     * Store new module
     * @return Response
     */
    public function store(ModuleRequest $request)
    {
        $configuration = Configuration::create($request->getValues());

        $entity = new Entity([ 'module' => 'Link' ]);
        $entity->configuration_id = $configuration->id;
        $entity->save();

        return response()->json([
            'id' => $entity->id,
            'content' => view('module-link::module_preview', compact('configuration') )->render()
        ]);
    }


    /**
     * Store new module
     *
     * @param ModuleRequest $request
     * @return mixed
     */
    public function update(ModuleRequest $request, Configuration $configuration)
    {
        $configuration->update($request->getValues());

        return response()->json([
            'content' => view('module-link::module_preview', compact('configuration') )->render()
        ]);
    }


    /**
     * Return form view
     *
     * @param $configuration
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function createForm($configuration){
        $models = [
            'page' => 'Stránka',
            'article' => 'Článek',
            'photogallery' => 'Fotogalerie',
            'service' => 'Služba'
        ];

        $modelLists = [
            'page' => Page::whereLanguage($this->getLanguage())->pluck('name', 'id'),
            'article' => Article::whereLanguage($this->getLanguage())->pluck('title', 'id'),
            'photogallery' => Photogallery::whereLanguage($this->getLanguage())->pluck('title', 'id'),
            'service' => Service::whereLanguage($this->getLanguage())->pluck('title', 'id'),
        ];

        $views = [ '' => 'Výchozí' ] + ViewHelper::getAllViews();

        return view('module-link::configuration.form', compact('configuration', 'models', 'modelLists', 'views'));
    }
}
