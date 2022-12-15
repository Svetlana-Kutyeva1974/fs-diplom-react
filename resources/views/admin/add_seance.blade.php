<div id="popup{{$film->id}}" class="popup">
  <div class="popup__container">
    <div class="popup__content">
      <div class="popup__header">
        <h2 class="popup__title">
Добавление сеанса
<a class="popup__dismiss" href="#"><img src="i/close.png" alt="Закрыть"></a>
        </h2>

      </div>
      <div class="popup__wrapper">
          <form action="{{ route('admin.createSeance', ['film_id' => $film->id, 'hall_id'=> $hall->id ?? '1', 'startSeance'=> $startSeance ?? Carbon\Carbon::now()]) }}" method="post" accept-charset="utf-8">

          {{--}}<form action="#" method="post" accept-charset="utf-8">--}}
              @csrf
              @method('POST')
          <label class="conf-step__label conf-step__label-fullsize" for="hall">
Название зала
<select class="conf-step__input" name="hall" required>
                @php
                    $i=1;
                @endphp
              @foreach ($halls as $hall)
                  {{var_dump($i)}} {{var_dump($hall)}}
                  @if($i===1)

                    <option value="{{$i}}" selected>{{$hall->nameHall}}</option>
                  @else
                    <option value="{{$i}}">{{$hall->nameHall}}</option>
                    @php
                        $i++;
                    @endphp
                 @endif
              @endforeach
            </select>
          </label>
          <label class="conf-step__label conf-step__label-fullsize" for="name">
Время начала
<input class="conf-step__input" type="time" value="00:00" name="start_time" required>
          </label>

          <label class="conf-step__label conf-step__label-fullsize" for="name">
Название зала
<input class="conf-step__input" type="text" placeholder="Например, &laquo;Зал 1&raquo;" name="name" required>
          </label>

          <div class="conf-step__buttons text-center">
            <input  type="submit" value="Добавить" class="conf-step__button conf-step__button-accent"  @if ($open === '1') disabled @endif >
            <button  id="{{$film->id}}" class="conf-step__button conf-step__button-regular" onclick ="event.preventDefault();popupToggle(id)"  @if ($open === '1') disabled @endif >Отменить</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
