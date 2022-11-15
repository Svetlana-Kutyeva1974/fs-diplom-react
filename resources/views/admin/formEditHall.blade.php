@extends('layouts.header')
@section('content')
            <form class="login__form" action="{{ 'login' }}" method="POST" accept-charset="utf-8">
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
@endsection
