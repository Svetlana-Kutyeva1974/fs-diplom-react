<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Авторизация | ИдёмВКино</title>
    <link rel="stylesheet" href="{{ asset('css/normalizeAdmin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylesAdmin.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
</head>

<body>

<header class="page-header">
    <h1 class="page-header__title">Идём<span>в</span>кино</h1>
    <span class="page-header__subtitle">Администраторррская</span>
</header>

<main>
    <section class="login">
        <header class="login__header">
            <h2 class="login__title">Авторизация</h2>
        </header>
        <div class="login__wrapper">
            <form class="login__form" action="{{ '/' }}" method="POST" accept-charset="utf-8">
                @csrf
                <label class="login__label" for="email">
                    {{ __('Email Address') }}
                    <input class="login__input" type="email" placeholder="example@domain.xyz" name="email" required>
                </label>
                <label class="login__label" for="password">
                    {{ __('Password') }}
                    <input id="password" class="login__input" type="password" placeholder="" name="password" required autocomplete="current-password">
                </label>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary login__button">
                        <!--{{ __('Login') }}-->Авторизоваться
                    </button>
                   <!--<input value="Авторизоваться" type="submit" class="login__button">-->
                </div>
            </form>
        </div>
    </section>
</main>

<script src="js/accordeon.js"></script>
</body>
</html>
