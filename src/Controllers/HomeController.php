<?php

namespace JonasPardon\KamiCore\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use JonasPardon\KamiCore\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Home', []);
    }
}
