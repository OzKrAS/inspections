<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BaseRepository implements IBaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all($columns = array('*'), $with = array('*'))
    {
        return $this->model->with($with)->get($columns);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * @throws \Exception
     */
    public function create(array $data)
    {
        try {
            DB::beginTransaction();
            $result = $this->model->create($data);
            DB::commit();
            return $result;
        }catch (\Exception $e){
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }

    public function update($id, array $data, $attribute = "id")
    {
        return $this->model->where($attribute, $id)->update($data);
    }

    public function delete($id, $attribute = "id")
    {
        return $this->model->where($attribute, $id)->delete();
    }

    public function paginate($perPage = 15, $columns = array('*'), $orderBy = 'id', $order = 'asc')
    {
        return $this->model->orderBy($orderBy, $order)->paginate($perPage, $columns);
    }

    public function search($filters = array('*'), $columns = array('*'), $with = array('*'), $orderBy = 'id', $order = 'asc')
    {
        $query = $this->model;

        foreach ($filters as $filter) {
            if(is_array($filter)){
                $query = $query->where($filter[0], $filter[1], $filter[2]);
            }elseif (is_callable($filter)) {
                $query = $query->where($filter);
            }
        }

        return $query->orderBy($orderBy, $order)->get();
    }
}