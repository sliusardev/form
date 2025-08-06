<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ __('mail.verify.subject') }}</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f9f9f9; padding: 40px;">
    <div style="max-width: 600px; margin: auto; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px #eee; padding: 32px;">
        <h2>{{ __('mail.verify.greeting', ['name' => $user->name ?? __('User')]) }}</h2>
        <p>{{ __('mail.verify.line1') }}</p>
        <p style="text-align: center; margin: 32px 0;">
            <a href="{{ $url }}" style="background: #3869d4; color: #fff; padding: 12px 24px; border-radius: 4px; text-decoration: none; font-weight: bold;">
                {{ __('mail.verify.action') }}
            </a>
        </p>
        <p>{{ __('mail.verify.line2') }}</p>
        <p style="word-break: break-all;"><a href="{{ $url }}">{{ $url }}</a></p>
        <p style="margin-top: 40px; color: #888;">{{ __('mail.verify.footer') }}</p>
    </div>
</body>
</html>
