@extends('layouts.app')

@section('title', $store->name)

@section('content')
<h2>{{ $store->name }}</h2>
@foreach($categories as $category)
    <h4>{{ $category->name }}</h4>
    <ul class="list-group">
        @foreach($category->products as $product)
        <li class="list-group-item">
            {{ $product->name }} - ${{ number_format($product->price, 2) }}
        </li>
        @endforeach
    </ul>
@endforeach
@endsection
