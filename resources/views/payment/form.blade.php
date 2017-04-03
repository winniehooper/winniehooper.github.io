@extends('layouts.main')

@section('title', 'Форма оплаты')

@section('content')
    <div class="pay-page">
    <div class="pay__inner">
        <form action="{{ $form['action'] }}" method="post">
            @foreach ($form['params'] as $key => $value)
                @if (is_array($value))
                    @foreach ($value as $i => $val)
                        <input type="text" name="{{ $key }}[{{ $i }}]" value="{{ trim($val) }}">
                    @endforeach
                @else
                    <label>{{$key}}</label>
                    <input type="text" name="{{ $key }}" value="{{ trim($value) }}">
                    <br>
                @endif
            @endforeach

            <div class="message">Вы будете перенаправлены на сайт платежной системы WebPay.by<br>Для продолжения нажмите кнопку Оплатить</div>
            <button>Оплатить</button>
            <button onclick='location.href="{{ url('/') }}"'>Отмена</button>
        </form>
        </div>
    </div>


@endsection


