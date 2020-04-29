<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class ModelRepository implements RepositoryInterface
{
    protected $model;

    function __construct()
    {
        $this->setModel();
    }

    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    abstract public function getModel();

    public function getAll()
    {
        return $this->model->all();
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    abstract public function update($id, $data = []);

    public function destroy($id)
    {
        $result = $this->findById($id);
        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }

    public function findByAttr($data = [])
    {
        $result = $this->model->where($data)->get();

        return $result;
    }

    public function create($data = [])
    {
        $this->getModel()->create($data);
    }

    public function findByAttrGetOne($data = [])
    {
        $result = $this->model->where($data)->firstOrFail();

        return $result;
    }

    public function searchByColumn($data = [])
    {
        $column = $data['column'];
        $operator = $data['operator'];
        $keywords = $data['keywords'];
        $pages = $data['pages'];
        $result = $this->model->where("$column", "$operator", "%{$keywords}%")->paginate($pages);

        return $result;
    }

    public function getAllPaginate($number)
    {
        return $this->model->paginate($number);
    }
}

