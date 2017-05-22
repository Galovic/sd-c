<?php

namespace App\Models\Article;

use App\Models\Interfaces\UrlInterface;
use App\Models\Web\Language;
use App\Models\Web\Url;
use App\Models\Web\ViewData;
use App\Traits\AdvancedEloquentTrait;
use Baum\Node;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Category extends Node implements UrlInterface
{

    use SoftDeletes, AdvancedEloquentTrait;

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name', 'url', 'seo_title', 'seo_description', 'seo_keywords',  'parent_id',
        'show'
    ];

    protected $dates = [ 'deleted_at', 'published_at', 'unpublished_at' ];

    /**
     * The attributes excluded from the model's JSON form.
     * @var array
     */
    protected $hidden = [];


    /**
     * Get all category id by web_id
     *
     * @param int $language_id
     * @return Category
     */
    public function getAllByWebLanguage($language_id)
    {
        return $this->select('id')
            ->where('language', $language_id)
            ->orderBy('id', 'ASC')
            ->get();
    }

    public function getLastNameAttribute() {
        return $this->belongsTo('App\Models\User', 'user_id')->get()->first()->last_name;
    }

    /**
     * Get level Category from parent id
     * @param array /string $url
     * @return Category
     */
    public function getCategoryByUrl($url)
    {
        if (!is_array($url)) {
            $url = [$url];
        }

        $categories = $this->where('deleted', 0)->where('language', session()->get('language'))->where('level', '<=', count($url))->get();

        $parent_id = 0;
        foreach ($url as $level => $single_url) {
            foreach ($categories as $category) {
                if ($category->level == $level + 1 && $category->parent_id == $parent_id && $category->url == $single_url) {
                    $parent_id = $category->id;
                    $current = $category;
                    break;
                }
            }
        }

        return (isset($current) ? ($current->level == count($url) ? $current : FALSE) : FALSE);
    }

    public function setAttribute($key, $value)
    {
        if (is_scalar($value)) {
            $value = $this->emptyStringToNull(trim($value));
        }

        return parent::setAttribute($key, $value);
    }

    /**
     * Set null instead of empty string
     *
     * @param $string
     * @return null|string
     */

    private function emptyStringToNull($string)
    {
        //trim every value
        $string = trim($string);

        if ($string === ''){
            return null;
        }

        return $string;
    }


    /**
     * Select articles only
     *
     * @param $query
     */
    public function scopeArticlesOnly($query){
        $query->where("{$this->table}.flag", 'articles');
    }


    /**
     * Select only language mutations
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
     * @param $query
     * @return array
     */
    public function scopeRebuildTree($query){
        return $this->buildCategoryTree($query);
    }


    /**
     * Builds tree of categories
     *
     * @param $query
     * @param Article|null $article
     * @return array
     */
    public function buildCategoryTree($query, Article $article = null){
        $articleCategories = $article && $article->exists ?
            $article->categories()->pluck('id') : collect([]);

        $categories = $query->get()->toHierarchy();

        return $this->recursiveCategoryTree($categories, $articleCategories);
    }


    /**
     * Recursively build category tree
     *
     * @param $categories
     * @param $articleCategories
     * @return array
     */
    private function recursiveCategoryTree($categories, $articleCategories){
        $result = [];

        foreach ($categories as $category) {

            $value = (object)[
                'key' => $category->id,
                'title' => $category->name,
            ];

            if ($articleCategories->contains($category->id)) {
                $value->selected = true;
            }

            if ($category->children) {
                $value->expanded = true;
                $value->children = $this->recursiveCategoryTree($category->children, $articleCategories);
            }

            $result[] = $value;
        }

        return $result;
    }


    /**
     * Articles that belong to category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function articles(){
        return $this->belongsToMany('App\Models\Article\Article', 'articles_categories');
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
     * Update Url when changed.
     */
    public function updateUrl() {
        $oldUrl = $this->getUrlScope()->first()->url;

        $urlData = $this->getUrlData();
        $this->getUrlScope()->update($urlData);

        Url::where('url', 'LIKE', "{$oldUrl}/%")
            ->update([
                'url' => DB::raw("REPLACE(url, '{$oldUrl}', '{$urlData['url']}')")
            ]);
    }


    /**
     * Delete Url.
     */
    public function deleteUrl() {
        $oldUrl = $this->getUrlScope()->first()->url;
        $this->getUrlScope()->delete();

        Url::where('url', 'LIKE', "{$oldUrl}/%")
            ->delete();
    }


    /**
     * Restore Url.
     */
    public function restoreUrl() {
        $urlData = $this->getUrlData();

        if (Url::findUrl($urlData['url'])) return;

        $newUrl = Url::create($urlData);

        /** @var Article $article */
        foreach ($this->articles as $article) {
            Url::create($article->getUrlData($newUrl->url));
        }
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
     * Get data for Url model
     *
     * @return array
     */
    public function getUrlData()
    {
        $newUrl = $this->language->language_code . '/' . $this->flag . '/' . $this->url;

        return [
            'url' => $newUrl,
            'model' => self::class,
            'model_id' => $this->id
        ];
    }
}
