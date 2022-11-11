{{--}}<!DOCTYPE html>
<html lang="ru">
{{--json_decode($selected)[0]
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ИдёмВКино</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
</head>

<body>
<header class="page-header">
    <h1 class="page-header__title">Идём<span>в</span>кино</h1>
</header>
--}}
{{--$selected--}}
{{--json_decode($selected)[0]--}}
{{--json_decode($selected)[1]--}}
{{--count(json_decode($selected))--}}
{{--var_dump((array)json_decode($selected)[1])--}}
{{--var_dump(explode( ',', json_decode($selected)[1])--}}
{{--substr( ',', $selected)--}}

@extends('layouts.header')
@section('content')
<main>
    <section class="ticket">

        <header class="tichet__check">
            <h2 class="ticket__check-title">Электронный билет</h2>
        </header>

        <div class="ticket__info-wrapper">
            <p class="ticket__info">На фильм: <span class="ticket__details ticket__title">{{$film['title']}}</span></p>
            <p class="ticket__info">Места:
                @php
                   $string =' ';
                @endphp
                @foreach (json_decode($selected) as $item)
                    @php
                        //dump($hall['col']);
                        $int = (int)$hall['col'];
                        //dump($int);
                        $string .= "ряд ".explode(',',$item)[0]." место". (explode(',',$item)[1]+(explode(',',$item)[0]-1)*$int).",";

                    @endphp
                {{--var_dump(explode(',',$item))--}}
                {{--<span class="ticket__details ticket__chairs">{{json_decode($selected)[0][3]}}{{','}}{{json_decode($selected)[1][3]}}</span>--}}
                    {{--  <span class="ticket__details ticket__chairs">{{$item[3]+ ($item[1]-1)*12}}{{','}}</span>     12 заменить ;$hall['col']--}}
                <span class="ticket__details ticket__chairs"> {{'ряд:'}} {{explode(',',$item)[0]}} {{'место:'}} {{explode(',',$item)[1]+(explode(',',$item)[0]-1)*$hall['col']}} {{','}} </span>
                @endforeach
            </p>
            <p class="ticket__info">В зале: <span class="ticket__details ticket__hall">{{$hall['id']}}</span></p>
            <p class="ticket__info">Начало сеанса: <span class="ticket__details ticket__start">{{substr($seance['startSeance'], -8, 5)}}</span></p>

            {{--<img class="ticket__info-qr" src="i/qr-code.png">--}}
            @php
                //echo  __DIR__ . '\qr.png';
                echo '<img class="ticket__info-qr" src="i/qr.png">';
            @endphp

            <p class="ticket__hint">Покажите QR-код нашему контроллеру для подтверждения бронирования.</p>
            <p class="ticket__hint">Приятного просмотра!</p>
            <button class="acceptin-button" onclick="location.href='{{route('index')}}'">На главную</button>

        </div>
    </section>
</main>
@endsection
{{--}}
</body>
</html>--}}{{--}}include('../lib/full/qrlib.php');--}}
@php
//require_once __DIR__ . 'phpqrcode/qrlib.php';
require_once 'C:\0-Web-учеба\0-блок12-lavarel\fs-diplom-react\phpqrcode\qrlib.php';
//echo QRcode::png('https://snipp.ru/');
echo QRcode::png($string);
echo $string;
//QRcode::png('https://snipp.ru/', __DIR__ . '/qr.png', QR_ECLEVEL_H, 6);
QRcode::png('https://snipp.ru/', 'C:\0-Web-учеба\0-блок12-lavarel\fs-diplom-react\public\i\qr.png', 'H', 48, 2);
echo  __DIR__ . '/qr.png';

//$new_url = 'https://example.com/final.php';
//header('Location: '.$new_url);


@endphp

{{--$data = 'Example text';
echo '<img src="'.(new QRCode)->render($data).'" alt="QR Code" />';
--}}
