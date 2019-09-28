<?php

namespace JonasPardon\KamiCore\Repositories;

use JonasPardon\KamiCore\Models\Setting;

class SettingRepository extends EloquentRepository
{
    /**
     * SettingRepository constructor.
     *
     * @param Setting $model
     */
    public function __construct(Setting $model)
    {
        $this->model = $model;
    }

    /**
     * Return all settings grouped under their respective categories.
     *
     * @return array
     */
    public function indexGrouped()
    {
        $settings = $this->model
            ->orderBy('order', 'asc')
            ->get();

        $categories = [];

        foreach($settings as $i => $setting) {
            $categories[$setting->category][] = $setting;
        }

        return $categories;
    }
}
