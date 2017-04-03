@component('mail::message')
# У вас новое сообщение от пользователя {{ $message->from->name }}

Пользователь {{ $message->from->name }} отправил вам сообщение:

{{ $message->text }}

@endcomponent
