@extends('structure')

@section('title', 'EyeBall.kz - Регистрация')

@section('container')
    <div class="container" id="registration">
        <h3>Регистрация</h3>

        @if($errors->any())
            <div>
                <ul style="background-color: #FAEBD7; padding: 15px 40px;">
                    @foreach($errors->all() as $error)
                        <li style="text-align: left; color: #A65353;">{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{route('register_process')}}">
            @csrf
            <h4 style="padding: 0; margin: 5px 0 25px 0;">Форма регистрации:</h4>
            <input type="text" name="name" placeholder="Name">
            <input type="email" name="email" placeholder="E-mail">
            <input type="password" name="password" placeholder="Пароль">
            <input type="password" name="password_confirmation" placeholder="Подтверждение пароля">

            <a href="{{route('login')}}">Есть аккаунт?</a>
            <br>
            <button type="submit" style="margin: 10px 0;">Зарегистрироваться</button>
        </form>
    </div>
@endsection
