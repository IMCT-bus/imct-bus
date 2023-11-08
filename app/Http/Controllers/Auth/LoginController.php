<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Response;

class LoginController extends BaseController
{
    public function index(): Response
    {
        return inertia('Admin/Login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();
            return redirect()->route('admin.routes.create');
        }

        return redirect()->route('admin.login.index')
            ->withErrors(['loginError' => 'Неверный пароль']);
    }
}
