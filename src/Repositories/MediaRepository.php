<?php

namespace JonasPardon\KamiCore\Repositories;

use Optix\Media\Models\Media;

class MediaRepository extends EloquentRepository
{
    /**
     * MediaRepository constructor.
     *
     * @param Media $model
     */
    public function __construct(Media $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        return $this->model
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
