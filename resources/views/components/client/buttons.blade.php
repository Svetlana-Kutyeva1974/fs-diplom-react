{{--$hall['row']--}}
{{--$seats->where('rowNumber', 1)--}}
<div class="buying-scheme">
    <div class="buying-scheme__wrapper">

        @for ($i = 1; $i <= $hall['row']; $i++)
            <div class="buying-scheme__row">
                @foreach ($seats->where('rowNumber', $i) as $item)
                    {{--'передали'--}}{{--$item--}}
                    {{--<span class="buying-scheme__chair buying-scheme__chair_standart"></span>--}}
                    @if(!$item['free'])
                        <button onclick = "cl(id)" id="$i+$item['col']" type="button" class="buying-scheme__chair buying-scheme__chair_taken">

                            @else
                                @switch($item['type'])
                                    @case('VIP')
                                        <button onclick = "cl(id)" id="[{{$item['rowNumber']}},{{$item['colNumber']}}]" type="button" class="buying-scheme__chair buying-scheme__chair_vip">
                                            @break
                                            @case('FAIL')
                                                <button type="button" class="buying-scheme__chair buying-scheme__chair_disabled">
                                                    @break
                                                    @default
                                                        {{--<button onclick = "cl(id)" id="[{{$item['rowNumber']}},{{$item['colNumber']}}]" type="button" class="buying-scheme__chair buying-scheme__chair_standart">--}}
                                                        <button onclick = "cl(id)" id="[{{$item['rowNumber']}},{{$item['colNumber']}}]" type="button" class="buying-scheme__chair buying-scheme__chair_standart">
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
{{--
<button class="acceptin-button" onclick="arr2(event)">Забронировать</button>

<form id="logout-form" action="{{ route('ticket',['hall'=> $hall, 'seance'=> $seance, 'film'=> $film, 'dateChosen'=> $dateChosen, 'seats'=> $seats->where('hall_id', $hall['id'])->where('seance_id', $seance['id']), 'selected' => 'json'])}}" method="ANY" class="d-none">
    @csrf
</form>
--}}
<script>
    function cl(id){
        console.log(id);
        if(!(document.getElementById(id).classList.contains('buying-scheme__chair_disabled') || document.getElementById(id).classList.contains('buying-scheme__chair_taken'))) {
            document.getElementById(id).classList.toggle('buying-scheme__chair_selected');

        }
        //document.getElementById('button').classList.toggle('buying-scheme__chair_selected')
        /*Array.of(document.querySelectorAll('button')).forEach((element, index, array) => {
            console.log(element[index], element[index].classList); // 100, 200, 300
            //element[index].classList.remove('buying-scheme__chair_standart');
            element[index].classList.toggle('buying-scheme__chair_selected');
            console.log(element[index], element[index].classList); // 100, 200, 300
            console.log(index); // 0, 1, 2
            console.log(array); // same myArray object 3 times

           //route('hall', ['hall' => $hall, 'seance'=> $item, 'film'=> $film, 'dateChosen'=> $dateChosen, 'seats'=> $seats->where('hall_id', $hall->id)->where('seance_id', $item->id)])

    });*/
    }

</script>

<script>
    //function arr2(event){
    function arr2(event){
        const selected = [];
        //document.getElementById('button').classList.toggle('buying-scheme__chair_selected')
        Array.of(document.querySelectorAll('button.buying-scheme__chair_selected')).forEach((element, index, array) => {
            //console.log(element[index], element[index].classList); // 100, 200, 300
            //element[index].classList.remove('buying-scheme__chair_standart');
            //selected.push([index, array]);
            //console.log(element[index], element[index].classList); // 100, 200, 300
            console.log('кнопка', index); // 0, 1, 2
            console.log('element', element[0].id, element[1].id, element.length ); // 0, 1, 2
            console.log('array', array); // same myArray object 3 times
            selected.push(element[0].id);
            selected.push(element[1].id);
            console.log('selectedddd', selected);
            const json=JSON.stringify(selected);

            console.log('json  selectedddd', json);
            let url = "{{route('ticket', ['hall'=> $hall, 'seance'=> $seance, 'film'=> $film, 'dateChosen'=> $dateChosen, 'seats'=> $seats->where('hall_id', $hall['id'])->where('seance_id', $seance['id']), 'selected' => 'json'])}}";
            let yurl= encodeURIComponent(url);
            console.log('encode  ', yurl);
            //let url = "{{route('ticket', ['hall'=> $hall, 'seance'=> $seance, 'film'=> $film, 'dateChosen'=> $dateChosen, 'seats'=> $seats->where('hall_id', $hall['id'])->where('seance_id', $seance['id']), ':selected'])}}";

            console.log('url   ',url);
            console.log('selected url  ', selected);
            url = url.replace('json', json);
            //url = url.replace(':selected', selected);
            console.log('replaceed url  ', url);
            //  event.preventDefault();
            //  document.getElementById('logout-form').submit('json');


            window.location.href= url;

            //console.log(url);?php echo $subscription_id ?> = data.subscriptionID;


        });

    }

</script>

