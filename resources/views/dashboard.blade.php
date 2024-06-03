<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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

        <h1>Kullanıcı Paneli</h1>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="cart-counter">
                <button class="btn btn-primary" data-toggle="modal" data-target="#cartModal">
                    Sepet <span id="cart-count" class="badge badge-light">0</span>
                </button>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Çıkış</button>
            </form>
        </div>

        <p>Hoşgeldiniz, {{ Auth::user()->name }}</p>

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
                                <button class="btn btn-success btn-sm add-to-cart" data-product-id="{{ $product->id }}" data-product-name="{{ $product->name }}">Sepete ekle</button>
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

    <!-- Cart Modal -->
    <div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cartModalLabel">Sepetiniz</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul id="cart-items" class="list-group">
                        <!-- Cart items will be added here dynamically -->
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let cart = [];
            const cartCount = document.getElementById('cart-count');
            const cartItems = document.getElementById('cart-items');

            function updateCart() {
                cartCount.textContent = cart.length;
                cartItems.innerHTML = '';

                cart.forEach((item, index) => {
                    const listItem = document.createElement('li');
                    listItem.classList.add('list-group-item', 'd-flex', 'justify-content-between', 'align-items-center');
                    listItem.innerHTML = `
                        ${item.name}
                        <button class="btn btn-danger btn-sm remove-from-cart" data-index="${index}">Sepetten çıkar</button>
                    `;
                    cartItems.appendChild(listItem);
                });

                document.querySelectorAll('.remove-from-cart').forEach(button => {
                    button.addEventListener('click', function () {
                        const index = this.getAttribute('data-index');
                        cart.splice(index, 1);
                        updateCart();
                    });
                });
            }

            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', function () {
                    const productId = this.getAttribute('data-product-id');
                    const productName = this.getAttribute('data-product-name');
                    cart.push({ id: productId, name: productName });
                    updateCart();
                });
            });
        });
    </script>
</body>
</html>
