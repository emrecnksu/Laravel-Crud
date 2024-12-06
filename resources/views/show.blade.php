<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <title>Product Details</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-warning">
        <div class="container-fluid">
            <a class="navbar-brand h1" href="{{ route('products.index') }}">Ürünler</a>
            @if(Auth::check())
                <div class="row justify-content-end">
                    <div class="col-auto">
                        <a class="btn btn-sm btn-success mb-2" href="{{ route('products.create') }}">Ürün Ekle</a>
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
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title fw-bold">{{ $product->product_name }}</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Fiyatı: {{ $product->product_price }}</p>
                        <p class="card-text">{{ $product->description }}</p>
                    </div>
                    <div class="card-footer">
                        @if(Auth::check())
                            <div class="row">
                                <div class="col-sm">
                                    <a href="{{ route('products.edit', $product->id) }}"
                                        class="btn btn-primary btn-sm">Düzenle</a>
                                </div>
                                <div class="col-sm">
                                    <form action="{{ route('products.destroy', $product->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Sil</button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <p>CRUD işlemleri yapabilmek için giriş yapmalısınız.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</body>

</html>
