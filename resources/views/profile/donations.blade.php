@extends('layouts.main')

@section('title', 'Платежи')

@section('content')
    <section class="donations-page">
        <div class="donations__inner">
            <div class="donations__head">
                <h1 class="nb-heading donations__heading">История моих платежей</h1>
                <div class="donations__body">
                    <p class="donations__txt">Если профинансированный проект не соберет необходимую сумму, то вы сможете вернуть деньги.</p>
                    @if (count($sponsors))
                    <table class="payments-table">
                        <thead class="info__thead">
                        <tr>
                            <th class="donations__th--project">Проект</th>
                            <th class="donations__th--status">Статус</th>
                            <th class="donations__th--sum">Сумма</th>
                            <th class="donations__th--date">Дата</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($sponsors as $sponsor)
                        <tr>
                            <td>
                                <span class="donations__img-clip">
                                    <img class="donations__img" width="30" height="23" src="{{ $sponsor->project->getImageUrl('small') }}" alt="image">
                                </span>
                                <a href="/project?id=112671" class="donations__link">{{ $sponsor->project->name }}</a>
                            </td>
                            <td>
                                <span class="donations__status--success">Проведен</span>
                            </td>
                            <td>{{ $sponsor->sum }} руб.</td>
                            <td>{{ $sponsor->created_at }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                        @else
                        <div class="message--empty">
                            <p>Попробуйте найти что-нибудь интересное!</p>
                            <a href="/projects?filter=start">Новые проекты</a>
                        </div>
                        @endif
                </div>
            </div>
        </div>
    </section>
@endsection
