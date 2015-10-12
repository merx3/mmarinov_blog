<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Blog\Repositories\ArticlesRepository;
use App\Blog\Helpers\SocialMediaCounter;

class ArticlesController extends Controller
{

    private $article;
    private $socialCounter;

    public function __construct(ArticlesRepository $articleRepo, SocialMediaCounter $counter)
    {
        $this->article = $articleRepo;
        $this->socialCounter = $counter;
    }

    /**
     * Display paginated list of posts and their short description. (for now it's just a static page)
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $data = [];
        $category = $request->input('category');
        $data['articles'] = ($category === null) ? 
            $this->article->paginateBy(['is_published' => true]) : 
            $this->article->paginateBy(['category' => $category, 'is_published' => true]);
        $data['title'] = 'Marian\'s Laravel and PhP blog';
        $data['header_type'] = 'articles';
        $data['header_content'] = '<h1>PhP, Laravel and others</h1>
                    <span class="subheading">The creative mess of the web illustrated in articles</span>';
        $data['pageDescription'] = 'If you\'re interested in learning about Laravel or PhP, these articles will help you find some interesting and useful information on that matter.';
        $data['pageKeywords'] = 'laravel, php, laravel 5, laravel 5.1, blog, posts, html, web, development, articles';
        return view('articles.index', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Request $request, $slug)
    {
        $data = [];
        $showHidden = $request->get('hidden') !== null;
        $article = $this->article->findBy('slug', $slug);
        if (is_null($article) || ($article->is_published == false && $showHidden == false)) {
            abort(404);
        }
        if($showHidden) { 
            // article is in hidden mode => hide page from crawlers, don't increase article view count
            $data['isHidden'] = true; 
        } else {
            // article is in showing mode => don't hide page from crawlers, increase article view count
            $article->increaseViewsCount(); 
        }
        $data = array_merge($data, $this->prepareArticleData($article));
        return view('articles.show')->with($data);
    }

    private function prepareArticleData($article)
    {
        $data = [];
        $data['article'] = $article;
        $data['title'] = $article->title . ' - Marian Marinov\'s Blog';
        $data['header_type'] = 'articles';
        $data['pageDescription'] = $article->description;
        $data['pageKeywords'] = $article->keywords;
        $articleUrl = route('articles.show', ['slug' => $article->slug]);
        $data['articleUrl'] = $articleUrl;
        $data['sharesCount'] = $this->socialCounter->getSocialMediasCounts($articleUrl);
        return $data;
    }
}
