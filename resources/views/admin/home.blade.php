{{-- Административная панель. Главная страница--}}

<!DOCTYPE html>
<html lang="en">
<!--
<div style="width: 1000px; margin: 10px auto 0; border: 2px solid;">
    <div>Привет, {{$user['name']}}</div><br>
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

<main class="conf-steps">
    {{-- Создание зала +++++++++++++++++++++++++++++--}}
    <section class="conf-step">
        <header class="conf-step__header conf-step__header_opened">
            <h2 class="conf-step__title">Управление залами</h2>
        </header>
        <div class="conf-step__wrapper">
            <p class="conf-step__paragraph">Доступные залы:</p>
            <ul class="conf-step__list">
                @foreach ($halls as $hall)
                    {{-- Форма создания зала--}}
                    <form action="{{ route('admin.destroyHall', ['id' => $hall->id]) }}" method="post" onsubmit="return confirm('Удалить этот зал?')">
                        @csrf
                        @method('DELETE')
                        <li>{{$hall->nameHall}}
                        <button id="{{$hall->id}}"  class="conf-step__button conf-step__button-trash">
                        </button>
                        </li>
                    </form>
                @endforeach
            </ul>
            <button id= "create" onclick = "clickAdd(id)"  class="conf-step__button conf-step__button-accent">Создать зал</button>

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
                                <input class="conf-step__input" type="text" placeholder="Например, «Зал 1»" name="name" required="">
                            </label>
                            <div class="conf-step__buttons text-center">
                                <input type="submit" value="Добавить зал" class="conf-step__button conf-step__button-accent">
                                <button onclick = "cl2(id)" class="conf-step__button conf-step__button-regular" href="#">Отменить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
    {{-- Конец секции создания зала--}}

    {{-- Конфигурация зала!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!--}}
    <section class="conf-step">
        <header class="conf-step__header conf-step__header_opened">
            <h2 class="conf-step__title">Конфигурация залов</h2>
        </header>
        <div class="conf-step__wrapper">
            <p class="conf-step__paragraph">Выберите зал для конфигурации:</p>
            <ul class="conf-step__selectors-box">

                @foreach ($halls as $hall)
                    {{--dump($halls)--}}
                    {{--dump($selected_hall)--}}
                {{--dump($halls->where('id',$selected_hall))--}}
                    <li>
                        {{--$selected_hall--}}
                        @if($hall->id === $selected_hall )
                            <input id="{{$hall->id}}" onclick = "clickRadio(id)" type="radio" class="conf-step__radio" name="chairs-hall" value="{{$hall->nameHall}}" checked><span class="conf-step__selector">{{$hall->nameHall}}</span></li>
                    @else
                        <input id="{{$hall->id}}" onclick = "clickRadio(id)" type="radio" class="conf-step__radio" name="chairs-hall" value="{{$hall->nameHall}}"><span class="conf-step__selector">{{$hall->nameHall}}</span></li>
                        @endif
                        </li>
                        @endforeach
            </ul>
            <p class="conf-step__paragraph">Укажите количество рядов и максимальное количество кресел в ряду:</p>
            <div class="conf-step__legend">
                <label class="conf-step__label">Рядов, шт<input id="countRow" type="text" class="conf-step__input" placeholder="{{$halls[$selected_hall-1]->row}}" value="{{$halls[$selected_hall-1]->row}}"></label>
                <span class="multiplier">x</span>
                <label class="conf-step__label">Мест, шт<input id="countCol" type="text" class="conf-step__input" placeholder="{{$halls[$selected_hall-1]->col}}" value="{{$halls[$selected_hall-1]->col}}" ></label>
            </div>
            <p class="conf-step__paragraph">Теперь вы можете указать типы кресел на схеме зала:</p>
            <div class="conf-step__legend">
                <span class="conf-step__chair conf-step__chair_standart"></span> — обычные кресла
                <span class="conf-step__chair conf-step__chair_vip"></span> — VIP кресла
                <span class="conf-step__chair conf-step__chair_disabled"></span> — заблокированные (нет кресла)
                <p class="conf-step__hint">Чтобы изменить вид кресла, нажмите по нему левой кнопкой мыши</p>
            </div>
            {{-- Схема зала--}}
            @php
                $selected = [];
            @endphp

            <x-admin.buttons :seats="$seats" :seance="$seances" :film="$films" :hall="$halls->where('id', $selected_hall)[0]" :selected="$selected">
            </x-admin.buttons>

        </div>
    </section>

    {{--Установка цен--}}
    <section class="conf-step">
        <header class="conf-step__header conf-step__header_opened">
            <h2 class="conf-step__title">Конфигурация цен</h2>
        </header>
        <div class="conf-step__wrapper">
            <p class="conf-step__paragraph">Выберите зал для конфигурации:</p>
            <ul class="conf-step__selectors-box">
                @foreach ($halls as $hall)
                    <li>
                        @if($hall->id === "2" )
                            <input id="{{$hall->id}}" onclick = "clickRadio(id)" type="radio" class="conf-step__radio" name="prices-hall" value="{{$hall->nameHall}}" checked><span class="conf-step__selector">{{$hall->nameHall}}</span></li>
                        @else
                    <input id="{{$hall->id}}" onclick = "clickRadio(id)" type="radio" class="conf-step__radio" name="prices-hall" value="{{$hall->nameHall}}"><span class="conf-step__selector">{{$hall->nameHall}}</span></li>
                         @endif
                    </li>
                @endforeach
            </ul>

            <p class="conf-step__paragraph">Установите цены для типов кресел:</p>
            <div class="conf-step__legend">
                <label class="conf-step__label">Цена, рублей<input id="countNormal" type="text" class="conf-step__input count" placeholder="0" value="500" ></label>
                за <span class="conf-step__chair conf-step__chair_standart"></span> обычные кресла
            </div>
            <div class="conf-step__legend">
                <label class="conf-step__label">Цена, рублей<input id="countVip" type="text" class="conf-step__input count" placeholder="0" value="1000"></label>
                за <span class="conf-step__chair conf-step__chair_vip"></span> VIP кресла
            </div>

            <fieldset class="conf-step__buttons text-center">
                <button class="conf-step__button conf-step__button-regular">Отмена</button>
                <input id="update" onclick = "clickUpdate()" type="submit" value="Сохранить" class="conf-step__button conf-step__button-accent">
            </fieldset>
        </div>
    </section>

    {{--Формирование сетки сеансов--}}
    <section class="conf-step">
        <header class="conf-step__header conf-step__header_opened">
            <h2 class="conf-step__title">Сетка сеансов</h2>
        </header>
        <div class="conf-step__wrapper">
            <p class="conf-step__paragraph">
                <button id="addFilm" onclick = "clickAdd(id)" class="conf-step__button conf-step__button-accent">Добавить фильм</button>
            </p>
            {{--Блок оглавления фильмов --}}
            <div class="conf-step__movies">
                @foreach ($films as $film)
                    <div class="conf-step__movie">
                        {{-- Форма добавления фильма--}}
                        <form action="{{ route('admin.destroyFilm', ['id' => $film->id]) }}" method="post" onsubmit="return confirm('Удалить этот фильм?')">
                            @csrf
                            @method('DELETE')
                            {{--Возможность удаления фильма по нажатию на изображение--}}
                            <button><img class="conf-step__movie-poster" alt={{$film->imageText}} src={{ asset($film->imagePath)}}></button>
                            <h3 class="conf-step__movie-title">{{$film->title}}</h3>
                        <p class="conf-step__movie-duration">{{$film->duration}} минут</p>
                        </form>
                    </div>
                @endforeach
            </div>
            {{--конец блок оглавления фильмов --}}

            {{--Блок сетки фильмов --}}
            <div class="conf-step__seances">
                <div class="conf-step__seances-hall">
                    <h3 class="conf-step__seances-title">Зал 1</h3>
                    <div class="conf-step__seances-timeline">
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
                <div class="conf-step__seances-hall">
                    <h3 class="conf-step__seances-title">Зал 2</h3>
                    <div class="conf-step__seances-timeline">
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
            </div>

            <fieldset class="conf-step__buttons text-center">
                <button class="conf-step__button conf-step__button-regular">Отмена</button>
                <input type="submit" value="Сохранить" class="conf-step__button conf-step__button-accent">
            </fieldset>
        </div>
        {{--Конец блока сетки фильмов --}}

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
                        <form action="{{route('admin.createFilm')}}" method="POST" accept-charset="utf-8">
                            @csrf
                        {{--}}<form action="add_movie" method="post" accept-charset="utf-8">--}}
                            <label class="conf-step__label conf-step__label-fullsize" for="title">
                                Название фильма
                                <input class="conf-step__input" type="text" placeholder="Например, &laquo;Фильм&raquo;" name="title" required>
                            </label>

                            <label class="conf-step__label conf-step__label-fullsize" for="description">
                                Описание фильма
                                <input class="conf-step__input" type="text" placeholder="Например, &laquo;О Фильме&raquo;" name="description" required>
                            </label>

                            <label class="conf-step__label conf-step__label-fullsize" for="duration">
                                Длительность фильма
                                <input class="conf-step__input" type="text" placeholder="Например, &laquo;130&raquo;" name="duration" required>
                            </label>

                            <label class="conf-step__label conf-step__label-fullsize" for="origin">
                                Страна фильма
                                <input class="conf-step__input" type="text" placeholder="Например, &laquo;Россия&raquo;" name="origin" required>
                            </label>
                            <label class="conf-step__label conf-step__label-fullsize" for="imagaPath">
                                Изображение фильма
                                <input type="file" class="form-control-file" name="imagePath" accept="image/png, image/jpeg">
                            </label>
                            {{--
                            input type="file" class="form-control-file" name="image" accept="image/png, image/jpeg">
                            --}}

                            <div class="conf-step__buttons text-center">
                                <input type="submit" value="Добавить фильм" class="conf-step__button conf-step__button-accent">
                                <button id="cancel" onclick = "cl2(id)" class="conf-step__button conf-step__button-regular">Отменить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{--Открытие продажи--}}
    <section class="conf-step">
        <header class="conf-step__header conf-step__header_opened">
            <h2 class="conf-step__title">Открыть продажи</h2>
        </header>
        <div class="conf-step__wrapper text-center">
            <p class="conf-step__paragraph">Всё готово, теперь можно:</p>
            <button class="conf-step__button conf-step__button-accent">Открыть продажу билетов</button>
        </div>
    </section>
