<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Paneli</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

    <div class="container">
        <div class="card mt-5">
            <div class="card-body">
                <h1 class="card-title">Admin Paneli</h1>
                <p class="card-text">Hoşgeldiniz, {{ Auth::user()->name }}</p>
                <div class="d-flex justify-content-end">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Çıkış</button>
                    </form>
                </div>
                <div class="d-flex justify-content-start mt-3">
                    <form action="{{ route('categories.index') }}" method="GET" class="mr-2">
                        @csrf
                        <button type="submit" class="btn btn-success">Kategorilere Git</button>
                    </form>
                    <form action="{{ route('products.index') }}" method="GET">
                        @csrf
                        <button type="submit" class="btn btn-danger">Ürünlere Git</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
