<?php

namespace App\Models\Page;

use App\Models\Interfaces\UrlInterface;
use App\Models\Module\Entity;
use App\Models\Module\InstalledModule;
use App\Models\Web\Url;
use App\Models\Web\ViewData;
use App\Traits\AdvancedEloquentTrait;
use Baum\Extensions\Eloquent\Collection;
use Baum\Node;
use Illuminate\Database\Eloquent\SoftDeletes;
use Image;
use Intervention\Image\Constraint;

class Page extends Node implements UrlInterface
{
    use SoftDeletes, AdvancedEloquentTrait;

    protected $dates = [ 'deleted_at', 'published_at', 'unpublished_at' ];

    protected $orderColumn = 'id';

    protected $fillable = [
        'name', 'type', 'published', 'listed', 'parent_id', 'url', 'view',
        'seo_title', 'seo_keywords', 'seo_description', 'seo_index', 'seo_follow',
        'seo_sitemap', 'og_title', 'og_type', 'og_url', 'og_description', 'og_image',
        'published_at', 'unpublished_at', 'content', 'is_homepage'
    ];

    protected $nullIfEmpty = [
        'seo_title', 'seo_description', 'seo_keywords', 'og_title', 'og_type',
        'og_url', 'og_description', 'og_image', 'content', 'view', 'parent_id'
    ];



    /**
     * Set image
     *
     * @return mixed
     */
    public function setOgImageAttribute()
    {
        if (request()->file('og_image') && request()->file('og_image')->isValid()) {
            $file_name = pathinfo(request()->file('og_image')->getClientOriginalName());
            $file_name = str_slug($file_name['filename']) . '_' . time() . '.jpg';

            $upload_path = public_path(config('admin.path_upload')) . '/';

            foreach(config('admin.image_crop.og') as $crop_name => $crop)
            {
                $crop_path = $upload_path . $crop_name . '/' . date('Y') . '/' . date('m') . '/';
                if (!file_exists($crop_path)) {
                    mkdir($crop_path, 0755, true);
                }

                Image::make(request()->file('og_image'))->fit($crop['size'][0], $crop['size'][1])->save($crop_path . $file_name);
            }

            $this->attributes['og_image'] = '/' . date('Y') . '/' . date('m') . '/' . $file_name;
        }
        else {
            return false;
        }
    }

    // ---- NEW ---

    /**
     * Return name of images directory (hashed)
     *
     * @return string
     */
    public function getImageDirAttribute(){
        return md5($this->created_at->format('Y-m-d') . '-' . $this->id);
    }


    /**
     * Return path to images
     *
     * @return string
     */
    public function getImagesPathAttribute(){
        return public_path( config('admin.path_upload') ) . '/pages/' . $this->image_dir;
    }

    /**
     * Return path to image
     *
     * @return string
     */
    public function getImagePathAttribute(){
        return $this->images_path . "/" . $this->image;
    }


    /**
     * Return path to thumbnail
     *
     * @return string
     */
    public function getThumbnailPathAttribute(){
        return $this->images_path . "/" . $this->thumbnail;
    }


    /**
     * Return url to image directory
     *
     * @return string
     */
    public function getImagesUrlPrefixAttribute(){
        return url('/') . '/' . config('admin.path_upload') . '/pages/' . $this->image_dir;
    }


    /**
     * Return url of an image
     *
     * @return string
     */
    public function getImageUrlAttribute(){
        if(!$this->image) return null;

        return $this->images_url_prefix . '/' . $this->image;
    }


    /**
     * Return thumbnail name
     *
     * @return string
     */
    public function getThumbnailAttribute(){
        if(!$this->image) return null;

        return str_replace('image', 'thumb', $this->image);
    }


    /**
     * Return thumbnail url
     *
     * @return string
     */
    public function getThumbnailUrlAttribute(){
        if(!$this->image) return null;

        return $this->images_url_prefix . '/' . $this->thumbnail;
    }


    /**
     * Create thumbnail from an image
     */
    public function createThumbnail(){
        if(!$this->image) return;

        Image::make($this->image_path)
            ->fit(100, 100, function (Constraint $constraint){
                $constraint->upsize();
            })
            ->save($this->thumbnail_path);
    }


    /**
     * Find page by url
     *
     * @param $url
     * @return self|null
     */
    static function findByUrl($url){
        return self::where('url', $url)->first();
    }


    /**
     * Get URL record
     *
     * @return mixed
     */
    public function getUrlScope(){
        return Url::where('model', self::class)->where('model_id', $this->id);
    }


    /**
     * Select only given language mutations
     *
     * @param $query
     * @param mixed $language
     */
    public function scopeWhereLanguage($query, $language){
        $query->where("{$this->table}.language_id", is_scalar($language) ? $language : $language->id);
    }


    /**
     * Language
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function language(){
        return $this->hasOne('App\Models\Web\Language', 'id', 'language_id');
    }


    /**
     * Get default page
     *
     * @return mixed
     */
    static function getHomepage($language){
        return Page::where('is_homepage', 1)
            ->whereLanguage($language)
            ->first();
    }


