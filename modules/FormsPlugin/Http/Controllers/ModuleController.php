<?php

namespace Modules\FormsPlugin\Http\Controllers;

use App\Helpers\ViewHelper;
use App\Http\Controllers\Admin\AdminController;
use App\Models\Module\Entity;
use Illuminate\Http\Request;
use Modules\FormsPlugin\Http\Requests\ModuleRequest;
use Modules\FormsPlugin\Models\Configuration;
use Modules\FormsPlugin\Models\Form;

class ModuleController extends AdminController
{
    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return $this->createForm();
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

        $entity = new Entity([ 'module' => 'FormsPlugin' ]);
        $entity->configuration_id = $configuration->id;
        $entity->save();

        return response()->json([
            'id' => $entity->id,
            'content' => view('module-formsplugin::module_preview', compact('configuration') )->render()
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
            'content' => view('module-formsplugin::module_preview', compact('configuration') )->render()
        ]);
    }


    /**
     * Return form view
     *
     * @param $configuration
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function createForm($configuration = null){
        $views = [ '' => 'Výchozí' ] + ViewHelper::getAllViews();
        $forms = Form::pluck('name', 'id');
        $configuration = $configuration ?: new Configuration();

        return view('module-formsplugin::configuration.form', compact('configuration', 'views', 'forms'));
    }


    /**
     *
     *
     * @param Configuration $configuration
     * @param Request $request
     * @return mixed
     */
    public function formSubmit(Configuration $configuration, Request $request){
        $validator = \Validator::make($request->all(), $configuration->form->getValidationRules());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        flash('Formulář odeslán.');
        return redirect()->back();
    }
}
