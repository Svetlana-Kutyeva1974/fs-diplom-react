<div id="popup{{$film->id}}" class="popup">
  <div class="popup__container">
    <div class="popup__content">
      <div class="popup__header">
        <h2 class="popup__title">
Добавление сеанса
<a id="dismiss3" class="popup__dismiss" href="#" onclick = " window.location.href='{{ route('admin.home', ['open'=> $open,'selected_hall' => $hall->{'id'}]) }}' " ><img src="i/close.png" alt="Закрыть"></a>
            {{--<a id="dismiss3" class="popup__dismiss" href="#" onclick = "cl3(id)"><img src="i/close.png" alt="Закрыть"></a>--}}
        </h2>

      </div>
      <div class="popup__wrapper">
          <form name="seance{{$film->id}}" >
              {{--<form action="{{ route('admin.createSeance', ['film_id' => $film->id, 'hall_id'=> $hall->id ?? '1', 'startSeance'=> $startSeance ?? Carbon\Carbon::now()]) }}" method="POST" accept-charset="utf-8">--}}

              {{--}}<form action="#" method="post" accept-charset="utf-8">--}}
              @csrf
              {{--}}@method('POST')--}}
          <label class="conf-step__label conf-step__label-fullsize" for="hall">
Название зала
<select id="select_hall" class="conf-step__input" name="hall" required>
                @php
                    $i=1;
                @endphp
              @foreach ($halls as $hall)
                  @if($i==1)
                    <option value="{{$hall->id}}" selected>{{$hall->nameHall}}</option>
                  @else
                    <option value="{{$hall->id}}">{{$hall->nameHall}}</option>
                    @php
                        $i++;
                    @endphp
                 @endif
              @endforeach
            </select>
          </label>
          <label class="conf-step__label conf-step__label-fullsize" for="name">
Время начала
<input id="time" class="conf-step__input" type="time" value="00:00:00" name="start_time"
       step="10" required>
          </label>

          <div class="conf-step__buttons text-center">
            <input  id="{{ $film->id }}" onclick="clickCreateSeance(id)" type="submit" value="Добавить" class="conf-step__button conf-step__button-accent"  @if ($open === '1') disabled @endif >
            {{--<button  id="{{$film->id}}" class="conf-step__button conf-step__button-regular" onclick ="event.preventDefault(); popupToggle(id)"  @if ($open === '1') disabled @endif >Отменить</button>--}}
              <button  id="{{$film->id}}" class="conf-step__button conf-step__button-regular" onclick = " window.location.href='{{ route('admin.home', ['open'=> $open,'selected_hall' => $hall->{'id'}]) }}' " href="#" @if ($open === '1') disabled @endif >Отменить</button>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>
{{--
const dateControl = document.querySelector('input[type="datetime-local"]');
dateControl.value = '2017-06-01T08:30';
--}}
