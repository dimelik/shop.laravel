@extends('master')

@section('title', 'Главная')

@section('content')

    <div class="starter-template">
        <h1>Все товары</h1>
        <div class="row">
            @foreach ($products as $product)

            @include('card', compact('product'))

            @endforeach
        </div>
    </div>
    <nav>
        <ul class="pagination">

            <li class="page-item disabled" aria-disabled="true" aria-label="pagination.previous">
                <span class="page-link" aria-hidden="true">&lsaquo;</span>
            </li>


            <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>
            <li class="page-item"><a class="page-link" href="?&amp;page=2">2</a></li>


            <li class="page-item">
                <a class="page-link" href="?&amp;page=2" rel="next" aria-label="pagination.next">&rsaquo;</a>
            </li>
        </ul>
    </nav>

    </div>
@endsection
