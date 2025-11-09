<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\View\View;

final class AuthController extends Controller
{
    public function registerForm(): View
    {
        return view('auth.register');
    }
    public function register(StoreUserRequest $request)
    {
        $user = User::create($request->validated());

        return $user;
    }
}