</main>

<script src="{{ asset('js/accordeon.js')}}"></script>

<script>
    let idLast = 1;
    const input = document.querySelectorAll('.count');
    let count = [];

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
        console.log('id hall', id);
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

        const json=JSON.stringify(newTypeOfSeats);//console.log('json  selectedddd', json);
        //let url = "{{route('admin.editHall', ['hall'=> $hall, 'newTypeOfSeats' => 'json', 'user'=> $user, 'films' => $films, 'halls' => $halls, 'seances'=> $seances, 'dateCurrent' => $dateCurrent, 'dateChosen'=> $dateChosen, 'seats'=> $seats])}}";
        let url = "{{route('admin.editHall', ['hall'=> 'hl', 'newTypeOfSeats' => 'json'])}}";

        //console.log('url   ',url);console.log('selected url  ', selected);
        //let hl= JSON.stringify('$halls->where('id', $selected_hall)[0]');
        url = url.replace('hl', id);
        url = url.replace('json', json);//console.log('replace url  ', url);
        url = url.replaceAll('&amp;', '&');//console.log('replace amp url  ', url);
        console.log('получили url для обновления   ',url);
        window.location.href = url;
    }

    //Открыть форму добавления зала/фильма
    function clickAdd(id){
        console.log(id);
        console.log(document.getElementById(id));
        console.log(document.getElementById(id).closest('.conf-step'));
        console.log(document.getElementById(id).closest('.conf-step').children[2]);
        document.getElementById(id).closest('.conf-step').children[2].classList.add("active");
    }

    /*Открыть форму добавления фильма
    function clickAddActive(id){
        console.log(id);
        console.log(document.getElementById(id));

        console.log(document.getElementById(id).closest('.conf-step'));
        console.log(document.getElementById(id).closest('.conf-step').children[2]);
        document.getElementById(id).closest('.conf-step').children[2].classList.add("active");
    }*/

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
        console.log(document.getElementById('countNormal'));
        document.getElementById('countNormal').value = '{{$hall->countNormal}}';
        document.getElementById('countVip').value = '{{$hall->countVip}}';
        console.log('clickradio', id);
        idLast = id;
        alert( idLast);

        url = "{{route('admin.home',['selected_hall' => 'id', 'user'=> $user, 'films' => $films, 'halls' => $halls, 'seances'=> $seances, 'dateCurrent' => $dateCurrent, 'dateChosen'=> $dateChosen, 'seats'=> $seats])}}";
        url = url.replace('id', id);
        url = url.replaceAll('&amp;', '&');
        console.log('replaceed amp url  ', url);
        //alert(url);
        //window.location.href= url
    }

    //Обновление инфо о ценах кресел в зале..не работает
    /*
    function clickUpdate(id){

        console.log('clickradio', id);
        const json=JSON.stringify(count);

        //let url = "{{route('admin.updateHall', ['hall'=> $hall, 'count' => 'json'])}}";
        url = url.replace('json', json);
        url = url.replaceAll('&amp;', '&');
        console.log('replaceed amp url  ', url);
        //window.location.href= url;
    }
    */

    {{--работало, но теперь не нужно
    function clickDestroy(id){
        console.log('hall id:', id);
        let url = "{{ route('admin.destroyHall', ['id' => 'json'] ) }}";
        console.log('url  ', url);
        //let json=JSON.stringify(id);
        let json = Number(id);
        url = url.replace('json', json);
        //console.log('replaceed id url  ', url);
        url = url.replaceAll('&amp;', '&');
        console.log('replaceed amp url  ', url);
        window.location.href= url;
    }
    --}}

    //console.log(input);
    //Обработчик ввода стоимости места в зале
    Array.from(input).forEach((button, index, arr) => {
        button.oninput = function () {
            //count[index] = button.value;
            console.log(button.value, arr[index].value);
        }
        button.onchange = function () {
            count[index] = button.value;
            console.log('конец');
            console.log(button.value);
        }
    });
    console.log('count:',count);
    const json=JSON.stringify(count);
    document.getElementById('update')
</script>
</body>
</html>



<!--
@auth
    @if(Auth::user()->isAdmin())
        Это видит только админ
@endif
@endauth




https://qna.habr.com/q/256784
-->
