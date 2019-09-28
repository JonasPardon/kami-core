<?php

namespace JonasPardon\KamiCore\Controllers;

use App\Http\Controllers\Controller;
use JonasPardon\KamiCore\Services\PreviewDefinerService;
use Illuminate\Support\Facades\View;

class PreviewController extends Controller
{
    protected $previewDefinerService;

    public function __construct(PreviewDefinerService $previewDefinerService)
    {
        $this->previewDefinerService = $previewDefinerService;
    }

    public function show()
    {
        $data = request()->all();
        $data = $this->previewDefinerService->parseData($data);

        $targetView = $data['target_view'];
        $view = View::first([
            $targetView,
        ])
            ->with($data);

        try {
            $rendered = $view->render();
            return response($rendered);
        } catch(\Exception $e) {
            return response([
                'message' => __('Preview kon niet geladen worden. Heb je alle velden ingevuld?'),
                'status_code' => 422,
            ]);
        }
    }
}
