@component('mail::message')
#Заказ принят! Спасибо, что поддержали проект:


@include('projects.display.mail', ['project' => $sponsor->project])


{{ $sponsor->sum }} руб.
ВЫ ПЕРЕЧИСЛИЛИ

@if ($sponsor->gift)
    {{ $sponsor->gift->description }}
@endif

@endcomponent
