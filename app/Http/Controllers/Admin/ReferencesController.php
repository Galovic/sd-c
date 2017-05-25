<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ReferenceRequest;
use App\Models\Reference;
use Illuminate\Http\Request;
use Image;
use File;

class ReferencesController extends AdminController
{
    /**
     * Create a new References controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('permission:references-show')->only('index');
        $this->middleware('permission:references-create')->only([ 'create', 'store' ]);
        $this->middleware('permission:references-edit')->only([ 'edit', 'update' ]);
        $this->middleware('permission:references-delete')->only('delete');
    }


    /**
     * List of references
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->setTitleDescription("Reference", "přehled referencí");

        $references = Reference::whereLanguage($this->getLanguage())->get();

        return view('admin.references.index', compact('references'));
    }


    /**
     * Create new references
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->setTitleDescription("Reference", "vytvořit referenci");

        return view('admin.references.create');
    }


    /**
     * Request: Render form for editing reference
     *
     * @param Service $service
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Reference $reference)
    {
        $this->setTitleDescription("Reference", "upravit referenci");

        return view('admin.references.edit', compact('reference'));
    }


    /**
     * Request: store new service
     *
     * @param ServiceRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ReferenceRequest $request)
    {
        $reference = new Reference($request->getValues());

        $reference->language_id = $this->getLanguage()->id;
        $reference->user_id = auth()->id();
        $reference->save();

        // Save image and create thumb
        $imageName = 'image.' . $request->image->getClientOriginalExtension();
        $thumbName = 'thumb.' . $request->image->getClientOriginalExtension();

        $imageDir = $reference->photogallery_path;

        if (!file_exists($imageDir)) {
            mkdir($imageDir, 0755, true);
        }

        $request->file('image')->move($imageDir, $imageName);

        $crop = config('admin.image_crop.reference.small');
        Image::make("{$imageDir}/{$imageName}")
            ->resize($crop['size'][0], $crop['size'][1])
            ->save("{$imageDir}/{$thumbName}");

        $reference->image = $imageName;
        $reference->thumbnail = $thumbName;

        flash('Reference byla úspěšně vytvořena!', 'success');
        return redirect()->route('admin.references.index');
    }


    /**
     * Request: Update existing service
     *
     * @param ServiceRequest $request
     * @param Service $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ReferenceRequest $request, Reference $reference)
    {
        // Save image and create thumb
        if($request->image !== null){

            $imageName = 'image.' . $request->image->getClientOriginalExtension();
            $thumbName = 'thumb.' . $request->image->getClientOriginalExtension();

            $imageDir = $reference->photogallery_path;

            if (!file_exists($imageDir)) {
                mkdir($imageDir, 0755, true);
            }

            $request->file('image')->move($imageDir, $imageName);

            $crop = config('admin.image_crop.reference.small');
            Image::make("{$imageDir}/{$imageName}")
                ->resize($crop['size'][0], $crop['size'][1])
                ->save("{$imageDir}/{$thumbName}");

            $reference->image = $imageName;
            $reference->thumbnail = $thumbName;
        }

        // Save values
        $reference->fill($request->getValues());
        $reference->save();

        flash('Reference byla úspěšně upravena!', 'success');
        return redirect()->route('admin.references.index');
    }


    /**
     * Request: Delete service
     *
     * @param Service $service
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function delete(Reference $reference)
    {
        $reference->delete();

        flash('Reference byla úspěšně smazána!', 'success');
        return $this->refresh();
    }


}