@component('mail::message')
Hi, {{ $user->username }}. Please new account password set
<p>It happens, click the link below...</p>    
@component('mail::button', ['url' => url('set_new_password/'. $user->remember_token)])
Set Your Password    
@endcomponent

Thank you.

@endcomponent