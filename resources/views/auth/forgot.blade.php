@extends('structure')

@section('title', 'EyeBall.kz - Восстановление пароля')

@section('container')
    <div class="container" id="authorization">
        <h3>Восстановление пароля</h3>

        @if($errors->any())
            <div>
                <ul style="background-color: #FAEBD7; padding: 15px 40px;">
                    @foreach($errors->all() as $error)
                        <li style="text-align: left; color: #A65353;">{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{route('forgot_process')}}">
            @csrf
            <h4 style="padding: 0; margin: 5px 0 25px 0;">Сброс пароля:</h4>
            <input type="email" name="email" placeholder="E-mail">

            <a href="{{route('login')}}" style="margin: 0 5px;">Вспомнили пароль?</a>
            <br>
            <button type="submit" style="margin: 10px 0;">Сбросить</button>
        </form>
    </div>
@endsection
