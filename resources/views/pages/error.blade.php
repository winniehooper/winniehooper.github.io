@extends('layouts.main')

@section('title', 'Ошибка')

@section('content')
    <section class="error-page">
        <div class="error-page-center">
            <div class="error-content">
                <h1 class="error-numbers" style="visibility: hidden">403</h1>
                <h2 class="nb-heading--large error__heading--large">Извините!</h2>
                <p class="error-txt">Ведутся профилактические работы.</p>
            </div>
        </div>
    </section>
@endsection