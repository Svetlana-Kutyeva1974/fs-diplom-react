<!--Календарь -->
@php
    //echo 'календарь';
    $daysList = ["Вс","Пн","Вт","Ср","Чт","Пт","Сб"];
    @endphp

{{-- {{'из даты:'}} {{Carbon\Carbon::createFromDate($dateCurrent)}} {{Carbon\Carbon::createFromDate($dateCurrent)->dayOfWeek}} --}}
{{-- если от текущей даты : Carbon\Carbon::now()->addDays($i)->dayOfWeek--}}
{{'разница'}} {{Carbon\Carbon::createFromDate($dateChosen)->dayOfWeek}}
{{Carbon\Carbon::createFromDate($dateCurrent)->dayOfWeek}}
<div>{{'current calend'}}{{$dateCurrent}}{{$daysList[0]}}</div>
<div>{{'chos culend'}} {{$dateChosen}}{{$daysList[0]}}</div>
{{'эсегодня у нас'}} {{Carbon\Carbon::now()}} {{Carbon\Carbon::now()->dayOfWeek}}
<div>{{(Carbon\Carbon::createFromDate($dateCurrent)->day - Carbon\Carbon::now()->day)}}</div>
{{--{{ date('d.m.Y') }}--}}
<nav class="page-nav">
@for ($i = 0; $i < 6; $i++)
    {{--$dayChosen = '31' --}}
       {{-- dump(Carbon\Carbon::create($dateChosen)) Carbon\Carbon::createFromFormat('Y-m-d H:i:s', '2022-12-05 22:00:22') Carbon\Carbon::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'))  --}}
    @switch($i)
        @case(0)
                @if(Carbon\Carbon::createFromDate($dateChosen)->dayOfWeek - Carbon\Carbon::createFromDate($dateCurrent)->dayOfWeek === 0)
            <a class="page-nav__day page-nav__day_today page-nav__day page-nav__day_chosen" href="{{ route('index', ['films' => $films, 'halls' => $halls, 'seances'=> $seances, 'dateCurrent' => substr(Carbon\Carbon::createFromDate($dateCurrent), 0, 10), 'dateChosen'=> substr(Carbon\Carbon::createFromDate($dateCurrent), 0, 10)])}}">
                <span class="page-nav__day-week">{{$daysList[Carbon\Carbon::createFromDate($dateCurrent)->dayOfWeek]}}</span><span class="page-nav__day-number">{{Carbon\Carbon::createFromDate($dateCurrent)->day}}</span>
            </a>
            </br>
            @break
                @else
                    <a class="page-nav__day page-nav__day_today page-nav__day" href="{{ route('index', ['films' => $films, 'halls' => $halls, 'seances'=> $seances, 'dateCurrent' => substr(Carbon\Carbon::createFromDate($dateCurrent), 0, 10), 'dateChosen'=> substr(Carbon\Carbon::createFromDate($dateCurrent), 0, 10)])}}">
                        <span class="page-nav__day-week">{{$daysList[Carbon\Carbon::createFromDate($dateCurrent)->dayOfWeek]}}</span><span class="page-nav__day-number">{{Carbon\Carbon::createFromDate($dateCurrent)->day}}</span>
                    </a>
                    </br>
                    @break
        @endif
            {{-- если назад нужно
            @if(Carbon\Carbon::createFromDate($dateCurrent)->day - Carbon\Carbon::now()->day >=6 && Carbon\Carbon::createFromDate($dateCurrent)->dayOfWeek - Carbon\Carbon::now()->dayOfWeek === 0)
                        <a class="page-nav__day page-nav__day_prev" href="{{ route('index', ['films' => $films, 'halls' => $halls, 'seances'=> $seances, 'dateCurrent' => substr(Carbon\Carbon::createFromDate($dateCurrent)->addDays(-6), 0, 10), 'dateChosen'=> substr(Carbon\Carbon::createFromDate($dateCurrent)->addDays(-6), 0, 10)])}}">
                        </a>
               @endif--}}
        @case(5)
            @if((Carbon\Carbon::createFromDate($dateChosen)->dayOfWeek - Carbon\Carbon::createFromDate($dateCurrent)->dayOfWeek) !== 5 )
            <a class="page-nav__day page-nav__day_weekend" href="{{ route('index', ['films' => $films, 'halls' => $halls, 'seances'=> $seances, 'dateCurrent' => substr(Carbon\Carbon::createFromDate($dateCurrent), 0, 10), 'dateChosen'=> substr(Carbon\Carbon::createFromDate($dateCurrent)->addDays(5), 0, 10)])}}">
                <span class="page-nav__day-week">{{$daysList[Carbon\Carbon::createFromDate($dateCurrent)->addDays($i)->dayOfWeek]}}</span><span class="page-nav__day-number">{{Carbon\Carbon::createFromDate($dateCurrent)->addDays($i)->day}}</span>
            </a>
            </br>
            @break
                @else
                    <a class="page-nav__day page-nav__day page-nav__day_chosen page-nav__day_weekend" href="{{ route('index', ['films' => $films, 'halls' => $halls, 'seances'=> $seances, 'dateCurrent' => substr(Carbon\Carbon::createFromDate($dateCurrent), 0, 10), 'dateChosen'=> substr(Carbon\Carbon::createFromDate($dateCurrent)->addDays(5), 0, 10)])}}">
                        <span class="page-nav__day-week">{{$daysList[Carbon\Carbon::createFromDate($dateCurrent)->addDays($i)->dayOfWeek]}}</span><span class="page-nav__day-number">{{Carbon\Carbon::createFromDate($dateCurrent)->addDays($i)->day}}</span>
                    </a>
                @break
            @endif


        @default
            {{--                 @if(Carbon\Carbon::createFromDate($dateChosen)->dayOfWeek-1 === $i && (Carbon\Carbon::createFromDate($dateChosen)->dayOfWeek - Carbon\Carbon::createFromDate($dateCurrent)->dayOfWeek) > 0 &&  (Carbon\Carbon::createFromDate($dateChosen)->dayOfWeek - Carbon\Carbon::createFromDate($dateCurrent)->dayOfWeek)<5 )
--}}
                @if(abs(Carbon\Carbon::createFromDate($dateChosen)->dayOfWeek-Carbon\Carbon::createFromDate($dateCurrent)->dayOfWeek) === $i && (Carbon\Carbon::createFromDate($dateChosen)->dayOfWeek - Carbon\Carbon::createFromDate($dateCurrent)->dayOfWeek) > 0 &&  (Carbon\Carbon::createFromDate($dateChosen)->dayOfWeek - Carbon\Carbon::createFromDate($dateCurrent)->dayOfWeek)<5 )
            <a class="page-nav__day page-nav__day_chosen" href="{{ route('index', ['films' => $films, 'halls' => $halls, 'seances'=> $seances, 'dateCurrent' => substr(Carbon\Carbon::createFromDate($dateCurrent), 0, 10), 'dateChosen'=> substr(Carbon\Carbon::createFromDate($dateCurrent)->addDays($i), 0, 10)])}}">
                <span class="page-nav__day-week">{{$daysList[Carbon\Carbon::createFromDate($dateCurrent)->addDays($i)->dayOfWeek]}}</span><span class="page-nav__day-number">{{Carbon\Carbon::createFromDate($dateCurrent)->addDays($i)->day}}</span>
            </a>
            </br>
                @else
                    <a class="page-nav__day" href="{{ route('index', ['films' => $films, 'halls' => $halls, 'seances'=> $seances, 'dateCurrent' => substr(Carbon\Carbon::createFromDate($dateCurrent), 0, 10), 'dateChosen'=> substr(Carbon\Carbon::createFromDate($dateCurrent)->addDays($i), 0, 10)])}}">
                        <span class="page-nav__day-week">{{$daysList[Carbon\Carbon::createFromDate($dateCurrent)->addDays($i)->dayOfWeek]}}</span><span class="page-nav__day-number">{{Carbon\Carbon::createFromDate($dateCurrent)->addDays($i)->day}}</span>
                    </a>
                    </br>
                @endif
    @endswitch
@endfor
    @if(abs(Carbon\Carbon::createFromDate($dateCurrent)->day - Carbon\Carbon::now()->day) > 6 && abs(Carbon\Carbon::createFromDate($dateCurrent)->dayOfWeek - Carbon\Carbon::now()->dayOfWeek) === 1)
        <a class="page-nav__day page-nav__day_prev" href="{{ route('index', ['films' => $films, 'halls' => $halls, 'seances'=> $seances, 'dateCurrent' => substr(Carbon\Carbon::createFromDate($dateCurrent)->addDays(-6), 0, 10), 'dateChosen'=> substr(Carbon\Carbon::createFromDate($dateCurrent)->addDays(-6), 0, 10)])}}">
        </a>
        @else
    <a class="page-nav__day page-nav__day_next" href="{{ route('index', ['films' => $films, 'halls' => $halls, 'seances'=> $seances, 'dateCurrent' => substr(Carbon\Carbon::createFromDate($dateCurrent)->addDays(6), 0, 10), 'dateChosen'=> substr(Carbon\Carbon::createFromDate($dateCurrent)->addDays(6), 0, 10)])}}">
    </a>
    @endif
</nav>

{{substr(Carbon\Carbon::createFromDate($dateCurrent)->addDays(6), 0, 10)}}
{{--
$dateCurrent = Carbon\Carbon::createFromDate($dateCurrent)->addDays(1)
{{ route('index', ['films' => $films, 'halls' => $halls, 'seances'=> $seances, 'dateCurrent' => Carbon\Carbon::createFromDate($dateCurrent)->addDays(1), 'dateChosen'=> $dateChosen]) }}
    {{ Carbon\Carbon::createFromTimestamp($upcomingInvoice->date)->format('d-m-Y') }}
--}}
