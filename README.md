## Дипломное задание по профессии "Веб-разработчик"
### Создание «информационной системы для администрирования залов, сеансов и предварительного бронирования билетов».

#### Проект реализован в Laravel 8 с применением component Laravel, с использованием возможностей включения js, php кода, пакета phpqrcod

### Сущности

#### Кинозал ( таблица halls) 
Помещение, в котором демонстрируются фильмы. Режим работы определяется расписанием на день. 
Зал - прямоугольный, состоит из N * M различных зрительских мест.

`Schema::create('halls', function (Blueprint $table) {
$table->id();
$table->timestamps();
$table->string('nameHall');
$table->integer('col')->default(12);;
$table->integer('row')->default(10);;
$table->integer('countVip')->default(1000);;
$table->integer('countNormal')->default(500);;
$table->json('typeOfSeats')->default(json_encode(["1,1"=>"NORM","1,2"=>"FAIL","1,3"=> "NORM", "1,4"=>"NORM","1,5"=>"FAIL","1,6"=> "NORM", "1,7"=>"NORM","1,8"=>"FAIL","1,9"=> "NORM","1,10"=>"NORM","1,11"=>"FAIL","1,12"=> "NORM", "2,1"=>"NORM","2,2"=>"FAIL","2,3"=> "NORM", "2,4"=>"NORM","2,5"=>"FAIL","2,6"=> "NORM", "2,7"=>"NORM","2,8"=>"FAIL","2,9"=> "NORM","2,10"=>"NORM","2,11"=>"FAIL","2,12"=> "NORM", "3,1"=>"NORM","3,2"=>"FAIL","3,3"=> "NORM", "3,4"=>"NORM","3,5"=>"FAIL","3,6"=> "NORM", "3,7"=>"NORM","3,8"=>"FAIL","3,9"=> "NORM","3,10"=>"NORM","3,11"=>"FAIL","3,12"=> "NORM","4,1"=>"NORM","4,2"=>"FAIL","4,3"=> "NORM", "4,4"=>"NORM","4,5"=>"FAIL","4,6"=> "NORM", "4,7"=>"NORM","4,8"=>"FAIL","4,9"=> "NORM","4,10"=>"NORM","4,11"=>"FAIL","4,12"=> "NORM","5,1"=>"NORM","5,2"=>"FAIL","5,3"=> "NORM", "5,4"=>"NORM","5,5"=>"FAIL","5,6"=> "NORM", "5,7"=>"NORM","5,8"=>"FAIL","5,9"=> "NORM","5,10"=>"NORM","5,11"=>"FAIL","5,12"=> "NORM","6,1"=>"NORM","6,2"=>"FAIL","6,3"=> "NORM", "6,4"=>"NORM","6,5"=>"FAIL","6,6"=> "NORM", "6,7"=>"NORM","6,8"=>"FAIL","6,9"=> "NORM","6,10"=>"NORM","6,11"=>"FAIL","6,12"=> "NORM", "7,1"=>"NORM","7,2"=>"FAIL","7,3"=> "NORM", "7,4"=>"NORM","7,5"=>"FAIL","7,6"=> "NORM", "7,7"=>"NORM","7,8"=>"FAIL","7,9"=> "NORM","7,10"=>"NORM","7,11"=>"FAIL","7,12"=> "NORM", "8,1"=>"NORM","8,2"=>"FAIL","8,3"=> "NORM", "8,4"=>"NORM","8,5"=>"FAIL","8,6"=> "NORM", "8,7"=>"NORM","8,8"=>"FAIL","8,9"=> "NORM","8,10"=>"NORM","8,11"=>"FAIL","8,12"=> "NORM", "9,1"=>"NORM","9,2"=>"FAIL","9,3"=> "NORM", "9,4"=>"NORM","9,5"=>"FAIL","9,6"=> "NORM", "9,7"=>"NORM","9,8"=>"FAIL","9,9"=> "NORM","9,10"=>"NORM","9,11"=>"FAIL","9,12"=> "NORM", "10,1"=>"NORM","10,2"=>"FAIL","10,3"=> "NORM", "10,4"=>"NORM","10,5"=>"FAIL","10,6"=> "NORM", "10,7"=>"NORM","10,8"=>"FAIL","10,9"=> "NORM","10,10"=>"NORM","10,11"=>"FAIL","10,12"=> "NORM"]));
$table->boolean('open')->default(0);
});`


Вместо двумерного массива мест зала (i- ряд, j- место) работа всегда с одномерным ассоциативным массивом, где ключ - типа string- идентификатор места и ряда в формате "i,j" (i- ряд, j- место)


#### Зрительское место ( таблица seats)
Место в кинозале. Зрительские места могут быть VIP - VIP(обозначение в коде -VIP), STANDART - обычные (обозначение в коде -NORM), DISABLED - неиспользуемые(обозначение в коде -FAIL).

`Schema::create('seats', function (Blueprint $table) {
$table->id();
$table->timestamps();
$table->boolean('free')->default(true);
$table->integer('colNumber');
$table->integer('rowNumber');
$table->integer('hall_id');
$table->integer('ticket_id')->default(0);
$table->integer('seance_id');
});`

