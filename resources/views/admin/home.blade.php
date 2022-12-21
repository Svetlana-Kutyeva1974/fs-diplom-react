{{-- Административная панель. Главная страница--}}

<!DOCTYPE html>
<html lang="en">
<!--
<div style="width: 1000px; margin: 10px auto 0; border: 2px solid;">
    <div>Привет, {{$user->name}}</div><br>
    <div> Ваш ID : {{$user->id}}</div><br>
    <div>Email: {{$user->email}}</div><br>
    {{--<hr style="color: #333; border: 1px solid;width: 50%;"><br>--}}
</div>
-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ИдёмВКино</title>
    <!--<link rel="stylesheet" href="CSS/normalize.css">
    <link rel="stylesheet" href="CSS/styles.css">-->

    <link rel="stylesheet" href="{{ asset('css/normalizeAdmin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylesAdmin.css') }}">

    <!-- <link rel="stylesheet" href="{{ asset('css/all.css') }}">-->

    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
</head>

<body>
<header class="page-header">
    <h1 class="page-header__title">Идём<span>в</span>кино</h1>
    <span class="page-header__subtitle">Администраторррская</span>

    <div class="my">Администратор: {{$user->name}}, Email:
        <span class="my__lower">{{$user->email}}</span>
        <span>
            <a class="my" href="{{ '/' }}">
                Выход
            </a>
    </span>
    </div>
    <!--<div> Ваш ID : {{$user->id}}</div><br>
    <div>Email: {{$user->email}}</div><br>-->

</header>
@php
    $confstep1= 'conf-step__header_closed';
    $confstep2= 'conf-step__header_closed';
    $confstep3= 'conf-step__header_closed';
    $confstep4= 'conf-step__header_opened';
    $confstep5= 'conf-step__header_opened';
@endphp

