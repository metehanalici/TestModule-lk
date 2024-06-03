<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yeni Kategori Ekle</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Yeni Kategori Ekle</h1>
        <form action="{{ route('categories.store') }}" method="POST" class="mb-3">
            @csrf
            <div class="form-group">
                <label for="name">Kategori Name</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Enter category name" required>
            </div>
            <button type="submit" class="btn btn-primary">Kaydet</button>
        </form>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Geri</a>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
