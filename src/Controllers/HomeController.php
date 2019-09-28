<?php

namespace JonasPardon\KamiCore\Controllers;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Home', [
            'welcomeMessage' => 'Welcome to your dashboard',
        ]);
    }
}
