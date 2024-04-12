@extends('structure')

@section('title')Eyeball.kz - Отзывы@endsection

@section('container')
    <div class="container" id="reviews">
        <h3>Отзывы</h3>

        @if($errors->any())
            <div>
                <ul style="background-color: #FAEBD7; padding: 15px 40px;">
                    @foreach($errors->all() as $error)
                        <li style="text-align: left; color: #FF0000;">{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="/reviews/review_check" style="text-align: left">
            @csrf
            <label style="text-align: left">E-mail:</label>
            <input type="email" name="email" placeholder="Введите ваш e-mail">
            <label style="text-align: left">Заголовок отзыва:</label>
            <input type="text" name="subject" placeholder="Введите заголовок отзыва">
            <label style="text-align: left">Текст отзыва:</label>
            <textarea name="message" placeholder="Напишите текст отзыва"></textarea>
            <button type="submit">Отправить</button>
        </form>
    </div>
@endsection
