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
{{$selected}}
{{json_decode($selected)[0]}}
{{json_decode($selected)[1]}}
{{count(json_decode($selected))}}
{{--var_dump((array)json_decode($selected)[1])--}}
{{var_dump( explode( ',', json_decode($selected)[1]))}} {{var_dump( explode( ',', json_decode($selected)[0]))}}
@extends('layouts.header')
@section('content')
<main>
    <section class="ticket">

        <header class="tichet__check">
            <h2 class="ticket__check-title">Электронный билет</h2>
        </header>

        <div class="ticket__info-wrapper">
            <p class="ticket__info">На фильм: <span class="ticket__details ticket__title">{{$film['title']}}</span></p>
            <br class="ticket__info">Места:
                @foreach (json_decode($selected) as $item)

                {{--<span class="ticket__details ticket__chairs">{{json_decode($selected)[0][3]}}{{','}}{{json_decode($selected)[1][3]}}</span>--}}
                    <span class="ticket__details ticket__chairs">{{$item[3]+ ($item[1]-1)*12}}{{','}}</span>

                @endforeach
            </p>
            <p class="ticket__info">В зале: <span class="ticket__details ticket__hall">{{$hall['id']}}</span></p>
            <p class="ticket__info">Начало сеанса: <span class="ticket__details ticket__start">{{substr($seance['startSeance'], -8, 5)}}</span></p>

            <img class="ticket__info-qr" src="i/qr-code.png">

            <p class="ticket__hint">Покажите QR-код нашему контроллеру для подтверждения бронирования.</p>
            <p class="ticket__hint">Приятного просмотра!</p>
            <button class="acceptin-button" onclick="location.href='{{route('index')}}'">На главную</button>

        </div>
    </section>
</main>
@endsection
{{--}}
</body>
</html>--}}
