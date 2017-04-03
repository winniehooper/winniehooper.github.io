@extends('layouts.main')

@section('content')

    <section class="recover-page">
        <div class="recover-page-center">
            <div class="recover-content">
                <h3 class="nb-heading">Введите новый пароль</h3>


                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{ url('/restore') }}" method="post" class="recover__form" id="js-recover-form" autocomplete="off">
                    {{ csrf_field() }}

                    <input type="hidden" name="token" value="{{ $token }}">


                    <div class="recover__inputs-group">
                        <div class="nb-input-wrap popup__input-wrap">
                            <input id="js-recover-email-input" type="email" name="email" class="nb-input" placeholder="E-Mail">
                            @if ($errors->has('email'))
                                <span class="">
                                        <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="nb-input-wrap popup__input-wrap">
                            <input id="js-recover-pass-input" type="password" name="password" class="nb-input" placeholder="Новый пароль">
                            @if ($errors->has('password'))
                                <span class="">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif

                        </div>
                        <div class="nb-input-wrap popup__input-wrap">
                            <input id="js-recover-pass2-input" type="password" name="password_confirmation" placeholder="Повторите пароль" class="nb-input">
                            @if ($errors->has('password_confirmation'))
                                <span class="">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <button type="submit" class="nb-btn form__btn-action" id="js-submit-recover">Изменить пароль</button>


                </form>

            </div>
        </div>
    </section>


@endsection
