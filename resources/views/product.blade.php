@extends('layouts/master')

@section('title', 'Товар')

@section('content')
    <h1>{{$product->name}}</h1>
    <h2>{{$product->category->name}}</h2>
    <p>Цена: <b>{{$product->price}} rub</b></p>
    <img src="{{Storage::url($product->image)}}">
    <p>{{$product->description}}</p>
    @if($product->isAvailable())
        <form action="{{route('basket-add', $product->id)}}" method="POST">
            <button type="submit" class="btn btn-success" role="button">Добавить в корзину</button>

            @csrf
            @else
                Не доступен
    @endif
@endsection


