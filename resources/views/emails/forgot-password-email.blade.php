@component('mail::message')
@lang('translation.hi') {{  $details['username'] }}

@lang('translation.reset_email_narration')

@php
$url = '';
if($details['user_role'] == 1)
{
    $url = route('admin.auth.reset-password', ['token' => $details['token']]);
}
else
{
    $url = route('portal.auth.reset-password', ['token' => $details['token']]);
}
@endphp

@component('mail::button', ['url' => $url])
@lang('translation.reset_password')
@endcomponent

@lang('translation.thanks')<br>
{{ config('app.name') }}
@endcomponent
