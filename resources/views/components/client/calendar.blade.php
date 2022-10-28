<!--Календарь -->
@php
    //echo 'календарь';
    $daysList = ["Пн","Вт","Ср","Чт","Пт","Сб","Вс"];
$date  =  getdate();
//var_dump($date['wday']);
echo $date['wday'];



    @endphp

{{'из даты:'}} {{Carbon\Carbon::createFromDate($dateCurrent)}} {{Carbon\Carbon::createFromDate($dateCurrent)->dayOfWeek}}
{{-- если от текущей даты : Carbon\Carbon::now()->addDays($i)->dayOfWeek--}}
<div>{{$dateCurrent}}{{$daysList[0]}}</div>
{{ date('d.m.Y') }}
<nav class="page-nav">
@for ($i = 0; $i < 6; $i++)
    {{--$dayChosen = '31' --}}
       {{-- dump(Carbon\Carbon::create($dateChosen)) Carbon\Carbon::createFromFormat('Y-m-d H:i:s', '2022-12-05 22:00:22') Carbon\Carbon::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'))  --}}
    @switch($i)
        @case(0)
            <a class="page-nav__day page-nav__day_today page-nav__day page-nav__day_chosen" href="#">
                <span class="page-nav__day-week">{{$daysList[Carbon\Carbon::createFromDate($dateCurrent)->dayOfWeek-1]}}</span><span class="page-nav__day-number">{{Carbon\Carbon::createFromDate($dateCurrent)->day}}</span>
            </a>
            </br>
            @break
        @case(5)
            <a class="page-nav__day page-nav__day_weekend" href="#">
                <span class="page-nav__day-week">{{$daysList[Carbon\Carbon::createFromDate($dateCurrent)->addDays($i)->dayOfWeek-1]}}</span><span class="page-nav__day-number">{{Carbon\Carbon::createFromDate($dateCurrent)->addDays($i)->day}}</span>
            </a>
            </br>
            @break

        @default
            <a class="page-nav__day" href="#">
                <span class="page-nav__day-week">{{$daysList[Carbon\Carbon::createFromDate($dateCurrent)->addDays($i)->dayOfWeek-1]}}</span><span class="page-nav__day-number">{{Carbon\Carbon::createFromDate($dateCurrent)->addDays($i)->day}}</span>
            </a>
            </br>
    @endswitch
@endfor
    <a class="page-nav__day page-nav__day_next" href="{{ route('index', ['films' => $films, 'halls' => $halls, 'seances'=> $seances, 'dateCurrent' => substr(Carbon\Carbon::createFromDate($dateCurrent)->addDays(6), 0, 10), 'dateChosen'=> $dateChosen]) }}">
    </a>
</nav>

{{substr(Carbon\Carbon::createFromDate($dateCurrent)->addDays(6), 0, 10)}}
{{--
$dateCurrent = Carbon\Carbon::createFromDate($dateCurrent)->addDays(1)
{{ route('index', ['films' => $films, 'halls' => $halls, 'seances'=> $seances, 'dateCurrent' => Carbon\Carbon::createFromDate($dateCurrent)->addDays(1), 'dateChosen'=> $dateChosen]) }}
    {{ Carbon\Carbon::createFromTimestamp($upcomingInvoice->date)->format('d-m-Y') }}
--}}
