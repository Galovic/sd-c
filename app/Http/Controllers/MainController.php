<?php

namespace App\Http\Controllers;

use App\Helpers\UrlFactory;
use App\Models\Article\Article;
use App\Models\Article\Category;
use App\Models\Page\Page;
use App\Models\Service;
use App\Models\Web\Language;
use App\Models\Web\Theme;
use App\Models\Web\Url;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class MainController extends BaseController
{

    /**
     * @var Theme
     */
    protected $theme;

    /**
     * @var mixed
     */
    protected $context;

    /**
     * @var string
     */
    protected $url;


    /**
     * MainController constructor.
     */
    public function __construct() {
        // Check for language code in url
        $this->middleware('url_language');
    }


    /**
     * Initialized language.
     */
    protected function initializeLanguage() {
        /** @var UrlFactory $urlFactory */
        $urlFactory = resolve('UrlFactory');

        // Obtain route url parameter
        $this->url = request()->route('url') ?: '';
        $this->language = $urlFactory->getLanguage();
    }


    /**
     * Initialized context.
     */
    protected function initializeContext() {
        $this->theme = Theme::getDefault();
        $this->context = $this->theme->getContextInstance();
        $this->context->setlanguage($this->getLanguage());

        view()->composer('*', function (View $view) {
            $this->context->viewAny($view);

            $renderMethod = 'view' . implode('', array_map('ucfirst', explode('.', str_replace('theme::', '', $view->name()))));

            if(method_exists($this->context, $renderMethod)){
                $this->context->{$renderMethod}($view);
            }
        });
    }


    /**
     * @return mixed
     */
    public function index(){
        $this->initializeLanguage();
        $this->initializeContext();

        /** @var UrlFactory $urlFactory */
        $urlFactory = resolve('UrlFactory');

        $model = $urlFactory->getModel($this->url);
        if (!$model) {
            if ($urlFactory->isUrlHomepage($this->url)) {
                return \view('site.no_home');
            }

            return $this->context->renderError();
        }

        switch (get_class($model)){
            case Page::class:
                return $this->context->renderPage($model);
            case Article::class:
                return $this->context->renderArticle($model);
            case Category::class:
                return $this->context->renderCategory($model);
            case Service::class:
                return $this->context->renderService($model);
            case Reference::class:
                return $this->context->renderReference($model);
        }

        // Try to find render function
        $nsParts = explode('\\', get_class($model));
        $modelName = end($nsParts);
        if(method_exists($this->context, $renderMethod = "render{$modelName}")){
            return $this->context->$renderMethod($model);
        }

        return $this->context->renderError();
    }
}