    /**
     * Save page
     *
     * @param array $options
     * @return bool
     */
    public function save(array $options = [])
    {
        if(!parent::save($options)) return false;

        if($this->is_homepage){
            Page::where('is_homepage', 1)
                ->whereLanguage($this->language_id)
                ->where('id', '<>', $this->id)
                ->update([ 'is_homepage' => 0 ]);
        }

        return true;
    }


    /**
     * Update Url of the page.
     */
    public function updateUrl() {
        if ($this->is_homepage) {
            $this->getUrlScope()->delete();
        } else {

            $url = $this->getUrlScope()->first();

            if ($url) {
                $url->update($this->getUrlData());
            } else {
                Url::create($this->getUrlData());
            }

        }
    }

    /**
     * Create page Url.
     */
    public function createUrl() {
        if (!$this->is_homepage) {
            Url::create($this->getUrlData());
        }
    }


    /**
     * Restore Url of the page.
     */
    public function restoreUrl() {
        $this->createUrl();
    }


    /**
     * @param $query
     * @param array $used
     * @return array
     */
    public function scopeRebuildTree($query, $used = []){
        $pages = $query->get()->toHierarchy();
        return $this->recursivePageTree($pages, $used);
    }


    /**
     * Recursively build category tree
     *
     * @param $pages
     * @param array $used
     * @return array
     */
    private function recursivePageTree($pages, $used){
        $result = collect([]);

        foreach ($pages as $page) {

            $value = (object)[
                'key' => $page->id,
                'title' => $page->name,
            ];

            if(in_array($page->id, $used)){
                $value->selected = true;
            }

            if ($page->children) {
                $value->expanded = true;
                $value->children = $this->recursivePageTree($page->children, $used);
            }

            $result->push($value);
        }

        return $result;
    }


    /**
     * Return view data
     *
     * @param $data
     * @return ViewData
     */
    public function getViewData($data){
        if(!$data) {
            $data = new ViewData();
        }

        return $data->fill([
            'title' => $this->seo_title ?: $this->name,
            'description' => $this->seo_description,
            'keywords' => $this->seo_keywords,
        ]);
    }


    /**
     * Get HTML content
     *
     * @return null|string
     */
    public function getContent(){
        if(!$this->content || !trim($this->content)) return null;

        $DOM = new \DOMDocument();
        $DOM->loadHTML(mb_convert_encoding($this->content, 'HTML-ENTITIES', 'UTF-8'));
        $finder = new \DOMXPath($DOM);
        /** @var Collection $enabledModules */
        $enabledModules = InstalledModule::enabled()->get()->pluck('enabled', 'name');

        // Data class
        foreach ($finder->query("//*[@data-class]") as $item) {
            $data = $item->getAttribute("data-class");
            if($data) {
                $class = $item->getAttribute("class") . " " . $data;
                $item->setAttribute("class", $class);
            }
            $item->removeAttribute("data-class");
        }

        // Data id
        foreach ($finder->query("//*[@data-id]") as $item) {
            $id_element = $item->getAttribute("data-id");
            if ($id_element != "") {
                $item->setAttribute("id", $id_element);
            }
            $item->removeAttribute("data-id");
            $item->removeAttribute("data-guid");
        }

        // Module containers
        foreach ($finder->query("//div[@data-module-id]") as $item)
        {   /** @var $item \DOMElement */

            $moduleId = intval($item->getAttribute("data-module-id"));

            /** @var Entity $entity */
            $entity = Entity::find($moduleId);

            if (!$entity || !$enabledModules->get($entity->module)) {
                $item->parentNode->removeChild($item);
                continue;
            }

            $inner = $entity->render([
                'language_id' => $this->language_id
            ]);

            $f = $DOM->createDocumentFragment();
            $result = @$f->appendXML($inner);
            if ($result) {
                $item->parentNode->insertBefore( $f );
            } else {
                $f = new \DOMDocument();
                $inner = mb_convert_encoding($inner, 'HTML-ENTITIES', 'UTF-8');
                $result = @$f->loadHTML('<htmlfragment>'.$inner.'</htmlfragment>');
                if ($result) {
                    $import = $f->getElementsByTagName('htmlfragment')->item(0);
                    foreach ($import->childNodes as $child) {
                        $importedNode = $item->ownerDocument->importNode($child, true);
                        $item->parentNode->insertBefore( $importedNode );
                    }
                }
            }

            $item->parentNode->removeChild($item);
        }

        $body = $DOM->getElementsByTagName('body')->item(0);
        if ( $body ) {
            $html = '';
            foreach($body->childNodes as $node) {
                $html .= $DOM->saveHTML($node);
            }
            return $html;
        }


        return $DOM->saveHTML();
    }


    /**
     * Get data for Url model
     *
     * @return array
     */
    public function getUrlData()
    {
        return [
            'url' => $this->language->language_code . '/' . $this->getAttribute('url'),
            'model' => self::class,
            'model_id' => $this->id
        ];
    }

}
