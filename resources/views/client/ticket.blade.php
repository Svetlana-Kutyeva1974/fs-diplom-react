{{-- Электронный билет--}}

{{--json_decode($selected)[0]--}}{{--count(json_decode($selected))--}}{{--var_dump(explode( ',', json_decode($selected)[1])--}}{{--substr( ',', $selected)--}}

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
                @foreach (json_decode($selected) as $item)
                    @php
                        //Формирование qr-coda
                        require_once base_path() . '\phpqrcode\qrlib.php';
                        QRcode::png($qrCod, base_path() . '\public\i\qr.png', 'H', 48, 2);
                    @endphp
                <span class="ticket__details ticket__chairs"> {{'ряд:'}} {{explode(',',$item)[0]}} {{'место:'}} {{explode(',',$item)[1]+(explode(',',$item)[0]-1)*$hall['col']}} {{','}} </span>
                @endforeach
            </p>
            <p class="ticket__info">В зале: <span class="ticket__details ticket__hall">{{$hall['id']}}</span></p>
            <p class="ticket__info">Начало сеанса: <span class="ticket__details ticket__start">{{substr($seance['startSeance'], -8, 5)}}</span></p>
            <p class="ticket__info">Стоимость билета: <span class="ticket__details ticket__hall">{{$count}}{{' руб.'}}</span></p>
            @php
                echo '<img class="ticket__info-qr" src="i/qr.png" alt="$qrCod">';
            @endphp
            <p class="ticket__hint">Покажите QR-код нашему контроллеру для подтверждения бронирования.</p>
            <p class="ticket__hint">Приятного просмотра!</p>
            <button class="acceptin-button" onclick="location.href='{{route('index')}}'">На главную</button>
        </div>
    </section>
</main>
@endsection

