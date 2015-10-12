<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class Article extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'articles';

    protected $dates = ['created_at', 'updated_at', 'published_at'];

    protected $fillable = [ 'title', 'description', 'slug', 'keywords', 'author_id', 'content', 'photo_path' ];

    public function author()
    {
        return $this->belongsTo('App\User', 'author_id');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category', 'article_categories');
    }

    public function getPublishedAtAttribute($date)
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y');
    }

    public function setPublishedAttributes($data)
    {
        $this->is_published = array_key_exists('is_published', $data);
        $this->published_at = \Carbon\Carbon::createFromFormat('d/m/Y', $data['published_at']);
    }

    public function getPublishedAtFormattedAttribute()
    {
        return \Carbon\Carbon::createFromFormat('d/m/Y', $this->published_at)->format('F d, Y');
    }

    public function getCategoriesStringAttribute()
    {
        return implode(', ', $this->categories->lists('name')->toArray());
    }

    public function setCategoriesStringAttribute($categories)
    {
        $currentCategories = $this->categories;
        $categoryNames =  array_filter(array_map('trim', explode(',', $categories)), 'strlen');
        $this->removeDeletedCategories($currentCategories, $categoryNames);
        $this->addNewCategories($currentCategories, $categoryNames);
    }

    public function getCategoriesLinksAttribute()
    {
        $categories = $this->categories->lists('name')->toArray();
        $categoriesLinks = [];
        foreach ($categories as $category) {
            $categoriesLinks[] = "<a href='" . route('articles.index', ['category' => $category]) . "'>$category</a>";
        }
        return implode(', ', $categoriesLinks);
    }

    public function increaseViewsCount()
    {
        $this->views_count++;
        $this->save();
    }

    private function removeDeletedCategories($currentCategories, $categoryNames)
    {
        $lowercaseCategoryNames = array_map('strtolower', $categoryNames);
        foreach ($currentCategories as $currentCategory) {
            if(!in_array(strtolower($currentCategory->name), $lowercaseCategoryNames)) {
                $this->categories()->detach($currentCategory->id);
            }
        }
    }

    private function addNewCategories($currentCategories, $categoryNames)
    {
        foreach ($categoryNames as $categoryName) {
            $dbCategory = Category::whereRaw('LOWER(`name`)  = ?', [strtolower($categoryName)])->first();
            if ($dbCategory === null) {
                $category = new Category();
                $category->name = $categoryName;
                $category->save();
                $this->categories()->attach($category->id);
            } else {
                if(!$this->categories->contains($dbCategory->id)) {
                    $this->categories()->attach($dbCategory->id);    
                }
            }
        }        
    }
}
