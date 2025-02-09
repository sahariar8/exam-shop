@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<h2>Admin Dashboard</h2>
<h4>Merchants</h4>
<table class="table">
    <thead>
        <tr><th>Name</th><th>Email</th></tr>
    </thead>
    <tbody>
        @foreach($merchants as $merchant)
        <tr><td>{{ $merchant->name }}</td><td>{{ $merchant->email }}</td></tr>
        @endforeach
    </tbody>
</table>
@endsection
