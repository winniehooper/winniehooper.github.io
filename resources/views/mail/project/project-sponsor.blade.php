@component('mail::message')
#В пользу вашего проекта произошел платеж:

@include('projects.display.mail', ['project' => $sponsor->project])

{{ $sponsor->sum }} руб.
Вам перечислили

@if ($sponsor->gift)
    {{ $sponsor->gift->description }}
@endif

@endcomponent
