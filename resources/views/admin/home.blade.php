<!DOCTYPE html>
<html lang="en">
<!-- Административная панель-->
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
    <section class="conf-step">
        <header class="conf-step__header conf-step__header_opened">
            <h2 class="conf-step__title">Управление залами</h2>
        </header>
        <div class="conf-step__wrapper">
            <p class="conf-step__paragraph">Доступные залы:</p>
            <ul class="conf-step__list">
                @foreach ($halls as $hall)
                <li>{{$hall->nameHall}}
                    <button id="{{$hall->id}}"  class="conf-step__button conf-step__button-trash"></button>
                </li>
                @endforeach
            </ul>
            <button id= "create" onclick = "cl(id)"  class="conf-step__button conf-step__button-accent">Создать зал</button>

        </div>
        {{-- Конец Меню создания зала--}}
        <div class="popup">
            <div class="popup__container">
                <div class="popup__content">
                    <div class="popup__header">
                        <h2 class="popup__title">
                            Добавление зала
                            <a class="popup__dismiss" href="#"><img src="i/close.png" alt="Закрыть"></a>
                        </h2>

                    </div>
                    <div class="popup__wrapper">
                        <form action="{{route('admin.createHall')}}" method="POST" accept-charset="utf-8">
                            @csrf
                            <label class="conf-step__label conf-step__label-fullsize" for="name">
                                Название зала
                                <input class="conf-step__input" type="text" placeholder="Например, «Зал 1»" name="name" required="">
                            </label>
                            <div class="conf-step__buttons text-center">
                                <input type="submit" value="Добавить зал" class="conf-step__button conf-step__button-accent">
                                <button class="conf-step__button conf-step__button-regular">Отменить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- Конец Меню создания зала--}}
    </section>

    <section class="conf-step">
        <header class="conf-step__header conf-step__header_opened">
            <h2 class="conf-step__title">Конфигурация залов</h2>
        </header>
        <div class="conf-step__wrapper">
            <p class="conf-step__paragraph">Выберите зал для конфигурации:</p>
            <ul class="conf-step__selectors-box">
                <li><input type="radio" class="conf-step__radio" name="chairs-hall" value="Зал 1" checked><span class="conf-step__selector">Зал 1</span></li>
                <li><input type="radio" class="conf-step__radio" name="chairs-hall" value="Зал 2"><span class="conf-step__selector">Зал 2</span></li>
            </ul>
            <p class="conf-step__paragraph">Укажите количество рядов и максимальное количество кресел в ряду:</p>
            <div class="conf-step__legend">
                <label class="conf-step__label">Рядов, шт<input type="text" class="conf-step__input" placeholder="10" ></label>
                <span class="multiplier">x</span>
                <label class="conf-step__label">Мест, шт<input type="text" class="conf-step__input" placeholder="8" ></label>
            </div>
            <p class="conf-step__paragraph">Теперь вы можете указать типы кресел на схеме зала:</p>
            <div class="conf-step__legend">
                <span class="conf-step__chair conf-step__chair_standart"></span> — обычные кресла
                <span class="conf-step__chair conf-step__chair_vip"></span> — VIP кресла
                <span class="conf-step__chair conf-step__chair_disabled"></span> — заблокированные (нет кресла)
                <p class="conf-step__hint">Чтобы изменить вид кресла, нажмите по нему левой кнопкой мыши</p>
            </div>

            <div class="conf-step__hall">
                <div class="conf-step__hall-wrapper">
                    <div class="conf-step__row">
                        <span class="conf-step__chair conf-step__chair_disabled"></span><span class="conf-step__chair conf-step__chair_disabled"></span>
                        <span class="conf-step__chair conf-step__chair_disabled"></span><span class="conf-step__chair conf-step__chair_standart"></span>
                        <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_disabled"></span>
                        <span class="conf-step__chair conf-step__chair_disabled"></span><span class="conf-step__chair conf-step__chair_disabled"></span>
                    </div>

                    <div class="conf-step__row">
                        <span class="conf-step__chair conf-step__chair_disabled"></span><span class="conf-step__chair conf-step__chair_disabled"></span>
                        <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
                        <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
                        <span class="conf-step__chair conf-step__chair_disabled"></span><span class="conf-step__chair conf-step__chair_disabled"></span>
                    </div>

                    <div class="conf-step__row">
                        <span class="conf-step__chair conf-step__chair_disabled"></span><span class="conf-step__chair conf-step__chair_standart"></span>
                        <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
                        <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
                        <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_disabled"></span>
                    </div>

                    <div class="conf-step__row">
                        <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
                        <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_vip"></span>
                        <span class="conf-step__chair conf-step__chair_vip"></span><span class="conf-step__chair conf-step__chair_standart"></span>
                        <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_disabled"></span>
                    </div>

                    <div class="conf-step__row">
                        <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
                        <span class="conf-step__chair conf-step__chair_vip"></span><span class="conf-step__chair conf-step__chair_vip"></span>
                        <span class="conf-step__chair conf-step__chair_vip"></span><span class="conf-step__chair conf-step__chair_vip"></span>
                        <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_disabled"></span>
                    </div>

                    <div class="conf-step__row">
                        <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
                        <span class="conf-step__chair conf-step__chair_vip"></span><span class="conf-step__chair conf-step__chair_vip"></span>
                        <span class="conf-step__chair conf-step__chair_vip"></span><span class="conf-step__chair conf-step__chair_vip"></span>
                        <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_disabled"></span>
                    </div>

                    <div class="conf-step__row">
                        <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
                        <span class="conf-step__chair conf-step__chair_vip"></span><span class="conf-step__chair conf-step__chair_vip"></span>
                        <span class="conf-step__chair conf-step__chair_vip"></span><span class="conf-step__chair conf-step__chair_vip"></span>
                        <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_disabled"></span>
                    </div>

                    <div class="conf-step__row">
                        <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
                        <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
                        <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
                        <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_disabled"></span>
                    </div>

                    <div class="conf-step__row">
                        <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
                        <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
                        <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
                        <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
                    </div>

                    <div class="conf-step__row">
                        <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
                        <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
                        <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
                        <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
                    </div>
                </div>
            </div>

            <fieldset class="conf-step__buttons text-center">
                <button class="conf-step__button conf-step__button-regular">Отмена</button>
                <input type="submit" value="Сохранить" class="conf-step__button conf-step__button-accent">
            </fieldset>
        </div>
    </section>

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
                {{--}}
                <li><input type="radio" class="conf-step__radio" name="prices-hall" value="Зал 1"><span class="conf-step__selector">Зал 1</span></li>
                <li><input type="radio" class="conf-step__radio" name="prices-hall" value="Зал 2" checked><span class="conf-step__selector">Зал 2</span></li>
                --}}
            </ul>

            <p class="conf-step__paragraph">Установите цены для типов кресел:</p>
            <div class="conf-step__legend">
                <label class="conf-step__label">Цена, рублей<input id="countNormal" type="text" class="conf-step__input count" placeholder="0" ></label>
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

    <section class="conf-step">
        <header class="conf-step__header conf-step__header_opened">
            <h2 class="conf-step__title">Сетка сеансов</h2>
        </header>
        <div class="conf-step__wrapper">
            <p class="conf-step__paragraph">
                <button class="conf-step__button conf-step__button-accent">Добавить фильм</button>
            </p>
            <div class="conf-step__movies">
                <div class="conf-step__movie">
                    <img class="conf-step__movie-poster" alt="poster" src="{{ asset('i/poster.png')}}">
                    <h3 class="conf-step__movie-title">Звёздные войны XXIII: Атака клонированных клонов</h3>
                    <p class="conf-step__movie-duration">130 минут</p>
                </div>

                <div class="conf-step__movie">
                    <img class="conf-step__movie-poster" alt="poster" src="{{ asset('i/poster.png')}}">
                    <h3 class="conf-step__movie-title">Миссия выполнима</h3>
                    <p class="conf-step__movie-duration">120 минут</p>
                </div>

                <div class="conf-step__movie">
                    <img class="conf-step__movie-poster" alt="poster" src="{{ asset('i/poster.png')}}">
                    <h3 class="conf-step__movie-title">Серая пантера</h3>
                    <p class="conf-step__movie-duration">90 минут</p>
                </div>

                <div class="conf-step__movie">
                    <img class="conf-step__movie-poster" alt="poster" src="{{ asset('i/poster.png')}}">
                    <h3 class="conf-step__movie-title">Движение вбок</h3>
                    <p class="conf-step__movie-duration">95 минут</p>
                </div>

                <div class="conf-step__movie">
                    <img class="conf-step__movie-poster" alt="poster" src="{{ asset('i/poster.png')}}">
                    <h3 class="conf-step__movie-title">Кот Да Винчи</h3>
                    <p class="conf-step__movie-duration">100 минут</p>
                </div>
            </div>

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
    </section>

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
    function cl(id){
        console.log(id);
        document.getElementById(id).closest('.conf-step');
        console.log(document.getElementById(id).closest('.conf-step'));
        console.log(document.getElementById(id).closest('.conf-step').children[2]);
        /*document.getElementById(id).closest('.conf-step').children[2].style.display = "block";
        document.getElementById(id).closest('.conf-step').children[2].style.position = "absolute";
        document.getElementById(id).closest('.conf-step').children[2].style.width = "50%";
        document.getElementById(id).closest('.conf-step').children[2].style.height = "70%";
         */
        document.getElementById(id).closest('.conf-step').children[2].classList.add("active");
    }
