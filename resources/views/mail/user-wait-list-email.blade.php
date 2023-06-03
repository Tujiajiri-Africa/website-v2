@component('mail::message')
# Hello There!

Thanks for your interest in {{ $product_name }}. 

We are thrilled to know that you want to join us. 

To confirm waitlist, kindly click the button below to confirm your email address

@component('mail::button', ['url' => $action_url])
Confirm Email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
