<?php

namespace BlogApi\Core\Listeners;

use BlogApi\Core\Events\PasswordReset;
use BlogApi\Core\Notifications\ResetPassword;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendResetPasswordEmail implements ShouldQueue
{
    /**
     * @param PasswordReset $event
     */
    public function handle(PasswordReset $event): void
    {
        $event->getUser()->notify(
            new ResetPassword(
                $event->getUser()->reset_password_token
            )
        );
    }
}