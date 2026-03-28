<!DOCTYPE html>
<html lang="{{ $locale ?? app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <style>
        body        { margin:0; padding:0; background:#f4f6fb; font-family:'Helvetica Neue',Arial,sans-serif; font-size:14px; color:#333; }
        .wrap       { max-width:520px; margin:40px auto; background:#fff; border-top:3px solid #0a1b48; }
        .header     { background:#0a1b48; padding:28px 36px; }
        .logo       { font-size:22px; font-weight:700; letter-spacing:2px; color:#fff; text-decoration:none; }
        .logo span  { color:rgba(255,255,255,0.45); }
        .body       { padding:36px; }
        h2          { font-size:20px; font-weight:700; color:#0a1b48; margin:0 0 12px; }
        p           { margin:0 0 16px; color:#555; line-height:1.7; font-size:14px; }
        .btn        { display:inline-block; background:#0a1b48; color:#fff !important; text-decoration:none;
            padding:13px 32px; font-size:14px; font-weight:600; letter-spacing:0.5px; margin:8px 0 24px; }
        .note       { font-size:12px; color:#999; border-top:1px solid #eee; padding-top:16px; margin-top:8px; }
        .url        { word-break:break-all; color:#0a1b48; font-size:12px; }
        .footer     { background:#f4f6fb; padding:16px 36px; font-size:11px; color:#aaa; text-align:center; }
    </style>
</head>
<body>
<div class="wrap">
    <div class="header">
        <span class="logo">AVA<span>Motors</span></span>
    </div>
    <div class="body">
        <h2>{{ __('emails.verify_email.title') }}</h2>

        @if(!empty($userName ?? ''))
            <p>{{ __('emails.verify_email.greeting', ['name' => $userName]) }}</p>
        @endif

        <p>{{ __('emails.verify_email.message') }}</p>

        <a href="{{ $verifyUrl }}" class="btn">{{ __('emails.verify_email.button') }}</a>

        <p>{{ __('emails.verify_email.expiry') }}</p>

        <div class="note">
            <p>{{ __('emails.verify_email.ignore') }}</p>
            <p>{{ __('emails.verify_email.copy_link') }}<br>
                <span class="url">{{ $verifyUrl }}</span>
            </p>
        </div>
    </div>
    <div class="footer">
        {{ __('emails.verify_email.footer', ['year' => date('Y')]) }}
    </div>
</div>
</body>
</html>
