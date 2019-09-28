<?php

namespace JonasPardon\KamiCore\Repositories;

use JonasPardon\KamiCore\Models\User;

class UserRepository extends EloquentRepository
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
