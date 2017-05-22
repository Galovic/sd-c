<?php

namespace Modules\Text\Http\Controllers;

use App\Models\Module\Entity;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Text\Http\Requests\ModuleRequest;
use Modules\Text\Models\Configuration;

class ModuleController extends Controller
{
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $configuration = new Configuration();
        return view('module-text::configuration.form', compact('configuration'));
    }


    /**
     * Store new module
     *
     * @param ModuleRequest $request
     * @return mixed
     */
    public function store(ModuleRequest $request)
    {
        $configuration = Configuration::create($request->only('content'));
        $configuration->fixUrlsInContent();
        $configuration->save();

        $entity = new Entity([ 'module' => 'Text' ]);
        $entity->configuration_id = $configuration->id;
        $entity->save();

        return response()->json([
            'id' => $entity->id,
            'content' => view('module-text::module_preview', compact('configuration') )->render()
        ]);
    }


    /**
     * Show the form for editing specified resource.
     * @return Response
     */
    public function edit(Configuration $configuration)
    {
        return view('module-text::configuration.form', compact('configuration'));
    }


    /**
     * Store new module
     *
     * @param ModuleRequest $request
     * @return mixed
     */
    public function update(ModuleRequest $request, Configuration $configuration)
    {
        $configuration->update($request->only('content'));

        return response()->json([
            'content' => view('module-text::module_preview', compact('configuration') )->render()
        ]);
    }
}
