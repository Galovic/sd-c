<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\PageRequest;
use App\Models\Module\Entity;
use App\Models\Module\InstalledModule;
use App\Models\Page\LayoutType;
use App\Models\Page\Page;
use App\Models\Page\Type;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Module;

class ModulesController extends AdminController
{

    /**
     * ModulesController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('permission:pages-create')->only([ 'create', 'store' ]);
        $this->middleware('permission:pages-edit')->only([ 'edit', 'update' ]);
        $this->middleware('permission:pages-delete')->only('delete');
        $this->middleware('permission:modules')->only([
            'install', 'uninstall', 'toggleEnabled', 'index'
        ]);
    }


    /**
     * Request: manage installed modules
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->setTitleDescription('Moduly', 'správa modulů');

        $modules = Module::all();
        $installedModules = InstalledModule::all();

        foreach ($installedModules as $installedModule) {
            if (isset($modules[$installedModule->name])) {
                $modules[$installedModule->name]->installation = $installedModule;
            }
        }

        return view('admin.modules.index', compact('modules'));
    }


    /**
     * Toggle enabled specified module
     *
     * @param InstalledModule $module
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function toggleEnabled(InstalledModule $module)
    {
        $module->update([
            'enabled' => !$module->enabled
        ]);

        flash("Modul {$module->name} úspěšně " . ( $module->enabled ? 'povolen' : 'zakázán' ) . '.', 'success');
        return $this->refresh();
    }


    /**
     * Install module
     *
     * @param string $name
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function install($name)
    {
        /** @var \App\Models\Module\Module $module */
        $module = Module::find($name);

        if (!$module) {
            return response()->json([
                'error' => 'Modul neexistuje.'
            ]);
        }

        $exitCode = $module->install();

        if ($exitCode !== 0) {
            return response()->json([
                'error' => 'Migrace se nezdařila! ExitCode: ' . $exitCode
            ]);
        }

        InstalledModule::create([
            'name' => $module->getName(),
            'enabled' => true
        ]);

        return $this->refresh();
    }


    /**
     * Uninstall module
     *
     * @param InstalledModule $module
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function uninstall(InstalledModule $module)
    {
        $module->module->uninstall();
        return $this->refresh();
    }


    /**
     * Request: Show the form for editing the module entity.
     *
     * @param Entity $entity
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Entity $entity)
    {
        return $this->castRequest($entity);
    }


    /**
     * Request: Update the specified module entity.
     *
     * @param  Request $request
     * @param  Entity $entity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entity $entity)
    {
        return $this->castRequest($entity);
    }


    public function loadContents(Request $request){
        if(!$idsInput = $request->input('ids')) return [];

        $ids = json_decode($idsInput);
        if(!$ids) return [];

        $contents = [];
        $entities = Entity::whereIn('id', $ids)->get();

        foreach($entities as $entity){
            $contents[$entity->id] = $entity->renderPreview();
        }

        return response()->json([
            'contents' => $contents
        ]);
    }


    /**
     * Request: delete
     *
     * @param Page $page
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Page $page)
    {

    }

    private function castRequest(Entity $entity){
        $request = request();
        list($class, $action) = explode('@', $request->route()->getActionName());

        $controller = "Modules\\{$entity->module}\\Http\\Controllers\\ModuleController";
        $reflection = new \ReflectionClass($controller);
        $parameters = $reflection->getMethod($action)->getParameters();

        $finalParameters = [];

        foreach($parameters as $parameter){
            $class = $parameter->getClass()->name;

            if($class === Request::class){
                $finalParameters[] = $request;
            }
            elseif($parameter->getClass()->getParentClass()->name === Request::class){
                $finalParameters[] = new Request($request->query, $request, $request->attributes, $request->cookies, $request->files, $request->server, $request->getContent(true));
            }
            elseif(preg_match("/Modules\\\\.+\\\\Models\\\\Configuration/", $class)){
                $finalParameters[] = $entity->configuration;
            }
            else{
                $finalParameters[] = app($class);
            }
        }

        return call_user_func_array([app($controller), $action], $finalParameters);
    }
}
