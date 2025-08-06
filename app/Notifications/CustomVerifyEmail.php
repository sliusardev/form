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
            ->subject(Lang::get('auth.email_verification_email_subject'))
            ->greeting(Lang::get('auth.password_reset_email_greeting'))
            ->line(Lang::get('auth.email_verification_email_body'))
            ->action(Lang::get('auth.verify_email'), $url)
//            ->line(Lang::get('auth.email_verification_link_expired', ['count' => config('auth.verification.expire', 60)]))
            ->line(Lang::get('auth.email_verification_email_footer'))
            ->salutation(Lang::get('auth.password_reset_email_salutation'));
    }

//    public function toMail($notifiable)
//    {
//        $url = $this->verificationUrl($notifiable);
//
//        return (new \Illuminate\Notifications\Messages\MailMessage)
//            ->view('emails.verify', [
//                'url' => $url,
//                'user' => $notifiable,
//            ]);
//    }
}
