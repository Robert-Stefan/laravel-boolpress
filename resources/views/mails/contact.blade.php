@component('mail::message')

# Your have a new contact message. 

**Name:** {{ $contact['name'] }}

**Email:** {{ $contact['email'] }}

**Message:** {{ $contact['message'] }}

@component('mail::button', ['url' => ''])
View Order
@endcomponent

Thanks, <br>
{{ config('app.name') }}
@endcomponent
