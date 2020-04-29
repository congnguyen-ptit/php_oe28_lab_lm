<?php

namespace App\Repositories;

interface RepositoryInterface
{
    public function getAll();

    public function findById($id);

    public function update($id, $data = []);

    public function destroy($id);

    public function findByAttr($data = []);

    public function findByAttrGetOne($data = []);

    public function create($data = []);

    public function searchByColumn($data = []);

    public function getAllPaginate($number);
}
