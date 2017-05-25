<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Reference;
use Date;
use Auth;
use Flash;
use Illuminate\Http\ReferenceRequest;
use Input;
use Mockery\Exception;

class ReferencesController extends Controller
{

    protected $reference;
    public function __construct(Reference $reference, Request $request)
    {
        parent::__construct($request);

        Date::setLocale('cs');

        $this->reference = $reference;
    }

    public function detail(Photogallery $photogallery, Reference $reference, Category $category, Article $article, $id)
    {
        $reference = $this->reference->where('url', $id)->first();

        dd($reference);

        if (is_null($reference)) {
            abort(404);
        }

        $page = new Page();
        $page->seo_title = (empty($reference->seo_title) ? $reference->title : $reference->seo_title);
        $page->seo_description = $reference->seo_description;
        $page->seo_keywords = $reference->seo_keywords;

        $reference = $category->getReferencesByService($reference->url, 'reference');

        $blog = $article->getArticlesByCategory(1, 3, 0);

        return view(
            'references.detail',
            [
                'reference' => $reference,
                'page' => $page,
//                'exist' => $page,
                'services' => $this->services->getAll(),
                //'photogallery' => $photogallery->getById(1),
                'service_submenu' => true,
                //'service_submenu_items' => $services->getAll(),

                'blog' => $blog,
            ]
        );
    }
}
