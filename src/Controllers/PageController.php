<?php

namespace JonasPardon\KamiCore\Controllers;

use App\Http\Controllers\Controller;
use JonasPardon\KamiCore\Models\Block;
use JonasPardon\KamiCore\Repositories\PageRepository;
use Inertia\Inertia;

class PageController extends Controller
{
    protected $pageRepository;

    /**
     * PagesController constructor.
     *
     * @param PageRepository $pageRepository
     */
    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    /**
     * @return \Inertia\Response
     */
    public function index()
    {
        $pages = $this->pageRepository
            ->index();

        return Inertia::render('pages/Index', [
            'pages' => $pages,
        ]);
    }

    /**
     * @param $id
     *
     * @return \Inertia\Response
     */
    public function show($id)
    {
        $page = $this->pageRepository
            ->showById($id);

        if (!$page) return $this->create();

        return Inertia::render('pages/Detail', [
            'data' => $page,
        ]);
    }

    /**
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('pages/Detail', [
            'isCreate' => true,
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        $data = request()->all();

        $page = $this->pageRepository
            ->create($data);

        return response()->json($page, 201);
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id)
    {
        $data = request()->all();

        $page = $this->pageRepository
            ->update($id, $data);

        $this->syncBlocks($page, $data);

        return response()->json($page, 200);
    }

    private function syncBlocks($page, $data)
    {
        $blocks = [];
        foreach($data['blocks'] as $i => $block) {
            $blocks[] = new Block($block);
        }

        $page->blocks()->delete();
        $page->blocks()->saveMany($blocks);
    }
}
