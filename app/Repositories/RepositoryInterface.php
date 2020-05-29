<?php

namespace App\Repositories;

interface RepositoryInterface
{
    public function getAll();

    public function findById($id);

    public function destroy($id);

    public function findByAttr($data = []);

    public function findByAttrGetOne($data = []);

    public function create($data = []);

    public function searchByColumn($data = []);

    public function getAllPaginate($number);

    public function findFirst($data = []);

    public function findByAttrPaginate($data = [], $number);
}
