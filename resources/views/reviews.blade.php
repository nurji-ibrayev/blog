@extends('structure')

@section('title')Eyeball.kz - Отзывы@endsection

@section('container')
    <div class="container" id="reviews">
        <h3>Отзывы</h3>

        @foreach($reviews as $review)
            <div style="text-align: left">
                <b>{{$review->name}}</b>
                <span style="color: #999999;">{{$review->created_at->format('d.m.Y H:i')}}</span><br>
                @if(!$review->hide_email)
                    <span>{{$review->email}}</span><br>
                @endif

                @for($i = 0; $i < $review->rating; $i++)
                    <span style="color: #FF6600;">★</span>
                @endfor

                @for($i = 0; $i < 5 - $review->rating; $i++)
                    <span style="color: #E3E3E3;">★</span>
                @endfor
                <p>{{$review->message}}</p>
                <hr style="height: 1px; border: none; color: #E7E7E7; background-color: #E7E7E7;">
            </div>
        @endforeach
        <br>

        @if($errors->any())
            <div>
                <ul style="background-color: #FAEBD7; padding: 15px 40px;">
                    @foreach($errors->all() as $error)
                        <li style="text-align: left; color: #FF0000;">{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="/reviews/review_check">
            @csrf
            <h4 style="padding: 0; margin: 5px 0 25px 0;">Написать отзыв:</h4>
            <label>Имя:</label>
            <input type="text" name="name" placeholder="Введите свое имя">
            <label>E-mail:</label>
            <div style="display: inline-block; width: 100%;">
                <input type="email" name="email" placeholder="Введите ваш e-mail" style="width: 55vw;">
                <input type="hidden" name="hide_email" value="0">
                <input type="checkbox" name="hide_email" value="1" style="width: 20px; height: 20px; margin: 0 3px 0 15px;">
                <label style="vertical-align: middle; margin: 0;">Скрыть e-mail</label>
            </div>
            <label>Ваша оценка:</label>
            <input type="number" name="rating" placeholder="Оцените от 1 до 5" min="1" max="5">
            <label>Текст отзыва:</label>
            <textarea name="message" placeholder="Напишите текст отзыва" style="resize: vertical;"></textarea>
            <button type="submit" style="margin: 5px 0;">Отправить</button>
        </form>
        <br>
    </div>
@endsection
