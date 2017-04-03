@extends('layouts.receipt')

@section('title', 'Платёж совершить не удалось')

@section('content')
<div class="content-block">
    <img src="/img/payment/logo.png" alt="logo" class="block margin-auto margin-bottom-20"/>
    <div id="receipt" class="check print">
        <table class="check-block">
            <tr>
                <td class="medium font-size-16" colspan="2">Чек № {{ $order->transaction->id }} <span class="error-text float-right">Ошибка</span></td>
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
        </table>

        <p class="padding-left-20 padding-top-10">Возможные причины отказа:</p>
        <ol>
            <li>
                <div class="list">
                    <span>Ваш банк ограничил использование вашей карты для проведения операции.</span>
                </div>
            </li>
            <li>
                <div class="list">
                    <span>У вас не подключена услуга<br> 3D Secure.</span>
                </div>
            </li>
            <li>
                <div class="list">
                    <span>Недостаточно средств на проведение операции.</span>
                </div>
            </li>
            <li>
                <div class="list">
                    <span>Введены неправильные параметры банковской карты.</span>
                </div>
            </li>
            <li>
                <div class="list">
                    <span>Ошибка связи.</span>
                </div>
            </li>
        </ol>
        <img src="/img/payment/stamp_error.png" alt="stamp" class="stamp-error" />
    </div>

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

    </script>

</div>
@endsection