<?php

namespace JonasPardon\KamiCore\Controllers;

use App\Http\Controllers\Controller;
use JonasPardon\KamiCore\Repositories\MediaRepository;
use Inertia\Inertia;
use Optix\Media\MediaUploader;

class MediaController extends Controller
{
    protected $mediaRepository;

    /**
     * MediaController constructor.
     *
     * @param MediaRepository $mediaRepository
     */
    public function __construct(MediaRepository $mediaRepository)
    {
        $this->mediaRepository = $mediaRepository;
    }

    /**
     * @return \Inertia\Response
     */
    public function index()
    {
        $media = $this->mediaRepository
            ->index();

        return Inertia::render('media/Index', [
            'data' => $media,
        ]);
    }

    public function store()
    {
        $file = request()->file('file');

        $media = MediaUploader::fromFile($file)->upload();

        return $media;
    }
}
