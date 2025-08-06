<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class CustomVerifyEmail extends BaseVerifyEmail
{
    /**
     * Get the verify email notification mail message for the given URL.
     *
     * @param  string  $url
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    protected function buildMailMessage($url)
    {
        return (new MailMessage)
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->subject(Lang::get('Welcome to Our Application - Verify Your Email'))
            ->greeting(Lang::get('Hello!'))
            ->line(Lang::get('Thank you for registering with our application.'))
            ->line(Lang::get('Please click the button below to verify your email address and complete your registration.'))
            ->action(Lang::get('Verify My Email'), $url)
            ->line(Lang::get('This verification link will expire in :count minutes.', ['count' => config('auth.verification.expire', 60)]))
            ->line(Lang::get('If you did not create an account, no further action is required.'))
            ->salutation(Lang::get('Regards, The Team'));
    }

    public function toMail($notifiable)
    {
        $url = $this->verificationUrl($notifiable);

        return (new \Illuminate\Notifications\Messages\MailMessage)
            ->view('emails.verify', [
                'url' => $url,
                'user' => $notifiable,
            ]);
    }
}
