<div id="seance{{$seance->id}}" class="popup">
    <div class="popup__container">
        <div class="popup__content">
            <div class="popup__header">
                <h2 class="popup__title">
                    Снятие с сеанса
                    <a class="popup__dismiss" href="#" onclick = " window.location.href='{{ route('admin.home', ['open'=> $open,'selected_hall' => $hall->{'id'}]) }}' "><img src="i/close.png" alt="Закрыть"></a>
                </h2>

            </div>
            <div class="popup__wrapper">
                <form action="{{ route('admin.destroySeance', ['id' => $seance->id]) }}" method="post" accept-charset="utf-8">
                    <p class="conf-step__paragraph">Вы действительно хотите снять с сеанса фильм <span>{{$film->id}}</span>?</p>
                    <!-- В span будет подставляться название фильма -->
                    <div class="conf-step__buttons text-center">
                        <input id="{{$seance->id}}" type="submit" value="Удалить" class="conf-step__button conf-step__button-accent">
                        <button id="{{$seance->id}}" class="conf-step__button conf-step__button-regular" onclick = " window.location.href='{{ route('admin.home', ['open'=> $open,'selected_hall' => $hall->{'id'}]) }}' " href="#">Отменить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
