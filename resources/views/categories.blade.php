@extends('master')

@section('title', 'Все категории')

@section('content')
    <div class="starter-template">
        @foreach ($categories as $item)
        <div class="panel">
            <a href="{{route('category', $item->code)}}">
                <img src="http://internet-shop.tmweb.ru/storage/categories/mobile.jpg">
                <h2>{{$item->name}}</h2>
            </a>
            <p>
                {{$item->description}}
            </p>
        </div>
        @endforeach
    </div>
@endsection
