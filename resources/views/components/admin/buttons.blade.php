
{{--dd($hall->{'id'})--}}{{--dump($selected_hall)--}} {{--$seats->where('rowNumber', 1)--}}
{{--var_dump($hall)--}}
{{--var_dump($hall->{'row'})--}}
{{--var_dump($hall->{'id'})--}}
{{-- $hall->{'id'}-- }}
{{dd($selected_hall)}}
{{--Компонент Конфигурация мест зала администратора--}}
{{--var_dump(json_decode($hall->{'typeOfSeats'})->{"1,2"}) --}}
{{--<form action="{{route('admin.editHall', ['hall' => $hall])}}" method="POST" accept-charset="utf-8">
    @csrf--}}


<div class="conf-step__hall">
    <div class="conf-step__hall-wrapper">
        {{--var_dump(json_decode($hall->{'typeOfSeats'})->{"1,4"})--}}{{--dd($hall[typeOfSeats]->{"1,1"})--}}
        @for ($i = 1; $i <= $hall->{'row'}; $i++)
            <div class="conf-step__row">
                @for ($j = 1; $j <= $hall->{'col'}; $j++)
                    @switch(json_decode($hall->{'typeOfSeats'})->{"$i,$j"})
                        @case('VIP')
                            {{-- json_decode($hall->{'typeOfSeats'})->{"$i,$j"} --}}
                            @if ($disabled === true)
                                <button onclick = "select(id)" id="{{ "$i,$j"}} {{ json_decode($hall->{'typeOfSeats'})->{"$i,$j"} }}" type="button"   class="conf-step__chair conf-step__chair_vip" disabled>
                            @else
                            <button onclick = "select(id)" id="{{ "$i,$j"}} {{ json_decode($hall->{'typeOfSeats'})->{"$i,$j"} }}" type="button"   class="conf-step__chair conf-step__chair_vip" @if ($open === '1') disabled @endif>
                            @endif
                            @break
                                @case('FAIL')
                                    @if ($disabled === true)
                                        <button onclick = "select(id)" id="{{ "$i,$j"}} {{ json_decode($hall->{'typeOfSeats'})->{"$i,$j"} }}"  type="button"  class="conf-step__chair conf-step__chair_disabled" disabled>
                                     @else
                                    <button onclick = "select(id)" id="{{ "$i,$j"}} {{ json_decode($hall->{'typeOfSeats'})->{"$i,$j"} }}"  type="button"  class="conf-step__chair conf-step__chair_disabled" @if ($open === '1') disabled @endif>
                                     @endif
                                        @break
                                        @default
                                             @if ($disabled === true)
                                                <button onclick = "select(id)" id="{{  "$i,$j" }} {{ json_decode($hall->{'typeOfSeats'})->{"$i,$j"} }}" type="button"  class="conf-step__chair conf-step__chair_standart" disabled >
                                            @else
                                                 <button onclick = "select(id)" id="{{  "$i,$j" }} {{ json_decode($hall->{'typeOfSeats'})->{"$i,$j"} }}" type="button" class="conf-step__chair conf-step__chair_standart" @if ($open === '1') disabled @endif >
                                            @endif
                    @endswitch
                @endfor
            </div>
        @endfor

    </div>
</div>
{{--dd($selected_hall)--}}
<fieldset class="conf-step__buttons text-center">
<button onclick = " window.location.href='{{ route('admin.home', ['confstep'=> ['conf-step__header_closed',  'conf-step__header_opened', 'conf-step__header_closed', 'conf-step__header_closed', 'conf-step__header_closed'],'open'=> $open,'selected_hall' => $hall->{'id'}]) }}' " href="#" class="conf-step__button conf-step__button-regular" @if ($open === '1') disabled @endif>Отмена</button>
    <!--<button id="down" onclick = "cl2(id)" href="#" class="conf-step__button conf-step__button-regular" @if ($open === '1') disabled @endif>Отмена</button>-->
    <input id="{{ $hall->{'id'} }}" onclick="editSeats(id)" type="submit" value="Сохранить" class="conf-step__button conf-step__button-accent" @if ($open === '1') disabled @endif>
</fieldset>


