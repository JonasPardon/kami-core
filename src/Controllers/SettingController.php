<?php

namespace JonasPardon\KamiCore\Controllers;

use App\Http\Controllers\Controller;
use JonasPardon\KamiCore\Repositories\SettingRepository;
use Inertia\Inertia;

class SettingController extends Controller
{
    protected $settingRepository;

    /**
     * SettingController constructor.
     *
     * @param SettingRepository $settingRepository
     */
    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    /**
     * @return \Inertia\Response
     */
    public function index()
    {
        $settings = $this->settingRepository
            ->indexGrouped();

        return Inertia::render('settings/Index',[
            'data' => $settings,
        ]);
    }

    public function update()
    {
        $categories = request()->all();

        foreach($categories as $i => $settings) {
            foreach($settings as $u => $setting) {
                $oldSetting = $this->settingRepository
                    ->show($setting['id']);

                $oldSetting->value = $setting['value'];
                $oldSetting->save();
            }
        }


        return response()->json($settings);
    }
}
