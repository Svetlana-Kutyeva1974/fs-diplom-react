<!DOCTYPE html>
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
        <div class="buying-scheme">
            <div class="buying-scheme__wrapper">
                <x-client.buttons :seats="$seats" :seance="$seance" :film="$film" :hall="$hall"  dateChosen="{{$dateChosen}}">
                </x-client.buttons>
            </div>

            <div class="buying-scheme__legend">
                <div class="col">
                    <p class="buying-scheme__legend-price"><span class="buying-scheme__chair buying-scheme__chair_standart"></span> Свободно (<span class="buying-scheme__legend-value">{{$hall['countNormal']}}</span>руб)</p>
                    <p class="buying-scheme__legend-price"><span class="buying-scheme__chair buying-scheme__chair_vip"></span> Свободно VIP (<span class="buying-scheme__legend-value">{{$hall['countVip']}}</span>руб)</p>
                </div>
                <div class="col">
                    <p class="buying-scheme__legend-price"><span class="buying-scheme__chair buying-scheme__chair_taken"></span> Занято</p>
                    <p class="buying-scheme__legend-price"><span class="buying-scheme__chair buying-scheme__chair_selected"></span> Выбрано</p>
                </div>
            </div>
        </div>
        {{--<button class="acceptin-button" ><a href="{{route('ticket', ['hall'=> $hall, 'seance'=> $seance, 'film'=> $film, 'dateChosen'=> $dateChosen, 'seats'=> $seats->where('hall_id', $hall['id'])->where('seance_id', $seance['id']), 'selected' => [1,2]])}}">Забронировать</a></button>--}}
        <button class="acceptin-button" onclick="location.href='{{route('ticket', ['hall'=> $hall, 'seance'=> $seance, 'film'=> $film, 'dateChosen'=> $dateChosen, 'seats'=> $seats->where('hall_id', $hall['id'])->where('seance_id', $seance['id']), 'selected' => [1,2]])}}'">Забронировать</button>


        {{--<button class="acceptin-button" onclick="location.href='payment.html'" >Забронировать</button>--}}
    </section>
</main>

</body>
<script>
    function arr(){
        //console.log(id);

        //document.getElementById('button').classList.toggle('buying-scheme__chair_selected')
        Array.of(document.querySelectorAll('buying-scheme__chair_selected')).forEach((element, index, array) => {
            console.log(element[index], element[index].classList); // 100, 200, 300
            //element[index].classList.remove('buying-scheme__chair_standart');
            element[index].classList.toggle('buying-scheme__chair_selected');
            console.log(element[index], element[index].classList); // 100, 200, 300
            console.log(index); // 0, 1, 2
            console.log(array); // same myArray object 3 times

        });
    }

</script>
</html>


@php
    echo "<script>arr();</script>";
@endphp
