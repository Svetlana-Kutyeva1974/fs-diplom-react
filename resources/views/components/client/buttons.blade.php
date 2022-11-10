{{--$hall['row']--}}
{{--$seats->where('rowNumber', 1)--}}

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


<script>
    function cl(id){
        console.log(id);
        if(!(document.getElementById(id).classList.contains('buying-scheme__chair_disabled') || document.getElementById(id).classList.contains('buying-scheme__chair_taken'))) {
            document.getElementById(id).classList.toggle('buying-scheme__chair_selected');

            @php echo array_push($selected, "{{id}}"); @endphp;
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
         //const d = " @php array_push($selected, "{{id}}"); @endphp";
        //console.log(d);
    }

</script>

