<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Blog\Repositories\ArticlesRepository as Article;
use App\User;
use App\Category;

class ArticlesController extends Controller
{

    private $article;

    public function __construct(Article $article)
    {
        $this->middleware('auth');
        $this->article = $article;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $articles = $this->article->paginate(10,
            ['id', 'title', 'description', 'author', 'views_count', 'created_at', 'is_published']);
        return view('admin.articles.index')->with(['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $backUrl = $this->storeBackUrl($request);
        $data = $this->prepareArticleData($backUrl);
        return view('admin.articles.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->article->create($request->all());
        $backUrl = $request->session()->pull('backUrl');
        return $backUrl ? redirect()->to($backUrl) : redirect()->route('admin.articles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        // not needed
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Request $request, $id)
    {
        $article = $this->article->find($id);
        $backUrl = $this->storeBackUrl($request);
        $data = $this->prepareArticleData($backUrl, $article);
        return view('admin.articles.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->article->update($request->all(), $id);
        $backUrl = $request->session()->pull('backUrl');
        return $backUrl ? redirect()->to($backUrl) : redirect()->route('admin.articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        // deletion is prohibited from admin side
    }

    private function prepareArticleData($backUrl = '/', $article = null)
    {
        $data = [];
        if (isset($article)) {
            $data['article'] = $article;
        }
        $data['backUrl'] = $backUrl;
        $data['categories'] = Category::all();
        $data['users'] = User::orderBy('name')->lists('name', 'id');
        return $data;
    }

    private function storeBackUrl($request)
    {
        $backUrl = $request->header('referer');
        $request->session()->put('backUrl', $backUrl);
        return $backUrl;
    }
}
