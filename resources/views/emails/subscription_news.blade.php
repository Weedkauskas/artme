@component('mail::message')
Aloha {{ $name }}<br>

Here's some new phrases from programmers world<br>

@foreach($data as $magic => $phrases)
<div style="font-weight: bold">{{ $magic }}</div>
@foreach($phrases as $phrase)
<div>{{ $phrase }}</div>
@endforeach
<br>
@endforeach

<br>

You can unsubscribe anytime <a href="{{ $unsubscribe }}">here</a>
@endcomponent
