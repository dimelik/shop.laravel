@extends('layouts/master')

@section('title', 'Товар')

@section('content')
    <h1>{{$product->name}}</h1>
    <h2>{{$product->category->name}}</h2>
    <p>Цена: <b>{{$product->price}} {{ App\Services\CurrencyConversion::getCurrencySymbol() }}</b></p>
    <img src="{{Storage::url($product->image)}}">
    <p>{{$product->description}}</p>
    @if($product->isAvailable())
        <form action="{{route('basket-add', $product->id)}}" method="POST">
            <button type="submit" class="btn btn-success" role="button">Добавить в корзину</button>

            @csrf
        </form>
    @else
        <span>Не доступен</span>
        <br>
        <span>Сообщить, когда появится в наличии:</span>
        <div class="warning">
        @if($errors->get('email'))
                {{$errors->get('email')[0]}}
            @endif
        </div>
        <form method="POST" action="{{route('subscription', $product)}}">
            @csrf
            <input type="text" name="email">
            <button type="submit" role="button">Отправить</button>
        </form>
    @endif
@endsection


