@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">📦 Product List</h2>
    <div class="d-flex justify-content-between mb-3">
        <h5>All Products</h5>
        <a href="{{ route('merchant.product.create') }}" class="btn btn-primary">➕ Add Product</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Store Name</th>
                <th>Category Name</th>
                <th>Product Name</th>
                <th>Product Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $index => $product)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $product->category->store->name }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td> 
                <td>
                    <a href="{{ route('merchant.product.edit', $product->id) }}" class="btn btn-sm btn-warning">✏️ Edit</a>
                    <form action="{{ route('merchant.product.destroy', $product->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">🗑️ Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
