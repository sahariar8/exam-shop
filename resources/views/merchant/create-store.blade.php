@extends('layouts.app')

@section('title', 'Create Store')

@section('content')
<div class="card mx-auto" style="max-width: 500px;">
    <div class="card-header">Create a New Store</div>
    <div class="card-body">
        <form method="POST" action="{{ route('merchant.store.store') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Store Name</label>
                <input type="text" id="name" name="name" class="form-control" required placeholder="Enter store name">
            </div>
            <button type="submit" class="btn btn-primary w-100">Create Store</button>
        </form>
    </div>
</div>
@endsection
