<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\PasswordResetLinkCreated;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Mail;

final class SendPasswordResetNotification
{
    public function handle(PasswordResetLinkCreated $event): void
    {
        Mail::to($event->user->email)
            ->queue(new ResetPasswordMail($event->user, $event->verification_code, $event->verification_code_expire_at));

    }
}
