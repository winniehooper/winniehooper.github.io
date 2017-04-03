<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no" />
    <title>@yield('title')</title>
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,300,500,700&subset=latin,cyrillic-ext,cyrillic,latin-ext">
    <link rel="stylesheet" type="text/css" media="all" href="/css/payment.css" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="/js/plugins/jquery.print.js"></script>
    <script type="text/javascript" src="/js/plugins/jquery.colorbox-min.js"></script>
</head>
<body>
<div id="container">
    @yield('content')
</div>

<div id="footer">
    <div class="footer-content">
        <img src="/img/payment/mastercard.png" alt="mastercard" />
        <img src="/img/payment/visa.png" alt="visa"/>
        <img src="/img/payment/lock.png" alt="lock" class="lock" />
    </div>
</div>
</body>
</html>
