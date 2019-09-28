<?php

namespace JonasPardon\KamiCore\Repositories;

use Illuminate\Http\JsonResponse;

class EloquentRepository
{
    protected $model;

    public function index()
    {
        $models = $this->model
            ->all();

        return $models;
    }

    public function show($id)
    {
        $model = $this->model
            ->where($this->model->getRouteKeyName(), $id)
            ->first();

        return $model;
    }

    public function update($id, array $data)
    {
        $model = $this->show($id);
        $model->fill($data);
        $model->save();

        return $model;
    }

    public function create(array $data)
    {
        $model = new $this->model;
        $model->fill($data);
        $model->save();

        return $model;
    }

    public function delete($id)
    {
        $model = $this->show($id);
        $model->delete();

        return true;
    }
}
