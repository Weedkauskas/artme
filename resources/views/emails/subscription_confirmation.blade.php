@component('mail::message')
Hooray {{ $name }}<br>

You're just subscribed to ArtmeDev<br>

You can unsubscribe anytime <a href="{{ $unsubscribe }}">here</a>
@endcomponent
