@extends('layouts.header')
@section('content')
    <x-client.calendar :seances="$seances" :halls="$halls" :films="$films" dateCurrent="{{$dateCurrent}}" dateChosen="{{$dateChosen}}"></x-client.calendar>
    @foreach ($films as $film)
        <x-client.card :seances="$seances" :film="$film" :halls="$halls" :seats="$seats" dateCurrent="{{$dateCurrent}}" dateChosen="{{$dateChosen}}">
        </x-client.card>
    @endforeach
@endsection

