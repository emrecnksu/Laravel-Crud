<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Kullanıcı Kayıt</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="container-bg p-4 rounded shadow">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->all()[0] }}
                        </div>
                    @endif
                
                    <form action="{{ route('register') }}" method="POST" id="userForm" class="needs-validation">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Ad</label>
                            <input type="text" class="form-control" id="name" name="name" >
                        </div>
                        <div class="mb-3">
                            <label for="surname" class="form-label">Soyad</label>
                            <input type="text" class="form-control" id="surname" name="surname" >
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">E-Posta</label>
                            <input type="email" class="form-control" id="email" name="email" >
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Şifre</label>
                            <input type="password" class="form-control" id="password" name="password" >
                        </div>
                        <div class="mb-3">
                            <label for="passwordRepeat" class="form-label">Şifre Tekrarı</label>
                            <input type="password" class="form-control" id="passwordRepeat" name="password_confirmation" >
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Kayıt Ol</button>
                    </form>
                    <div class="mt-3 text-center">
                        <p>Hesabınız var mı? <a href="{{ route('login') }}" class="btn btn-link">Giriş Yapın</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

  </html>