</script>

<script>
    function clickRadio(id){
        console.log('clickradio', id);
        ///console.log(document.querySelectorAll('div.conf-step__legend'));
        //console.log(document.querySelectorAll('p.conf-step__paragraph'));
       // console.log(document.querySelectorAll('.conf-step__input'));

        //document.getElementsByClassName('.conf-step__chair_standart');
        //console.log(document.getElementsByClassName('conf-step__chair_standart'));
        console.log(document.getElementById('countNormal'));
        document.getElementById('countNormal').value = '{{$hall->countNormal}}';
        document.getElementById('countVip').value = '{{$hall->countVip}}';
        //console.log(document.getElementById('conf-step__chair_standart').closest('.conf-step__label').children);
       // document.getElementById('conf-step__chair_standart').closest('.conf-step__label').children[0].value = $hall->countNormal;

       // console.log(document.getElementById('conf-step__chair_vip').closest('.conf-step__label').children);
       // document.getElementById('conf-step__chair_vip').closest('.conf-step__label').children[0].value = '$hall->countVip';

        //document.getElementById(id).closest('.conf-step').children[2].classList.add("active");
    }
</script>

<script>
    let input = document.querySelectorAll('.count');
    let count = [];
    console.log(input);
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

    // let url = "{{route('admin.updateHall', ['hall'=> $hall, 'count' => 'json'])}}";
    // url = url.replace('json', json);
    // url = url.replaceAll('&amp;', '&');
   // console.log('replaceed amp url  ', url);

    //window.location.href= url;

</script>


<script>
    function clickUpdate(id){
        console.log('clickradio', id);
        const json=JSON.stringify(count);

        let url = "{{route('admin.updateHall', ['hall'=> $hall, 'count' => 'json'])}}";
        url = url.replace('json', json);
        url = url.replaceAll('&amp;', '&');
        console.log('replaceed amp url  ', url);
        //window.location.href= url;

    }
</script>
{{--}}
<script>
    let input1 = document.getElementById('countNormal');

   /*class Menu {
        handleEvent(event) {
            switch(event.type) {
                case 'change':
                    input1.removeEventListener('input', menu);
                    break;
                case 'input':
                    document.getElementById('countNormal').value = input1.value;
                    break;
            }
        }
    }

    let menu = new Menu();
    input1.addEventListener('input', menu);
    input1.addEventListener('change', menu);
*/


    //let input2 = document.getElementById('countVip');
    console.log(input1);
    //console.log(input2);
    input1.oninput = function() {
        document.getElementById('countNormal').value = input1.value;
        console.log(document.getElementById('countNormal').value, input1.value);
    };
    /*input1.onchange = function() {
       alert("true");
    };
    /*input1.oninput = function() {
        document.getElementById('countVip').value = input2.value;
        console.log(document.getElementById('countVip').value, input2.value);
    };*/
</script>

--}}
{{--}}
<script>
    let input2 = document.getElementById('countVip');

    console.log(input2);
    input1.oninput = function() {
        document.getElementById('countVip').value = input2.value;
        console.log(document.getElementById('countVip').value, input2.value);
    };
</script>
--}}
{{--}}
<script>
    let input1 = document.getElementById('countNormal');
    let input2 = document.getElementById('countVip');

    function handleClick(event) {
        //const input = inputs.item(inputPosition);
        //const submittedValue = event.target.innerHTML;
            input2.value = event.target.value;
    }
    input1.addEventListener("input", (event)=> input1.value = event.target.value);
    input2.addEventListener("input", handleClick);
    </script>
--}}


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
