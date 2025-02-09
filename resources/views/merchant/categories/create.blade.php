@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">🆕 Create Category</h2>
    <div class="card mx-auto shadow-sm" style="max-width: 500px;">
        <div class="card-body">
            <form action="{{ route('merchant.category.create') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Category Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter category name" required>
                </div>
                <div class="mb-3">
                    <label for="store_id" class="form-label">Select Store</label>
                    <select name="store_id" class="form-control" required>
                        <option value="">-- Select Store --</option>
                        @foreach($stores as $store)
                        <option value="{{ $store->id }}">{{ $store->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-success w-100">Create Category</button>
            </form>
        </div>
    </div>
</div>
@endsection
