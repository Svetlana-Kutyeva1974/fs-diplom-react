{{-- Главная страница проекта--}}
@extends('layouts.header')
@section('content')
    {{--Вызов компонента Календарь--}}
    <x-client.calendar :seances="$seances" :halls="$halls" :films="$films" dateCurrent="{{$dateCurrent}}" dateChosen="{{$dateChosen}}"></x-client.calendar>
    @foreach ($films as $film)
        @if ($film)
            {{--Вызов компонента Карточка фильма--}}
            <x-client.card :seances="$seances" :film="$film" :halls="$halls" :seats="$seats" dateCurrent="{{$dateCurrent}}" dateChosen="{{$dateChosen}}">
            </x-client.card>
        @endif
    @endforeach
@endsection

