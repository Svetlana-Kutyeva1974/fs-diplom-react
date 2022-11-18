{{-- Электронный билет--}}

{{--json_decode($selected)[0]--}}{{--count(json_decode($selected))--}}
{{--var_dump(explode( ',', json_decode($selected)[1])--}}{{--substr( ',', $selected)--}}

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
                   $string = 'зал: '.$hall['nameHall'].', фильм: '.$film['title'].', начало сеанса: '.substr($seance['startSeance'], -8, 5);
                @endphp
                @foreach (json_decode($selected) as $item)
                    @php
                        //Подготовка строки кодировки

                        $int = (int)$hall['col'];
                        $string .= ", ряд ".explode(',',$item)[0]." место". (explode(',',$item)[1]+(explode(',',$item)[0]-1)*$int);
                        //Формирование кода qr
                        //require_once 'C:\0-Web-учеба\0-блок12-lavarel\fs-diplom-react\phpqrcode\qrlib.php';
                        //echo base_path() . '\phpqrcode\qrlib.php';
                        require_once base_path() . '\phpqrcode\qrlib.php';
                        //QRcode::png($string, 'C:\0-Web-учеба\0-блок12-lavarel\fs-diplom-react\public\i\qr.png', 'H', 48, 2);
                        QRcode::png($string, base_path() . '\public\i\qr.png', 'H', 48, 2);
                    @endphp
                <span class="ticket__details ticket__chairs"> {{'ряд:'}} {{explode(',',$item)[0]}} {{'место:'}} {{explode(',',$item)[1]+(explode(',',$item)[0]-1)*$hall['col']}} {{','}} </span>
                @endforeach
            </p>
            <p class="ticket__info">В зале: <span class="ticket__details ticket__hall">{{$hall['id']}}</span></p>
            <p class="ticket__info">Начало сеанса: <span class="ticket__details ticket__start">{{substr($seance['startSeance'], -8, 5)}}</span></p>
            {{--<img class="ticket__info-qr" src="i/qr-code.png">--}}
            @php
                echo '<img class="ticket__info-qr" src="i/qr.png">';
            @endphp
            <p class="ticket__hint">Покажите QR-код нашему контроллеру для подтверждения бронирования.</p>
            <p class="ticket__hint">Приятного просмотра!</p>
            <button class="acceptin-button" onclick="location.href='{{route('index')}}'">На главную</button>
        </div>
    </section>
</main>
@endsection

@php
//require_once __DIR__ . 'phpqrcode/qrlib.php';//echo QRcode::png('https://snipp.ru/');//QRcode::png('https://snipp.ru/', __DIR__ . '/qr.png', QR_ECLEVEL_H, 6);
require_once 'C:\0-Web-учеба\0-блок12-lavarel\fs-diplom-react\phpqrcode\qrlib.php';
//echo QRcode::png($string);
echo "Закодированная строка: ".$string."\n";
//echo  PHP_EOL."путь: ".__DIR__ . '/qr.png';
//QRcode::png('https://snipp.ru/', 'C:\0-Web-учеба\0-блок12-lavarel\fs-diplom-react\public\i\qr.png', 'H', 48, 2);
QRcode::png($string, 'C:\0-Web-учеба\0-блок12-lavarel\fs-diplom-react\public\i\qr.png', 'H', 48, 2);
//$new_url = 'https://example.com/final.php';//header('Location: '.$new_url);
@endphp

{{--$data = 'Example text';
echo '<img src="'.(new QRCode)->render($data).'" alt="QR Code" />';
--}}
