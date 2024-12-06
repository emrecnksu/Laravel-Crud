<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <title>Edit Product</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-warning">
        <div class="container-fluid">
            <a class="navbar-brand h1" href="{{ route('products.index') }}">Ürünler</a>
            @if(Auth::check())
                <div class="row justify-content-end">
                    <div class="col-auto">
                        <a class="btn btn-sm btn-success me-2" href="{{ route('products.create') }}">Ürün Ekle</a>
                    </div>
                    <div class="col-auto">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger">Çıkış Yap</button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </nav>
    
    <div class="container h-100 mt-5">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-10 col-md-8 col-lg-6">
                @if($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->all()[0] }}
                    </div>
                @endif

                <h3>Güncellenecek Ürün Detayı</h3>
                <form action="{{ route('products.update', $product->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="product_name">Ürün İsmi</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" value="{{ $product->product_name }}">
                    </div>
                    <div class="form-group">
                        <label for="product_price">Ürün Fiyatı</label>
                        <input type="number" class="form-control" id="product_price" name="product_price" value="{{ $product->product_price }}">
                    </div>
                    <div class="form-group">
                        <label for="description">Açıklama</label>
                        <textarea class="form-control" id="description" name="description" rows="3" >{{ $product->description }}</textarea>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Ürünü Güncelle</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
