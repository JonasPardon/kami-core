<?php

namespace JonasPardon\KamiCore\Repositories;

use JonasPardon\KamiCore\Models\Page;

class PageRepository extends EloquentRepository
{
    /**
     * PageRepository constructor.
     *
     * @param Page $model
     */
    public function __construct(Page $model)
    {
        $this->model = $model;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function showById($id)
    {
        return $this->model
            ->with('blocks')
            ->where('id', $id)
            ->first();
    }

    public function update($id, array $data)
    {
        $model = $this->model
            ->where('id', $id)
            ->first();
        $model->fill($data);
        $model->save();

        return $model;
    }
}
