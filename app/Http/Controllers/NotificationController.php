<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Utilities\Constants;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

final class NotificationController extends Controller
{
    public function index(): View
    {
        $notifications = auth()->user()->notifications()->paginate(Constants::$NUMBER_OF_NOTIFICATIONS);

        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead(string $id): void
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();
    }

    public function markAllAsRead(): void
    {
        auth()->user()->unreadNotifications->markAsRead();

    }

    public function destroy(string $id): RedirectResponse
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->delete();

        return redirect()->route('notifications.index')->with('success', 'removed successfully.');
    }
}
