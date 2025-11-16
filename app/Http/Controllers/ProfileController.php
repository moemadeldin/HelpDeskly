<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Auth\UpdateProfileAction;
use App\DTOs\Auth\UpdateProfileDTO;
use App\Http\Requests\UpdateProfileRequest;
use App\Interfaces\ImageManagerInterface;
use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

final class ProfileController extends Controller
{
    public function __construct(private readonly ImageManagerInterface $imageManager) {}

    public function index(): View
    {
        return view('pages.profile');
    }

    public function update(UpdateProfileRequest $request, #[CurrentUser()] User $user, UpdateProfileAction $action): RedirectResponse
    {
        $action->handle(UpdateProfileDTO::fromArray($request->validated()), $user);

        if ($request->hasFile('avatar')) {
            $this->updateAvatar($user, $request->file('avatar'));
        }

        return redirect()->route('home')->with('success', 'User has been updated');
    }

    public function destroy(): RedirectResponse
    {
        Auth::user()->delete();

        return redirect()->route('home')->with('success', 'User has been deleted');
    }

    private function updateAvatar(#[CurrentUser()] User $user, UploadedFile $avatar): void
    {
        $this->imageManager->delete($user->avatar);

        $avatarPath = $this->imageManager->upload(
            $avatar,
            "avatars/{$user->id}"
        );

        $user->update(['avatar' => $avatarPath]);
    }
}
