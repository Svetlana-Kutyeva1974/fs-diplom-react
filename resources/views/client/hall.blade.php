{{--}}<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ИдёмВКино</title>
    <!--<link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/styles.css">-->
    <link rel="stylesheet" href="{{ asset('css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
</head>

<body>
<header class="page-header">
    <h1 class="page-header__title">Идём<span>в</span>кино</h1>
</header>
--}}
{{--@extends('index')
@section('title', 'Новый заголовок страницы')
@section('content')--}}
@extends('layouts.header')
@section('content')
@php
    $selected = [];
@endphp
<main>
    <section class="buying">
        <div class="buying__info">
            <div class="buying__info-description">
                <h2 class="buying__info-title">{{$film['title']}}</h2>
                <p class="buying__info-start">Начало сеанса: {{substr($seance['startSeance'],-8,5)}}</p>
                <p class="buying__info-hall">{{$hall['nameHall']}}</p>
            </div>
            <div class="buying__info-hint">
                <p>Тапните дважды,<br>чтобы увеличить</p>
            </div>
        </div>

                <x-client.buttons :seats="$seats" :seance="$seance" :film="$film" :hall="$hall"  dateChosen="{{$dateChosen}}" :selected="$selected">
                </x-client.buttons>

        {{--<button class="acceptin-button" ><a href="{{route('ticket', ['hall'=> $hall, 'seance'=> $seance, 'film'=> $film, 'dateChosen'=> $dateChosen, 'seats'=> $seats->where('hall_id', $hall['id'])->where('seance_id', $seance['id']), 'selected' => [1,2]])}}">Забронировать</a></button>--}}
        {{--<button class="acceptin-button" onclick="location.href='{{route('ticket', ['hall'=> $hall, 'seance'=> $seance, 'film'=> $film, 'dateChosen'=> $dateChosen, 'seats'=> $seats->where('hall_id', $hall['id'])->where('seance_id', $seance['id']), 'selected' => [1,2]])}}'">Забронировать</button>--}}


        {{--<button class="acceptin-button" onclick="location.href='payment.html'" >Забронировать</button>--}}
    </section>
</main>
@endsection
    {{--}}
</body>

</html>--}}


