{{--$hall['row']--}}{{--$seats->where('rowNumber', 1)--}}
<div class="conf-step__hall">
    <div class="conf-step__hall-wrapper">
        {{--print_r($hall--)}}
        {{--var_dump($hall)--}}
        {{--var_dump($hall->{'open'})--}}
        {{--var_dump(json_decode($hall->{'typeOfSeats'})->{"1,4"})--}}
        {{--dd($hall[typeOfSeats]->{"1,1"})--}}

@for ($i = 1; $i <= $hall->{'row'}; $i++)
    <div class="conf-step__row">
        @for ($j = 1; $j <= $hall->{'col'}; $j++)
            @switch(json_decode($hall->{'typeOfSeats'})->{"$i,$j"})
                @case('VIP')
                    {{--id="{{ json_decode($hall->{'typeOfSeats'})->{"$i,$j"} }}" --}}
                    <button onclick = "cheme(id)" id="{{ "$i,$j" }}" type="button" class="conf-step__chair conf-step__chair_vip">
                        @break
                        @case('FAIL')
                            <button onclick = "cheme(id)" id="{{ "$i,$j" }}" type="button" class="conf-step__chair conf-step__chair_disabled">
                                @break
                                @default
                                    <button onclick = "cheme(id)" id="{{ "$i,$j" }}" type="button" class="conf-step__chair conf-step__chair_standart">

            @endswitch
        @endfor
        {{--}}@endforeach--}}
    </div>


@endfor
</div>
</div>

<fieldset class="conf-step__buttons text-center">
<button class="conf-step__button conf-step__button-regular">Отмена</button>
<input type="submit" value="Сохранить" class="conf-step__button conf-step__button-accent">
</fieldset>


