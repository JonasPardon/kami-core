<?php

namespace JonasPardon\KamiCore\Controllers;

use App\Http\Controllers\Controller;
use JonasPardon\KamiCore\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthController extends Controller
{
    protected $userRepository;

    /**
     * AuthController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function showLogin()
    {
        return Inertia::render('Login');
    }

    public function submitLogin()
    {
        $credentials = request()->all();

        if (Auth::attempt($credentials)) {
            return response()->json(Auth::user());
        } else {
            return response()->json([
                'error' => 'Incorrect credentials',
            ]);
        }
    }

    /**
     * @return \Inertia\Response
     */
    public function usersIndex()
    {
        $users = $this->userRepository
            ->index();

        return Inertia::render('auth/Users', [
            'users' => $users,
        ]);
    }

    public function usersShow($id)
    {
        $user = $this->userRepository
            ->show($id);

        if (!$user) return $this->usersCreate();

        return Inertia::render('auth/UserDetail', [
            'data' => $user,
        ]);
    }

    public function usersCreate()
    {
        return Inertia::render('auth/UserDetail', [
            'isCreate' => true,
        ]);
    }
}
