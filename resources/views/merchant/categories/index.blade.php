@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Manage Categories</h2>
    <a href="{{ route('merchant.category.create') }}" class="btn btn-primary">Create Category</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Store</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>{{ $category->store->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
