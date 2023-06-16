<?php

namespace App\Repositories;

interface IBaseRepository
{
    public function all($columns = array('*'), $with = array('*'));

    public function find($id);

    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);

    public function paginate($perPage = 15, $columns = array('*'));

    public function search($filters = array('*'), $columns = array('*'), $with = array('*'), $orderBy = 'id', $order = 'asc');
}