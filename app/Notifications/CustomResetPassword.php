<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as BaseResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class CustomResetPassword extends BaseResetPassword
{
    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $resetUrl = url(config('app.url').route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject(Lang::get('auth.password_reset_email_subject'))
            ->greeting(Lang::get('auth.password_reset_email_greeting'))
            ->line(Lang::get('auth.password_reset_email_body'))
            ->action(Lang::get('auth.password_reset_email_action'), $resetUrl)
//            ->line(Lang::get('auth.password_reset_email_expire', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
            ->line(Lang::get('auth.password_reset_email_footer'))
            ->salutation(Lang::get('auth.password_reset_email_salutation'));
    }
}
