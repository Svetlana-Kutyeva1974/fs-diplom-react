{{--Компонент Конфигурация мест зала клиента--}}

<div class="buying-scheme">
    <div class="buying-scheme__wrapper">
        @for ($i = 1; $i <= $hall['row']; $i++)
            <div class="buying-scheme__row">
                @foreach ($seats->where('rowNumber', $i) as $item)
                    @if(!$item['free'])
                        <button onclick = "cl(id)" id="{{$item['rowNumber']}},{{$item['colNumber']}}" type="button" class="buying-scheme__chair buying-scheme__chair_taken">
                            @else
                                @php
                                    $ij = $item['rowNumber'].",".$item['colNumber'];
                                @endphp
                                @switch(json_decode($hall['typeOfSeats'])->{$ij}) {{-- старый вариант @switch($item['type'])--}}
                                    @case('VIP')
                                        <button onclick = "cl(id)" id="{{$item['rowNumber']}},{{$item['colNumber']}}" type="button" class="buying-scheme__chair buying-scheme__chair_vip">
                                            @break
                                            @case('FAIL')
                                                <button id="{{$item['rowNumber']}},{{$item['colNumber']}}" type="button" class="buying-scheme__chair buying-scheme__chair_disabled">
                                                    @break
                                                    @default
                                                        <button onclick = "cl(id)" id="{{$item['rowNumber']}},{{$item['colNumber']}}" type="button" class="buying-scheme__chair buying-scheme__chair_standart">

                                @endswitch
                    @endif
                @endforeach
            </div>
        @endfor
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
<button class="acceptin-button" onclick="arr2(event)">Забронировать</button>

<script>
    function cl(id){
        console.log(id);
        if(!(document.getElementById(id).classList.contains('buying-scheme__chair_disabled') || document.getElementById(id).classList.contains('buying-scheme__chair_taken'))) {
            document.getElementById(id).classList.toggle('buying-scheme__chair_selected');
        }
    }

    function arr2(event){
        const selected = [];
        Array.of(document.querySelectorAll('button.buying-scheme__chair_selected')).forEach((element, index, array) => {
            //console.log('кнопка', index); //console.log('array', array);

            for(let i=0; i<element.length; i++) {
                selected.push(element[i].id);
            }
            //console.log('выбрано:', selected);
            const json=JSON.stringify(selected);//console.log('json  selectedddd', json);

            //let url = "{{route('client.ticket', ['hall'=> $hall, 'seance'=> $seance, 'film'=> $film, 'dateChosen'=> $dateChosen, 'seats'=> $seats->where('hall_id', $hall['id'])->where('seance_id', $seance['id']), 'selected' => 'json'])}}";

            // Надо перенаправить сначала на роут
            // сохранения новых характеристик выбранных мест и создания нового тикета:

            let url = "{{route('client.seat', ['hall'=> $hall, 'seance'=> $seance, 'film'=> $film, 'dateChosen'=> $dateChosen, 'seats'=> $seats->where('hall_id', $hall['id'])->where('seance_id', $seance['id']), 'selected' => 'json'])}}";

            //console.log('url   ',url);console.log('selected url  ', selected);

            url = url.replace('json', json);//console.log('replace url  ', url);
            url = url.replaceAll('&amp;', '&');//console.log('replace amp url  ', url);
            window.location.href = url;
        });
    }
</script>

