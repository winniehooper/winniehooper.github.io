@extends('layouts.receipt')

@section('title', 'Платёж выполнен')

@section('content')
    <div class="content-block">
        <img src="/img/payment/logo.png" alt="logo" class="block margin-auto margin-bottom-20">
        <div id="receipt" class="check print">
            <table class="check-block">
                <tbody><tr>
                    <td class="medium font-size-16" colspan="2">Чек № {{ $order->transaction->id }} </td>
                </tr>
                <tr>
                    <td colspan="2">{{ $order->transaction->created_at }}</td>
                </tr>
                <tr>
                    <td colspan="2" class="dashed"></td>
                </tr>
                <tr>
                    <td class="medium padding-top-15">Итого:</td>
                    <td class="medium padding-top-15 float-right">{{ $order->transaction->amount }} руб</td>
                </tr>
                </tbody></table>

            <img src="/img/payment/stamp.png" alt="stamp" class="stamp-ok">
        </div>

        <a class="btn-green block margin-auto" style="width:177px" href="{{ route('project', $order->project) }}">Вернуться к проекту</a>
        <a class="btn-cancel block" style="width:177px" href="/">Вернуться на Суполку</a>

        <ul class="check-print" style="padding:0">
            <li>
                <a id="print" href="javascript:void(0);">Отправить чек на печать</a>
            </li>
        </ul>
        <script>
            $('#print').on('click', function(){
                $.print('#receipt', {
                    stylesheet: '/css/print.css'
                });
                return false;
            });

            ga('ecommerce:addTransaction', {
                'id': '{{ $order->transaction->id }}',
                'affiliation': '{{ $order->project->name }}',
                'revenue': '{{ $order->transaction->amount }}',
                'currency': '{{ $order->transaction->currency }}'
            });
            ga('ecommerce:addItem', {
                'id': '{{ $order->transaction->id }}',
                'name': '{{ $order->project->name }}',
                'sku': '{{ $order->project->id }}',
                'price': '{{ $order->transaction->amount }}',
                'quantity': '1'
            });
            ga('ecommerce:send');
        </script>

    </div>
@endsection