<main class="conf-steps">
    {{-- Создание зала +++++++++++++++++++++++++++++--}}
    <section id="1" class="conf-step">
        <header class="conf-step__header {{$confstep1}}">
            <h2 class="conf-step__title">Управление залами</h2>
        </header>
        <div class="conf-step__wrapper">
            <p class="conf-step__paragraph">Доступные залы:</p>
            <ul class="conf-step__list">

                @foreach ($halls as $hall)
                    {{-- Форма создания зала// когда было с confirm--}}
                    {{--<form action="{{ route('admin.destroyHall', ['id' => $hall->id]) }}" method="post" onsubmit="return confirm('Удалить этот зал?')">
                        @csrf
                        @method('DELETE')--}}

                        <li>{{$hall->nameHall}}
                             {{-- Форма создания зала popup--}}
                             @include('admin.delete', ['hall'=> $hall])
                            <button id="{{$hall->id}}" onclick = "popupToggle(id)"  class="conf-step__button conf-step__button-trash" @if ($open === '1') disabled @endif >
                            </button>
                        </li>
                    {{--</form>--}}

                @endforeach
            </ul>
            <button id= "create" onclick = "clickAddHall(id)"  class="conf-step__button conf-step__button-accent" @if ($open=== '1') disabled @endif>Создать зал</button>

        </div>

        {{-- Popup Меню создания зала--}}
        <div class="popup">
            <div class="popup__container">
                <div class="popup__content">
                    <div class="popup__header">
                        <h2 class="popup__title">
                            Добавление зала
                            <a id="dismiss1" class="popup__dismiss" href="#" onclick = "cl3(id)"><img src="i/close.png" alt="Закрыть"></a>
                        </h2>

                    </div>
                    <div class="popup__wrapper">
                        <form action="{{route('admin.createHall')}}" method="POST" accept-charset="utf-8">
                            @csrf
                            {{--@method('PUT')--}}
                            <label class="conf-step__label conf-step__label-fullsize" for="name">
                                Название зала
                                <input class="conf-step__input" type="text" placeholder="Например, «Зал 1»" name="name" required="" @if ($open === '1') disabled @endif >
                            </label>
                            <div class="conf-step__buttons text-center">
                                <input type="submit" value="Добавить зал" class="conf-step__button conf-step__button-accent" @if ($open === '1') disabled @endif >
                                <button id="create_down" onclick = "cl2(id)" class="conf-step__button conf-step__button-regular" href="#" @if ($open ==='1') disabled @endif >Отменить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
    {{-- Конец секции создания зала+++++++++++++++++--}}

    {{-- Конфигурация зала!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!--}}
    <section id="2" class="conf-step">
        <header class="conf-step__header {{$confstep2}}">
            <h2 class="conf-step__title">Конфигурация залов</h2>
        </header>
        <div class="conf-step__wrapper">
            <p class="conf-step__paragraph">Выберите зал для конфигурации:</p>
            <ul class="conf-step__selectors-box">
                @foreach ($halls as $hall)
                    <li>{{--$selected_hall--}}{{--dd(count($halls))--}}
                        @php
                            //$edit_hall = '1';
                            $hall_seances= $seances->where('hall_id', $hall->id);
                            if(count($hall_seances)>0) {
                             $edit_hall = '0';
                            } else {
                             $edit_hall = '1';
                            }
                            //dump($hall_seances);
                            //dump($edit_hall);

                        @endphp
                        {{--можно поставить проверку если  $edit_hall = '1', то рисовать залы if кода ниже
                        (при этом убрать  в input  условие с $edit_hall)--}}
                        @if($hall->{'id'} == $selected_hall) {{-- @if($i === $selected_hall ))   id="{{$hall->id}}"--}}
                           {{--var_dump($hall->id)--}}

                            <input id="{{$hall->{'id'} }}" onclick = "clickRadio(id)" type="radio" class="conf-step__radio" name="chairs-hall" value="{{$hall->nameHall}}" checked @if ($open === '1') disabled @endif @if ($edit_hall === '0') disabled @endif ><span class="conf-step__selector">{{$hall->nameHall}}</span></li>
                    @else
                        <input id="{{$hall->{'id'} }}" onclick = "clickRadio(id)" type="radio" class="conf-step__radio" name="chairs-hall" value="{{$hall->nameHall}}" @if ($open === '1') disabled @endif @if ($edit_hall === '0') disabled @endif ><span class="conf-step__selector">{{$hall->nameHall}}</span></li>
                        @endif
                        </li>
                        @endforeach
            </ul>
            {{--var_dump($hall_sel)--}}

            {{--var_dump($halls->where('id',$selected_hall)->first())--}}
            <p class="conf-step__paragraph">Укажите количество рядов и максимальное количество кресел в ряду:</p>
            <div class="conf-step__legend">
                <label class="conf-step__label">Рядов, шт<input id="countRow" type="text" class="conf-step__input seats" placeholder="{{$halls->where('id',$selected_hall)->first()->row}}" value="{{$halls->where('id',$selected_hall)->first()->row}}" @if ($open === '1') disabled @endif></label>
                <span class="multiplier">x</span>
                <label class="conf-step__label">Мест, шт<input id="countCol" type="text" class="conf-step__input seats" placeholder="{{$halls->where('id',$selected_hall)->first()->col}}" value="{{$halls->where('id',$selected_hall)->first()->col}}" @if ($open === '1') disabled @endif ></label>
            </div>
            <p class="conf-step__paragraph">Теперь вы можете указать типы кресел на схеме зала:</p>
            <div class="conf-step__legend">
                <span class="conf-step__chair conf-step__chair_standart"></span> — обычные кресла
                <span class="conf-step__chair conf-step__chair_vip"></span> — VIP кресла
                <span class="conf-step__chair conf-step__chair_disabled"></span> — заблокированные (нет кресла)
                <p class="conf-step__hint">Чтобы изменить вид кресла, нажмите по нему левой кнопкой мыши</p>
            </div>
            {{-- Схема зала--}}
            {{--@php
                $selected = [];
            @endphp--}}
                @php
                $isTrue = false;
            @endphp
            {{--dd($halls->where('id', $selected_hall))--}}
            {{--var_dump($halls->where('id',$selected_hall)->first())--}}

            {{--var_dump($halls->where('id',$selected_hall)->first()->id)--}}
            <x-admin.buttons :open="$open" :disabled="$isTrue" :seats="$seats" :seance="$seances" :film="$films" :hall="$halls->where('id',$selected_hall)->first()" :selected_hall="$selected_hall">
            </x-admin.buttons>
            {{--<x-admin.buttons :seats="$seats" :seance="$seances" :film="$films" :hall="$halls[$selected_hall-1]" :selected_hall="$selected_hall">
            </x-admin.buttons>--}}

        </div>
    </section>
    {{-- Конец секции конфигурация зала!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!--}}

    {{--Установка цен++++++++++++++++++++++++++++++--}}
    <section id="3" class="conf-step">
        <header class="conf-step__header {{$confstep3}}">
            <h2 class="conf-step__title">Конфигурация цен</h2>
        </header>
        <div class="conf-step__wrapper">
            <p class="conf-step__paragraph">Выберите зал для конфигурации:</p>
            <ul class="conf-step__selectors-box">
                @foreach ($halls as $hall)

                    <li>
                        @php
                            //$edit_hall = '1';
                            $hall_seances= $seances->where('hall_id', $hall->id);
                            if(count($hall_seances)>0) {
                             $edit_hall = '0';
                            } else {
                             $edit_hall = '1';
                            }
                            //dump($hall_seances);
                            //dump($edit_hall);

                        @endphp

                        @if($hall->{'id'} === $selected_hall)
                            <input id="{{$hall->id}}" onclick = "clickRadio(id)" type="radio" class="conf-step__radio" name="prices-hall" value="{{$hall->nameHall}}" checked @if ($open === '1') disabled @endif @if ($edit_hall === '0') disabled @endif ><span class="conf-step__selector">{{$hall->nameHall}}</span> </li>
                        @else
                            <input id="{{$hall->id}}" onclick = "clickRadio(id)" type="radio" class="conf-step__radio" name="prices-hall" value="{{$hall->nameHall}}" @if ($open === '1') disabled @endif  @if ($edit_hall === '0') disabled @endif ><span class="conf-step__selector">{{$hall->nameHall}}</span> </li>
                      @endif
                      </li>
                @endforeach
            </ul>

            <p class="conf-step__paragraph">Установите цены для типов кресел:</p>
            <div class="conf-step__legend">
                <label class="conf-step__label">Цена, рублей<input id="countNormal" type="text" class="conf-step__input count" placeholder="0" value="{{ $halls->where('id',$selected_hall)->first()->countNormal }}" @if ($open === '1') disabled @endif ></label>
                за <span class="conf-step__chair conf-step__chair_standart"></span> обычные кресла
            </div>
            <div class="conf-step__legend">
                <label class="conf-step__label">Цена, рублей<input id="countVip" type="text" class="conf-step__input count" placeholder="0" value="{{ $halls->where('id',$selected_hall)->first()->countVip }}" @if ($open === '1') disabled @endif ></label>
                за <span class="conf-step__chair conf-step__chair_vip"></span> VIP кресла
            </div>

            <fieldset class="conf-step__buttons text-center">
                <button onclick = " window.location.href='{{ route('admin.home', ['open'=> $open,'selected_hall' => $selected_hall]) }}' " href="#" class="conf-step__button conf-step__button-regular" @if ($open === '1') disabled @endif>Отмена</button>
                <input id="{{$hall->id}}" onclick = "clickEditPrice(id)" type="submit" value="Сохранить" class="conf-step__button conf-step__button-accent" @if ($open === '1') disabled @endif >

                <!--<input id="update" onclick = "clickUpdate()" type="submit" value="Сохранить" class="conf-step__button conf-step__button-accent" @if ($open === '1') disabled @endif >-->
            </fieldset>
        </div>
    </section>
    {{--dd($halls)--}}
    {{--dd($halls->where('id',$selected_hall)->first())--}}

    {{-- Конец секции установки цен  +++++++++++++++++++++++++++++++++++++--}}



    {{--Формирование сетки сеансов  +++++++++++++++++++++++++++++++++++++++++++--}}
    <section id="4" class="conf-step">
        <header class="conf-step__header {{$confstep4}}">
            <h2 class="conf-step__title">Сетка сеансов</h2>
        </header>
        <div class="conf-step__wrapper">
            <p class="conf-step__paragraph">
                <button id="addFilm" onclick = "clickAddFilm(id)" class="conf-step__button conf-step__button-accent" @if ($open === '1') disabled @endif >Добавить фильм</button>
            </p>
            {{--Блок оглавления фильмов --}}
            <div class="conf-step__movies">
                @foreach ($films as $film)
                    <div class="conf-step__movie" draggable="true" style="cursor: grabbing;">
                        {{-- Форма добавления фильма--}}
                        <form  action="{{ route('admin.destroyFilm', ['id' => $film->id]) }}" method="post" onsubmit="return confirm('Удалить этот фильм?')">
                            @csrf
                            @method('DELETE')

                            @php
                                $path= 'storage/folder/'.$film->imagePath;
                            @endphp
                            {{--Возможность удаления фильма по нажатию на изображение--}}
                            <button type="image" @if ($open === '1') disabled @endif ><img class="conf-step__movie-poster" alt="{{$film->imageText}}" src="{{ asset($film->imagePath)}}" ></button>
                            <h3 class="conf-step__movie-title">{{$film->title}}</h3>
                            <p class="conf-step__movie-duration">{{$film->duration}} минут</p>
                            <button href="#" class="task__remove visible conf-step__button conf-step__button-trash"></button>

                        </form>

                        @include('admin.add_seance', ['film'=> $film, 'halls'=> $halls])

                    </div>
                @endforeach
            </div>
            {{--конец блок оглавления фильмов --}}

            {{--Блок сетки фильмов --}}
            <div class="conf-step__seances">
                {{-- сетка фильмов для зала  --}}
                @foreach ($halls as $hall)
                <div id="{{$hall->id}}" class="conf-step__seances-hall">
                    <h3 class="conf-step__seances-title">{{$hall->nameHall}}</h3>
                    <div class="conf-step__seances-timeline drop-area">

                        <div class="conf-step__seances-movie" style="width: 60px; background-color: rgb(133, 255, 137); left: 0;">
                            <p class="conf-step__seances-movie-title">Миссия выполнима</p>
                            <p class="conf-step__seances-movie-start">00:00</p>
                        </div>
                        <div class="conf-step__seances-movie" style="width: 60px; background-color: rgb(133, 255, 137); left: 360px;">
                            <p class="conf-step__seances-movie-title">Миссия выполнима</p>
                            <p class="conf-step__seances-movie-start">12:00</p>
                        </div>
                        <div class="conf-step__seances-movie" style="width: 65px; background-color: rgb(202, 255, 133); left: 420px;">
                            <p class="conf-step__seances-movie-title">Звёздные войны XXIII: Атака клонированных клонов</p>
                            <p class="conf-step__seances-movie-start">14:00</p>
                        </div>

                    </div>
                </div>
                {{--}}
                <div id="{{$hall->id}}" class="conf-step__seances-hall">
                    <h3 class="conf-step__seances-title">{{$hall->nameHall}}</h3>
                    <div class="conf-step__seances-timeline drop-area">
                        <div class="conf-step__seances-movie" style="width: 65px; background-color: rgb(202, 255, 133); left: 595px;">
                            <p class="conf-step__seances-movie-title">Звёздные войны XXIII: Атака клонированных клонов</p>
                            <p class="conf-step__seances-movie-start">19:50</p>
                        </div>
                        <div class="conf-step__seances-movie" style="width: 60px; background-color: rgb(133, 255, 137); left: 660px;">
                            <p class="conf-step__seances-movie-title">Миссия выполнима</p>
                            <p class="conf-step__seances-movie-start">22:00</p>
                        </div>
                    </div>
                </div>
            </div>--}}
            @endforeach
            <fieldset class="conf-step__buttons text-center">
                <button class="conf-step__button conf-step__button-regular" href="#" @if ($open === '1') disabled @endif >Отмена</button>
                <input type="submit" value="Сохранить" class="conf-step__button conf-step__button-accent" href="#" @if ($open === '1') disabled @endif >
            </fieldset>
        </div>
        {{--Конец блока сетки фильмов <div class="conf-step__seances">--}}

        {{-- Меню popup добавления фильма--}}
        <div class="popup">
            <div class="popup__container">
                <div class="popup__content">
                    <div class="popup__header">
                        <h2 class="popup__title">
                            Добавление фильма
                            <a id="dismiss2" class="popup__dismiss" href="#" onclick = "cl3(id)"><img src="i/close.png" alt="Закрыть"></a>
                        </h2>

                    </div>
                    <div class="popup__wrapper">
                        <form action="{{route('admin.createFilm')}}" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
                            @csrf
                        {{--}}<form action="add_movie" method="post" accept-charset="utf-8">--}}
                            <label class="conf-step__label conf-step__label-fullsize" for="title">
                                Название фильма
                                <input class="conf-step__input" type="text" placeholder="Например, &laquo;Фильм&raquo;" name="title" required @if ($open === '1') disabled @endif>
                            </label>

                            <label class="conf-step__label conf-step__label-fullsize" for="description">
                                Описание фильма
                                <input class="conf-step__input" type="text" placeholder="Например, &laquo;О Фильме&raquo;" name="description" required @if ($open === '1') disabled @endif >
                            </label>

                            <label class="conf-step__label conf-step__label-fullsize" for="duration">
                                Длительность фильма
                                <input class="conf-step__input" type="text" placeholder="Например, &laquo;130&raquo;" name="duration" required @if ($open === '1') disabled @endif >
                            </label>

                            <label class="conf-step__label conf-step__label-fullsize" for="origin">
                                Страна фильма
                                <input class="conf-step__input" type="text" placeholder="Например, &laquo;Россия&raquo;" name="origin" required @if ($open === '1') disabled @endif >
                            </label>
                            <label class="conf-step__label conf-step__label-fullsize" for="imagaPath">
                                Изображение фильма
                                <input type="file" class="form-control-file" name="imagePath" accept="image/png, image/jpeg" @if ($open === '1') disabled @endif >
                            </label>
                            {{--
                            input type="file" class="form-control-file" name="image" accept="image/png, image/jpeg">
                            --}}

                            <div class="conf-step__buttons text-center">
                                <input type="submit" value="Добавить фильм" class="conf-step__button conf-step__button-accent" @if ($open === '1') disabled @endif >
                                <button id="cancel" onclick = "cl2(id)" class="conf-step__button conf-step__button-regular" @if ($open === '1') disabled @endif >Отменить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> {{--popup--}}
        </div> {{-- wrapper?--}}
    </section>
    {{-- Конец секции сетки сеансов!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!--}}


    {{--Открытие продажи  ++++++++++++++++++++++++++++++++++++++++++++++--}}
    <section id="5" class="conf-step">
        <header class="conf-step__header {{$confstep5}}">
            <h2 class="conf-step__title">Открыть продажи</h2>
        </header>
        <div class="conf-step__wrapper text-center">
            <p class="conf-step__paragraph">Всё готово, теперь можно:</p>
            <button id="open" onclick = "clickOpen(id)" class="conf-step__button conf-step__button-accent active" value="{{$open}}">{{$text}}</button>
            {{--}}<button id="open" class="conf-step__button conf-step__button-accent">Приостановить продажу билетов</button>--}}
        </div>
    </section>
    {{--Конец секции открытие продажи  ++++++++++++++++++++++++++++++++++++++++++++++--}}
   </main>

