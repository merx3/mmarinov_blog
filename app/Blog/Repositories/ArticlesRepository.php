<?php namespace App\Blog\Repositories;

use App\Blog\Repositories\Contracts\RepositoryInterface;
use App\Article;

class ArticlesRepository implements RepositoryInterface {

    private $repository;

    public function __construct()
    {
        $this->repository = new Article();
    }

    public function all($columns = array('*'))
    {
        return $this->repository->get($columns);
    }

    public function paginate($perPage = 10, $columns = array('*'))
    {
        if(in_array('author', $columns))
        {
            $columns = array_map(function($v){
                return ($v == 'author') ? 'author_id' : $v;
            }, $columns);
        }
        return $this->repository->orderBy('published_at', 'desc')->with('author')->select($columns)->paginate($perPage);
    }

    public function create(array $data)
    {
        $article = $this->repository->create($data);
        $article->setPublishedAttributes($data);
        $article->save();
        $article->categoriesString = $data['categoriesString'];
        return $article;
    }

    public function update(array $data, $id, $attribute = 'id')
    {
        $article = $this->repository->find($id);
        $article->update($data);
        $article->setPublishedAttributes($data);
        $article->categoriesString = $data['categoriesString'];
        $article->save();
        return $article;
    }

    public function delete($id, $attribute = 'id')
    {
        return $this->repository->where($attribute, '=', $id)->delete();
    }

    public function find($id, $columns = array('*'))
    {
        return $this->repository->find($id, $columns);
    }

    public function findBy($field, $value, $columns = array('*'))
    {
        return $this->repository->where($field, '=', $value)->first($columns);    
    }

    public function paginateBy($filters, $perPage = 10)
    {        
        $queryBuilder = $this->repository;
        foreach ($filters as $field => $value) {            
            if($field == 'category'){
                $queryBuilder = $queryBuilder->whereHas('categories', function ($query) use ($value) {
                        $query->where('name', $value);
                    });
            } else {
                $queryBuilder = $queryBuilder->where($field, '=', $value); 
            }
        }
        return $queryBuilder->orderBy('published_at', 'desc')->paginate($perPage);
    }
}