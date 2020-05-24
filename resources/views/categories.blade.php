@extends('layouts/master')

@section('title', 'Все категории')

@section('content')
        @foreach ($categories as $item)
        <div class="panel">
            <a href="{{route('category', $item->code)}}">
                <img src="Storage::url($category->index)">
                <h2>{{$item->name}}</h2>
            </a>
            <p>
                {{$item->description}}
            </p>
        @endforeach
    </div>
@endsection
