@extends('structure')

@section('title', 'EyeBall.kz - Авторизация')

@section('container')
    <div class="container" id="authorization">
        <h3>Авторизация</h3>

        @if($errors->any())
            <div>
                <ul style="background-color: #FAEBD7; padding: 15px 40px;">
                    @foreach($errors->all() as $error)
                        <li style="text-align: left; color: #A65353;">{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{route('login_process')}}">
            @csrf
            <h4 style="padding: 0; margin: 5px 0 25px 0;">Вход на сайт:</h4>
            <input type="email" name="email" placeholder="E-mail">
            <input type="password" name="password" placeholder="Пароль">

            <a href="{{route('register')}}">Регистрация</a>
            <a href="#" style="margin: 0 5px;">Забыли пароль?</a>
            <br>
            <button type="submit" style="margin: 10px 0;">Войти</button>
        </form>
    </div>
@endsection
