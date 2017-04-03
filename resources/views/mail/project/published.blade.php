@component('mail::message')
# Ваш проект был опубликован

Поздравляем, ваш проект {{ $project->name }} прошел модерацию и был опубликован.

@include('projects.display.mail', ['project' => $project])

Спасибо,<br>
{{ config('app.name') }}
@endcomponent
