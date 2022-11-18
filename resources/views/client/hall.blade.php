{{--Клиентский редактор зала, выбор мест и бронирование--}}

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
            {{--Компонент конфигурация мест зала клиента--}}
            <x-client.buttons :seats="$seats" :seance="$seance" :film="$film" :hall="$hall"  dateChosen="{{$dateChosen}}" :selected="$selected">
            </x-client.buttons>
    </section>
</main>
@endsection


