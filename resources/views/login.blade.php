<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Kullanıcı Giriş</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center cont-a">
            <div class="col-md-6">
                <div class="container-bg p-4 rounded shadow">
                    @if(session('error'))
                        <div class="alert alert-danger mt-3">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if($errors->has('firstError'))
                        <div class="alert alert-danger">
                            {{ $errors->first('firstError') }}
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success mt-3">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('login') }}" method="POST" id="userForm" class="needs-validation">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">E-Posta</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Şifre</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mt-3">Giriş</button>
                        <div class="mt-3 text-center">
                            <p class="mb-0">Hesabınız yok mu? <a href="{{ route('register') }}" class="btn btn-link">Kayıt olun</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
