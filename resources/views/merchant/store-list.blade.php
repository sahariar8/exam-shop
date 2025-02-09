@extends('layouts.app')

@section('title', 'Store List')

@section('content')
<h2>My Stores</h2>
<a href="{{ route('merchant.store.create') }}" class="btn btn-success mb-3">+ Create Store</a>

@if($stores->isEmpty())
    <p class="alert alert-warning">No stores found. Create a new store to start selling!</p>
@else
<table class="table table-striped">
    <thead>
        <tr>
            <th>Store Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($stores as $store)
        <tr>
            <td>{{ $store->name }}</td>
            <td>
                <a href="{{ route('shop.page', $store->name) }}" class="btn btn-info btn-sm">View Store</a>
                <a href="{{ route('merchant.store.edit', $store) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('merchant.store.destroy', $store) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection
