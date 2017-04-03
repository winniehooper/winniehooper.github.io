@component('mail::message')
# {{ $user->name }}, Спасибо за регистрацию!

Теперь вы стали частью нашего сообщества. 

Для завершения регистрации вам необходимо подтвердить свой email. 

@component('mail::button', ['url' => URL::to('register/verify/' . $user->confirmation_code)])
Подтвердить email
@endcomponent


Если это письмо было отправлено к вам по ошибке, то просто проигнорируйте его.

Спасибо,<br>
{{ config('app.name') }}
@endcomponent
