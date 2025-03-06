@component('mail::message')

<p>Welcome</p>
<p><br></p>

<p>Email : {{ $request->email }}</p>
<p>Subject : {{ $request->subject }}</p>
<p>Message : {{  $request->message }}</p>

<p></p>
<p>Thank You</p>
<p>{{ config('app.name') }}</p>
@endcomponent