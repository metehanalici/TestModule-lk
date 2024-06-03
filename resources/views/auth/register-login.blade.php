<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module Test Case</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    
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

    <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="true">Kayıt</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="false">Giriş</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="categories-tab" data-toggle="tab" href="#categories" role="tab" aria-controls="categories" aria-selected="false">Kategoriler</a>
        </li>
    </ul>

    <div class="tab-content mt-4" id="myTabContent">
        <div class="tab-pane fade show active" id="register" role="tabpanel" aria-labelledby="register-tab">
            <form method="POST" action="{{ route('register') }}" class="mx-auto p-4 bg-light rounded shadow-sm" style="max-width: 400px;">
                @csrf
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="tel" name="phone" class="form-control" placeholder="Phone" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Kayıt</button>
            </form>
        </div>
        <div class="tab-pane fade" id="login" role="tabpanel" aria-labelledby="login-tab">
            <form method="POST" action="{{ route('login') }}" class="mx-auto p-4 bg-light rounded shadow-sm" style="max-width: 400px;">
                @csrf
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Giriş</button>
            </form>
        </div>
        <div class="tab-pane fade" id="categories" role="tabpanel" aria-labelledby="categories-tab">
            <h2>Kategoriler</h2>
            <div class="row">
                @foreach($categories as $category)
                <div class="col-md-6">
                    <div class="card text-end mb-3">
                        <div class="card-header">
                            <h4>Kategori : {{ $category->name }}</h4>
                        </div>
                        <div class="card-body">
                            @foreach($productsByCategory[$category->name] as $product)
                            <div class="card mb-3">
                                @if($product->image)
                                <img src="{{ asset($product->image) }}" alt="Product Image" class="card-img-top img-fluid rounded-circle me-3" style="border-radius: 50%; border: 10px solid whitesmoke; width: 200px;">
                                @else
                                <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Default Image" class="card-img-top img-fluid rounded-circle me-3" style="border-radius: 50%; border: 10px solid whitesmoke; width: 100px;">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">Ürün Adı : {{ $product->name }}</h5>
                                    <p class="card-text">Ürün açıklaması : {{ $product->description }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
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
