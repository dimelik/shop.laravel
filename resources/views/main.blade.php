@extends('layouts/master')

@section('title', 'Главная')

@section('content')
    <form method="GET" action="{{route("index")}}">
        <div class="filters row">
            <div class="col-sm-6 col-md-3">
                <label for="price_from"> Цена от
{{--                    @lang('main.price_from')--}}
                    <input type="text" name="price_from" id="price_from" size="6" value="{{ request()->price_from}}">
                </label>
                <label for="price_to"> до
{{--                    @lang('main.to')--}}
                    <input type="text" name="price_to" id="price_to" size="6"  value="{{ request()->price_to }}">
                </label>
            </div>
            <div class="col-sm-2 col-md-2">
                <label for="hit">
                  <input type="checkbox" name="hit" id="hit" @if(request()->has('hit')) checked @endif> Хит
{{--                    @lang('main.properties.hit')--}}
                </label>
            </div>
            <div class="col-sm-2 col-md-2">
                <label for="new">
                    <input type="checkbox" name="new" id="new" @if(request()->has('new')) checked @endif> Новинка
{{--                    @lang('main.properties.new')--}}
                </label>
            </div>
            <div class="col-sm-2 col-md-2">
                <label for="recommend">
                    <input type="checkbox" name="recommend" id="recommend" @if(request()->has('recommend')) checked @endif> Рекомендуем
{{--                    @lang('main.properties.recommend')--}}
                </label>
            </div>
            <div class="col-sm-6 col-md-3">
                <button type="submit" class="btn btn-primary"> Фильтр
{{--                    @lang('main.filter')--}}
                </button>
                <a href="{{ route("index") }}" class="btn btn-warning">Сброс
{{--                    lang('main.reset')--}}
                </a>
            </div>
        </div>
    </form>
        <h1>Все товары</h1>
        <div class="row">
            @foreach ($products as $product)

            @include('layouts.card', compact('product'))

            @endforeach
        </div>
    {{ $products->links() }}
@endsection
