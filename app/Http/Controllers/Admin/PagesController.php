<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ViewHelper;
use App\Http\Requests\Admin\PageRequest;
use App\Models\Module\InstalledModule;
use App\Models\Page\LayoutType;
use App\Models\Page\Page;
use App\Models\Page\Type;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Module;

class PagesController extends AdminController
{

    /**
     * PagesController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('permission:pages-show')->only('index');
        $this->middleware('permission:pages-create')->only([ 'create', 'store' ]);
        $this->middleware('permission:pages-edit')->only([ 'edit', 'update' ]);
        $this->middleware('permission:pages-delete')->only('delete');
    }


    /**
     * Request: Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->setTitleDescription("Stránky", "seznam stránek");

        $pages = Page::whereLanguage($this->getLanguage())
            ->orderBy('id', 'asc')->get()->toHierarchy();

        return view('admin.pages.index', compact('pages'));
    }


    /**
     * Request: Show the form for creating a new page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setTitleDescription("Stránky", "vytvořit stránku");

        $pages = Page::whereLanguage($this->getLanguage())
            ->orderBy('id', 'asc')->get()->toHierarchy();

        $pageTypes = Type::all();
        $views = ViewHelper::getDemarcatedViews('page');

        $modules = InstalledModule::enabled()->get()->pluck('module');

        return view('admin.pages.create', compact('pages', 'pageTypes', 'modules', 'views'));
    }


    /**
     * Request: Store new page
     *
     * @param PageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PageRequest $request)
    {
        // Create page
        $page = new Page($request->getValues());
        $page->language_id = $this->getLanguage()->id;
        $page->save();

        if ($page->parent_id) {
            $page->makeChildOf(Page::find($page->parent_id));
        }

        if($request->hasFile('image')) {

            // Save image and create thumb
            $imageName = 'image.' . $request->image->getClientOriginalExtension();

            $imageDir = $page->images_path;

            if (!file_exists($imageDir)) {
                mkdir($imageDir, 0755, true);
            }

            $request->file('image')->move($imageDir, $imageName);

            $page->image = $imageName;
            $page->createThumbnail();
            $page->save();
        }

        flash('Stránka byla úspěšně vytvořena!', 'success');

        return redirect()->route('admin.pages.index');
    }


    /**
     * Request: Show the form for editing the specified page.
     *
     * @param Page $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Page $page)
    {
        $this->setTitleDescription('Stránky', 'upravit stránku');

        $pageTypes = Type::all();

        $pages = Page::whereLanguage($page->language_id)
            ->where('id', '<>', $page->id)->get()->toHierarchy();

        $layoutTypes = LayoutType::select('id', 'name')->get();

        foreach ($layoutTypes as $type) {
            $type->value = Hashids::encode($type->id);
            $type->text = $type->name;
            unset($type->id, $type->name);
        }

        $views = ViewHelper::getDemarcatedViews('page');
        $modules = InstalledModule::enabled()->get()->pluck('module');

        $allowed_module = [];
//        $web_Settings = new WebSettingsHelper();
//        $allowed_module = $web_Settings->getAllowModule();

        return view('admin.pages.edit', compact('page', 'pageTypes', 'pages', 'layoutTypes','allowed_module', 'modules', 'views'));
    }


    /**
     * Request: Update the specified resource in storage.
     *
     * @param  PageRequest $request
     * @param  Page $page
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, Page $page)
    {
        $page->update($request->getValues());

        if ($request->parent_id) {
            $page->makeChildOf(Page::findOrFail($request->parent_id));
        } else {
            $page->makeRoot();
        }

        if($request->hasFile('image')) {

            // Save image and create thumb
            $imageName = 'image.' . $request->image->getClientOriginalExtension();

            $imageDir = $page->images_path;

            if (!file_exists($imageDir)) {
                mkdir($imageDir, 0755, true);
            }

            $request->file('image')->move($imageDir, $imageName);

            $page->image = $imageName;
            $page->createThumbnail();
            $page->save();
        }
        elseif ($request->input('remove_image') === 'true' && $page->image) {
            if(file_exists($page->image_path)){
                \File::delete($page->image_path);
            }
            if(file_exists($page->thumbnail_path)){
                \File::delete($page->thumbnail_path);
            }
            $page->image = null;
            $page->save();
        }

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Stránka uložena.'
            ]);
        }

        flash('Stránka byla úspěšně upravena!', 'success');
        return redirect()->route('admin.pages.index');
    }


    /**
     * Request: delete page
     *
     * @param Page $page
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Page $page)
    {
        $page->delete();
        flash('Stránka byla úspěšně smazána!', 'success');
        return $this->refresh();
    }
}
