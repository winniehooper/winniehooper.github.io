@extends('layouts.main')

@section('title', 'Уведомления')

@section('content')
    <section class="notifications-page">
        <div class="notifications__inner">
            <div class="notifications__head">
                @if (count($notifications))
                <h1 class="nb-heading notifications__heading">Мои Уведомления</h1>
                    @else
                    <h1 class="nb-heading notifications__heading">Нет уведомлений</h1>
                @endif
            </div>
            <div class="notifications__body">
                @foreach ($notifications as $notification)

                    <div class="nb-notification cf">
                        <div class="nb-notification__left">
                            @include('notifications.types.'.$notification->data['icon'])
                        </div>
                        <div class="nb-notification__center">
                            <h2 class="nb-heading--small nb-notification__heading">{!! $notification->data['subject'] !!}</h2>
                            <div class="nb-notification__content">
                                <p>{!! $notification->data['message'] !!}</p>
                            </div>
                            <div class="nb-notification__info">
                                @if (!$notification->read_at)
                                    <span class="nb-notification__info-label">Новое</span>
                                @endif
                                <time class="nb-notification__info-time" datetime="">{{ $notification->created_at }}</time>
                            </div>
                        </div>
                        @if (isset($notification->data['action_url']))
                        <div class="nb-notification__right">
                            <a href="{{ url($notification->data['action_url']) }}" class="nb-link">{{ $notification->data['action_text'] }}</a>

                        </div>
                        @endif
                        <hr class="nb-notification__border">
                    </div>
                @endforeach
            </div>
            <div class="notifications__foot">
            </div>
        </div>
    </section>
@endsection
