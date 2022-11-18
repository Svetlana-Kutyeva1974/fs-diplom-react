{{--Админский редактор зала--}}

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
            {{--Компонент конфигурация мест зала для администратора--}}
            <x-client.buttons :seats="$seats" :seance="$seance" :film="$film" :hall="$hall"  dateChosen="{{$dateChosen}}" :selected="$selected">
            </x-client.buttons>
        {{--<button class="acceptin-button" ><a href="{{route('ticket', ['hall'=> $hall, 'seance'=> $seance, 'film'=> $film, 'dateChosen'=> $dateChosen, 'seats'=> $seats->where('hall_id', $hall['id'])->where('seance_id', $seance['id']), 'selected' => [1,2]])}}">Забронировать</a></button>--}}
        {{--<button class="acceptin-button" onclick="location.href='{{route('ticket', ['hall'=> $hall, 'seance'=> $seance, 'film'=> $film, 'dateChosen'=> $dateChosen, 'seats'=> $seats->where('hall_id', $hall['id'])->where('seance_id', $seance['id']), 'selected' => [1,2]])}}'">Забронировать</button>--}}
        {{--<button class="acceptin-button" onclick="location.href='payment.html'" >Забронировать</button>--}}
    </section>
</main>
@endsection



