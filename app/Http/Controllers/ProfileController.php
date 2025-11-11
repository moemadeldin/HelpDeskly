<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTOs\Auth\ProfileDTO;
use App\Http\Requests\UpdateProfileRequest;
use App\Interfaces\ProfileManagerInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

final class ProfileController extends Controller
{
    public function __construct(private readonly ProfileManagerInterface $profileManagerService) {}

    public function index(): View
    {
        return view('pages.profile');
    }

    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        $this->profileManagerService->updateProfile(ProfileDTO::fromArray($request->validated()));

        if ($request->hasFile('avatar')) {
            $this->profileManagerService->updateAvatar(Auth::user(), $request->file('avatar'), ProfileDTO::fromArray($request->validated()));
        }

        return redirect()->route('home')->with('success', 'User has been updated');
    }

    public function destroy(): RedirectResponse
    {
        Auth::user()->delete();

        return redirect()->route('home')->with('success', 'User has been deleted');
    }
}
