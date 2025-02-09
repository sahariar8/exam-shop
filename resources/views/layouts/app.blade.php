<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merchant Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            background: #343a40;
            color: white;
            padding: 20px;
            height: 100vh;
            position: fixed;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .sidebar a:hover {
            background: #495057;
        }
        .content {
            margin-left: 270px;
            padding: 20px;
            width: 100%;
        }
        .logout-btn {
            background: red;
            color: white;
            padding: 10px;
            border: none;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
        }
        .logout-btn:hover {
            background: darkred;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h3>Merchant Panel</h3>
    <a href="{{ route('merchant.dashboard') }}">🏠 Dashboard</a>
    <a href="{{ route('merchant.store.list') }}">🏪 Manage Stores</a>
    <a href="{{ route('merchant.category.list') }}">📂 Manage Categories</a>
    <a href="{{ route('merchant.product.list') }}">📦 Manage Products</a>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="logout-btn">🚪 Logout</button>
    </form>
</div>

<div class="content">
    @yield('content')
</div>

</body>
</html>