<script src="{{ asset('js/accordeon.js')}}"></script>

<script>
    //alert('скрипты');
    let idLast = 1;
    const input = document.querySelectorAll('.count');//кнопки input цен
    const input_row_col = document.querySelectorAll('.seats');//кнопки input место/ряд

    const input_button = [...Array.of(document.querySelectorAll('button')), ...Array.of(document.querySelectorAll('input'))];
    console.log('все кнопки и инп',input_button);

    let count = [0,0];
    let count_row_col = [0,0];
    let json_row_col = JSON.stringify(count_row_col);// типы мест
    let json_count = JSON.stringify(count);// стоимость мест

    //Обработчик ввода стоимости места в зале
    Array.from(input).forEach((button, index, arr) => {
        button.oninput = function () {
            //count[index] = button.value;
            console.log(button.value, arr[index].value, count);
        }
        button.onchange = function () {
            count[index] = button.value;
            console.log('конец');
            console.log(button.value, count, count.length);
            json_count=JSON.stringify(count);
            console.log('count json_count:', json_count);

        }
    });
    //console.log('count massiv:',count[0], count[1], count.length);
    //const json=JSON.stringify(count);
    //console.log('count json:', json);
    document.getElementById('update');


    //Обработчик ввода ряда, места в зале////повтор
    Array.from(input_row_col).forEach((button, index, arr) => {
        button.oninput = function () {
            //count[index] = button.value;
            console.log(button.value, arr[index].value, count_row_col);
        }
        button.onchange = function () {
            count_row_col[index] = button.value;
            json_row_col=JSON.stringify(count_row_col);
            console.log('конец');
            console.log(button.value, count_row_col, count_row_col.length);
            console.log('count json_row_col:', json_row_col);
            alert('idLast:');
            alert(idLast);
            //вызов обработчика editSeats(id)
            editSeats(idLast);
        }
    });
    //console.log('count_row_col massive:', count_row_col[0], count_row_col[1], count_row_col.length);
    /*
    for(let j=0; j<count_row_col.length; j++){
        console.log('count_row_col massive:', count_row_col[j]);
    }*/
    //const json_row_col=JSON.stringify(count_row_col);
    //console.log('count json_row:', json_row_col);
    //document.getElementById('update');

    //для диплома drag-drop film

    const shows1 = (id) => {
        const popupe = `.conf-step__movie #popup${id}.popup`;
        console.log('popup',popupe);
        const headers = document.querySelector(popupe);
        console.log('popup element', headers);
        headers.classList.toggle('active');
    }

    const cards2 = [...Array.from(document.querySelectorAll('.conf-step__movie'))];
    console.log('cards2 i this', this, cards2);
    for (const card of cards2) {
        card.onmouseenter = function Enter(e) {
            e.preventDefault();// если без span  то везде children 0!!!
            if (e.target.classList.contains('.conf-step__movie') && e.target.children[2].classList.contains('.visible')) {
                e.target.children[2].classList.remove('visible');

            }

                card.addEventListener('mousedown', (event) => {
                    if (event.target.classList.contains('task__remove')) {
                        return;
                    }

                    event.preventDefault();
                    let draggedEl = null;
                    let ghostEl = null;


                    //let element2 = event.target.closest('.div-body');
                    //console.log('===========', e.target, element2 );

                    let element3 = event.target.closest('.conf-step__movie');
                    //let element_color = element3.style.backgroundColor;   ///
                    //let element_color = element3.closest('.conf-step__movies').children[3].backgroundColor;
                    //let element_color = element3.closest('.conf-step__movies').backgroundColor;

                    // работало let element_color = element3.backgroundColor;
                    console.log('===========e.target =======element3!!!!', event.target, element3);              ///


                    if (!e.target.classList.contains('conf-step__movie')) {
                        return;
                    }                                                             ///


                    if (event.target.closest('.conf-step__movie').classList.contains('conf-step__movie')) {

                        element3.style.cursor = 'grabbing';

                        draggedEl = element3;
                        console.log('тянем это div', draggedEl);

                        ghostEl = element3.cloneNode(true);
                        ghostEl.classList.add('dragged');
                        document.body.appendChild(ghostEl);
                        ghostEl.style.position = 'absolute';
                        ghostEl.style.zIndex = 1000;
                        ghostEl.style.width = `${element3.offsetWidth}px`;
                        ghostEl.style.left = `${event.pageX - ghostEl.offsetWidth / 2}px`;
                        ghostEl.style.top = `${event.pageY - ghostEl.offsetHeight / 2}px`;
                        ghostEl.style.backgroundColor = 'green';
                        ghostEl.style.opacity = 0.6;
                        console.log('скопировали это dip', ghostEl);
                        //document.querySelector('.conf-step__seances-timeline.drop-area').style.backgroundColor = 'yellow';
                        //document.querySelector('.conf-step__seances-timeline.drop-area').style.backgroundColor = 'blue';
                    }

                    console.log('слушаем это dip', card.closest('.conf-step__movies').nextElementSibling);
                    //console.log('слушаем2 это dip', card.closest('.conf-step__wrapper'));

                    card.closest('.conf-step__movies').nextElementSibling.addEventListener('mousemove', (e) => {
                        e.preventDefault(); // не даём выделять элементы
                        if (!draggedEl) {
                            return;
                        }
                        ghostEl.style.left = `${e.pageX - ghostEl.offsetWidth / 2}px`;
                        ghostEl.style.top = `${e.pageY - ghostEl.offsetHeight / 2}px`;
                        console.log('позиция', ghostEl.style.left, ghostEl.style.top);
                        console.log('event mousemove\n', e.target, e.currentTarget);
                    });
                    //отпустили блок
                    document.addEventListener('mouseup', (e) => {
                        //e.stopPropagation();
                        //e.preventDefault(); // не даём выделять элементы
                        console.log('event mouseup!!!!!!', e.target, e.currentTarget, e.relatedTarget);
                        console.log('draddedEl', draggedEl);
                        console.log('ghost', ghostEl);
                        if (!draggedEl) {
                            return;
                        }

                        let closest = document.elementFromPoint(e.clientX, e.clientY);// p- элемент
                        console.log('closest 1 и 2\n', closest, document.elementsFromPoint(e.clientX, e.clientY));
                        console.log('dragged parent\n', draggedEl.parentElement, draggedEl.parentElement.parentNode);
                        console.log('ghostd parent\n', ghostEl.parentElement, ghostEl.parentElement.parentNode);

                        let closestParent = closest.closest('.conf-step__movie');//div
                        console.log('closestparent   2el\n', closestParent);

                        //const parent = closest.closest('div.conf-step__seances-hall');
                        console.log('element3\n', element3);
                        //let parent = element3.closest(".conf-step__seances-hall");
                        //let parent = closest.closest('.conf-step__seances-timeline.drop-area');
                        //let parent =closestParent.closest('.conf-step__seances-hall');
                        let parent, col;
                        for (const el of [...Array.from(document.elementsFromPoint(e.clientX, e.clientY))]) {
                            if (el.classList.contains('conf-step__seances-timeline')) {
                                console.log("ребенок ok555555", el);
                                parent = el;
                                //col =  parent.style.backgroundColor;
                                parent.style.backgroundColor = 'yellow';
                            }
                            console.log("ребенок", el);
                        }

                        console.log('parent conf-step__seances-hall\n', parent);
                        //let parent = closest.closest('.conf-step__seances-timeline.drop-area');

                        console.log('кидаем это на e.currentTarget', '\n ghostEl', ghostEl, '\n dragged', draggedEl, '\n etarget', e.target, '\n closest', closest, '\n carrenttag', e.currentTarget);
                        console.log('childrene.currentTarget', e.currentTarget.children);
                        console.log('childrene.Target', e.target.children);
                        //console.log('parent', parent);
                        //console.log('closestparent', closestParent);
                        const {top} = closest.getBoundingClientRect();
                        /*if (e.pageY > window.scrollY + top + closest.offsetHeight / 2) {
                           parent.children[1].appendChild(draggedEl);
                        } else {
                          parent.children[1].insertBefore(draggedEl, closestParent);
                        }*/

                        //if (e.pageX > window.scrollX + top + closest.offsetWidth / 2) {
                        console.log('вставляем сюда', parent);
                        // parent.children[1].appendChild(draggedEl);
                        //показать попап / предотвратить дроп
                        //shows1(1);

                        draggedEl.style.width = '60px';
                        draggedEl.style.height = '40px';
                        //draggedEl.style.backgroundColor = `${element_color}`;//'magenta';
                        draggedEl.style.overflow = 'hidden';
                        draggedEl.style.opacity = 0.6;
                        draggedEl.style.left = '60px';
                        draggedEl.classList.value = 'conf-step__seances-movie';
                        //document.querySelector('.conf-step__seances-timeline').append(draggedEl);
                        parent.append(draggedEl);


                        //} else {
                        // parent.children[1].insertBefore(draggedEl, closestParent);
                        //}
                        document.body.removeChild(ghostEl);
                        //parent.style.backgroundColor = col;
                        //document.body.remove(ghostEl);
                        ghostEl = null;
                        draggedEl = null;
                        //e.preventDefault();
                        //показать попап
                        shows1('1');
                        event.preventDefault();
                        return;



                        /*card.removeEventListener('mousedown', (event) => {
                            event.preventDefault();
                        };*/
                    });
                });//  mousedown
            //}; //if
        };

        card.onmouseleave = function Leave(ev) {
            ev.preventDefault();
        };

    }//for




    //==================================== function==========================
    // Обработка выбора типа места по клику
    function select(id, hall){
        let rand;
        console.log(id);
        let type= id.split(' ');//conf-step__chair conf-step__chair_
        let arr=['VIP','NORM','FAIL'];
        let arr2={'VIP':'vip', 'NORM':'standart','FAIL':'disabled'};
        rand = arr.indexOf(type[1]);
        console.log('rand',rand);

        console.log('после деления',type[1]);
        console.log('dele тип в массиве', arr);
        console.log(document.getElementById(id).closest('.conf-step'));

        if (rand === 0){
          rand = 1;}
        else if (rand === 1) {
          rand= 2;}
        else if (rand === 2) {
            rand= 0;}
        console.log('rand',rand);
        console.log('arr2[type[1]]:', arr2[type[1]]);

        let classDelete = `conf-step__chair conf-step__chair_${arr2[type[1]]}`;
        let classSelect = `conf-step__chair conf-step__chair_${arr2[arr[rand]]}`;

        console.log(document.getElementById(id).classList);
        console.log(classSelect);
        document.getElementById(id).classList.value = classDelete;
        console.log('после удал',document.getElementById(id).classList);
        document.getElementById(id).classList.value = classSelect;
        console.log('после добавл',document.getElementById(id).classList);
        //console.log('заменяем id у',document.getElementById(id));
        document.getElementById(id).id = `${type[0]} ${arr[rand]}`;
        console.log('id после замены',document.getElementById(`${type[0]} ${arr[rand]}`));

    }

    function editSeats(id){
        // Меняем массив typeOfSeats - типы мест в зале(нажатие сохранить)
        console.log('editSeats');
        //idLast = id;
        //alert('idLast:', idLast);
        //alert(idLast);
        //alert(id);
        //let newTypeOfSeats= {};
        let newTypeOfSeats= [];
        Array.of(document.querySelectorAll('button.conf-step__chair')).forEach((element, index, array) => {
            console.log('кнопка',index, array[index]);
            for(let i=0; i<element.length; i++) {
                const elementSplite = element[i].id.split(' ');
                console.log('massiv splite',elementSplite, elementSplite[0], elementSplite[1]);
                //newTypeOfSeats.push(element[i].id);
                let key = elementSplite[0];
                let value = elementSplite[1];
                newTypeOfSeats.push({key: key, value: value});
                //newTypeOfSeats.key= key;
                //newTypeOfSeats.value = value;
               // const newTypeOfSeats = {...key};
                console.log('massiv',newTypeOfSeats[i]);
                //console.log('massiv',newTypeOfSeats[i]);

            }
        });

        let json_string=JSON.stringify(newTypeOfSeats);
        //let url = "{{--route('admin.editHall', ['hall'=> $hall, 'newTypeOfSeats' => 'json', 'user'=> $user, 'films' => $films, 'halls' => $halls, 'seances'=> $seances, 'dateCurrent' => $dateCurrent, 'dateChosen'=> $dateChosen, 'seats'=> $seats])--}}";

        // было работало let url = "{{--route('admin.editHall', ['hall'=> $halls->where('id', $selected_hall)[0], 'newTypeOfSeats' => 'json', 'json_seat' => 'json_row_col'])--}}";
        let url = "{{route('admin.editHall', ['hall'=> $halls->where('id', $selected_hall)->first(), 'newTypeOfSeats' => 'json_string', 'json_seat' => 'json_row_col'])}}";

        //?????? let url = "{{--route('admin.editHall', ['hall'=> $hall_sel, 'newTypeOfSeats' => 'json', 'json_seat' => 'json_row_col'])--}}";

        url = url.replace('json_string', json_string);//console.log('replace url  ', url);
        url = url.replace('json_row_col', json_row_col);
        console.log('replace url  ', url);
        console.log('count json_row:', json_row_col);
        alert(json_row_col);
        url = url.replaceAll('&amp;', '&');
        console.log('получили url для обновления   ',url);
        alert(url);
        window.location.href = url;
    }
    // редактирование цен
    function clickEditPrice(id){
        //idLast = id;//?

        let url = "{{route('admin.editPriceHall', ['hall'=> $halls->where('id', $selected_hall)->first(), 'count' => 'json_count'])}}";
        //alert(json_count);
        url = url.replace('json_count', json_count);
        console.log('replace url  ', url);
        url = url.replaceAll('&amp;', '&');
        console.log('получили url для обновления   ',url);
       // alert(url);
        window.location.href = url;

    }

    //Открыть форму добавления зала/фильма
    function clickAddFilm(id){
        console.log(id);
        console.log(document.getElementById(id));
        //console.log(document.getElementById(id).closest('.conf-step'));
        console.log(document.getElementById(id).closest('.conf-step__wrapper').children[3]);
        document.getElementById(id).closest('.conf-step__wrapper').children[3].classList.add("active");
    }
    //Открыть форму добавления зала/фильма
    function clickAddHall(id){
        console.log(id);
        console.log(document.getElementById(id));
        //console.log(document.getElementById(id).closest('.conf-step'));
        console.log(document.getElementById(id).closest('.conf-step').children[2]);
        document.getElementById(id).closest('.conf-step').children[2].classList.add("active");
    }


    //Закрыть форму добавления зала/фильма
    function cl2(id){
        /*console.log(id);
        console.log(document.getElementById(id).closest('.conf-step'));
        console.log(document.getElementById(id).closest('.conf-step').children[2]);*/
        document.getElementById(id).closest('.conf-step').children[2].classList.remove("active");
    }

    //Закрыть popup форму добавления зала/ фильма
    function cl3(id){
        console.log(id);
        console.log("родитель с active", document.getElementById(id).closest('.popup'));
        document.getElementById(id).closest('.popup').classList.remove("active");
        console.log("родитель ,tp active", document.getElementById(id).closest('.popup'));
    }

   //Выбор кресла id /в выбранном зале idLast
    function scheme(id){
        console.log(id);
        console.log(idLast);
    }

    //Переключатель зала
    function clickRadio(id){
        console.log('clickradio', id);
        idLast = id;
        //alert( idLast);
        let url = "{{ route('admin.home',['selected_hall' => 'id', 'open'=> $open, 'text'=> $text]) }}";
        let idi = String(id);
        console.log('idi', id);
        url = url.replace('id', +idi);    //url = url.replace('open_2', `${ {{--$open --}}}`);
        url = url.replaceAll('&amp;', '&');
        console.log('replaceed amp url  ', url);   // alert(url);
        window.location.href= url
    }
    // переключатель блокировка/разблокировка редактирования(добавление св-ва disabled)
    function disabled(parametr) {
        console.log(parametr);
        input_button.forEach((element, index, array) => {
           // alert('кнопкb',element.length,index, array[index]);
            for(let i=0; i<element.length; i++) {
                //element[i].disabled = !element[i].disabled;
                element[i].disabled = parametr;
                console.log('massiv ',element[i], element[i].disabled);
                //console.log('massiv',newTypeOfSeats[i]);
            }
        });
    }

    // переключатель открытие/закрытие продаж
    function clickOpen(id)
    {
        elem = document.getElementById(`${id}`);
        console.log(elem, +elem.value, !Boolean(+elem.value));
        //alert(elem, +elem.value, !Boolean(+elem.value));
        url = "{{ route('admin.open',['param' => 'id']) }}";

        url = url.replace('id', +!Boolean(+elem.value));
        url = url.replaceAll('&amp;', '&');
        console.log('replaceed amp url  ', url);
        console.log(url);
        elem.value = +!Boolean(+elem.value);
        console.log(elem.value, " new value ",elem);
        //id = !(id);
        //elem.classList.toggle("active");
        /*if(elem.value === "1") {
            elem.textContent = "Приостановить продажу билетов";
        } else {
            elem.textContent = "Открыть продажу билетов";
        }*/
        //alert(document.getElementById(`${id}`).value);
        if(elem.value === "1") {
            disabled(true);
        } else {
            disabled(false);
        }
        elem.disabled = false;
        window.location.href= url
    }

    function popupToggle(id){
        //alert(id);
        let p= 'popup'+`${id}`;
        //alert(p);
        const  popup = document.getElementById(p);
       // alert(popup.classList);
        popup.classList.toggle('active')
    }
    //dragdrop



    //Обновление инфо о ценах кресел в зале не работает
    /*
    function clickUpdate(id){
        console.log('clickradio', id);
        const json=JSON.stringify(count);
        //let url = "{{--route('admin.updateHall', ['hall'=> $hall, 'count' => 'json'])--}}";
        url = url.replace('json', json);
        url = url.replaceAll('&amp;', '&');
        console.log('replaceed amp url  ', url);
        //window.location.href= url;
    }
    */
</script>

</body>
</html>



<!--
@auth
    @if(Auth::user()->isAdmin())
        Это видит только админ
@endif
@endauth

width: calc(1440px * 0.5);
//1440 минут в сутках. 1 минута = 0,5 пикселя. Блок фильма длиной 120 минут будет 60 пикселей по ширине.


https://codelab.pro/drag-and-drop-api-podrobnoe-rukovodstvo-na-javascript/ drad-drop
https://qna.habr.com/q/256784
-->
