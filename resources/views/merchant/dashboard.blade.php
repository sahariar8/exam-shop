@extends('layouts.app')

@section('title', 'Merchant Dashboard')

@section('content')
<h2>Merchant Dashboard</h2>
<a href="{{ route('merchant.store.create') }}" class="btn btn-primary mb-3">Create Store</a>
<table class="table">
    <thead>
        <tr><th>Store Name</th><th>Actions</th></tr>
    </thead>
    <tbody>
        @foreach($stores as $store)
        <tr>
            <td>{{ $store->name }}</td>
            <td>
                <a href="{{ route('shop.page', $store->name) }}" class="btn btn-info btn-sm">View Store</a>
                <form action="{{ route('merchant.store.destroy', $store) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