#### Фильм ( таблица films)
Информация о фильме заполняется администратором. Фильм связан с сеансом в кинозале.

`Schema::create('films', function (Blueprint $table) {
$table->id();
$table->timestamps();//->unique();
$table->string('title');
$table->string('description');
$table->string('duration');
$table->string('origin');
$table->string('imagePath');
$table->string('imageText');
});`

#### Сеанс ( таблица seances)
Сеанс - это временной промежуток, в котором в кинозале будет показываться фильм. На сеанс могут быть забронированы билеты.

`Schema::create('seances', function (Blueprint $table) {
$table->id();
$table->timestamps();
$table->dateTime('startSeance');
$table->integer('hall_id');
$table->integer('film_id');
});`

#### Билет ( таблица tickets)
Право посещения сеанса в кинозале. В билете обязательно указаны место, ряд, сеанс, qr-код c уникальным кодом бронирования. Билет действителен строго на свой сеанс.

`Schema::create('tickets', function (Blueprint $table) {
$table->id();
$table->timestamps();
$table->string('qrCod');//
$table->integer('count');
$table->integer('film_id');
$table->integer('seance_id');
});`

#### Пользователь ( таблица users)
Авторизованный или неавторизованный пользователь с name, email, password

`Schema::create('users', function (Blueprint $table) {
$table->id();
$table->string('name');
$table->string('email')->unique();
$table->timestamp('email_verified_at')->nullable();
$table->string('password');
$table->rememberToken();
$table->boolean('is_admin')->default(0);
$table->timestamps();
});`

### Роли пользователей системы
* Администратор +
* Гость +

### Возможности администратора
* Создание/редактирование залов +\-
* Создание/редактирование фильмов +\-
* Настройка цен +\-
* Создание/редактирование расписания -

### Возможности пользователя
* Просмотр расписания +
* Просмотр фильмов +
* Выбор места в кинозале +
* Бронирование билета +

### РЕАЛИЗОВАНО
### ---------------------
#### Клиентская часть: 
* Календарь обеспечивает показ сетки сеансов на 2 недели </>
* Показ сетки сеансов в залах.
* При выборе сеанса - переход на страницу выбора мест (1 и более )(щелчок левой клавиши -выбор). 
* Кнопка забронировать - переход на страницу показа билета
* Показ билета с qr кодом ( phpqrcod). Закодирована строка: Фильм+зал+ряд и место+время сеанса

#### Административная часть:
* Показ формы добавления зала +
* Удаление зала с подтверждением +
* Выбор зала, Настройка цен (без сохранения пока)
* Настройка конфигурации, визуализация только выполнена с изменением типов мест (без сохранения пока)

### Выполнена вставка\верстка недостающих элементов системы с использованием html+css:
#### Форма авторизации на отдельной странице +

* Поле ввода "email"
* Поле ввода "Пароль"
* Кнопка "Авторизоваться"

#### Форма "добавления зала" в попапе +

* Поле ввода "Название зала"
* Кнопка "Добавить зал"
* Кнопка "Отменить"

#### Подтверждение "удаления зала" в confirm+/попапе
(можно ли без попап обойтись? confirm сейчас)
* Кнопка "Удалить"
* Кнопка "Отменить"

#### Форма добавления фильма в попапе

* Поле ввода "Название фильма"
* Поле ввода "Описание фильма"
* Поле ввода "Страна фильма"
* Поле ввода "Длительность фильма"
* Поле ввода "Ссылка на изображение" +\-(вопрос по загрузке изображения)
* Кнопка "Добавить фильм"
* Кнопка "Отменить"

### ------------------

### Будет добавлена верстка недостающих элементов системы с использованием html+css:

#### Форма назначения сеанса для фильма:

При перетаскивании фильма в зал должна открываться форма в попапе
Селектор "Зал"(по умолчанию значение из результатов drag&drop)
Поле ввода "Время начала" (по возможности использовать маску ввода в формате 00:00)

* Кнопка "Добавить"
* Кнопка "Отменить"
  (При перетаскивании фильма из зала открывать форму подтверждение "Снятие с показа")
* Кнопка "Удалить"
* Кнопка "Отменить"

#### Кнопка открытие продаж:

Пока непонятно, что по ней нужно делать

### Запуск проекта

* Выполнить composer install
* Проверить путь к БД в env.
* Сделать миграции: очистить и наполнить базу: 

* #### php artisan migrate:fresh 
* #### migration:refresh --seed

* Запустить php artisan serve

### Данные тестового пользователя-администратора:

имя пользователя: admin
почта: admin@mail.ru
пароль: admin

### Данные тестового пользователя-гостя:

имя пользователя: test
почта: test@test.ru
пароль: 12345678

Вопросы:
1. Как изображения сохранить, при создании файла (средствами php, или сторонние пакеты), этот вопрос вместе с загрузкой css,js  связан. Пока не разобралась
2. Как правильно контроллеры использовать. 
При бронировании билета: у клиента показываю просто билет с кодом, а на сервере нужно
- создать новый билет 
- изменить у выбранных мест свойсто "free" на false, т.е. выбрано
пока запуталась в порядке использования функций контроллера, которые по идее должен быть ресурсным, но я отдельно все роуты прописываю, чтобы видеть, что за что отвечает 



