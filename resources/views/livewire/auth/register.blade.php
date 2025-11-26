<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduTask — Register</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('scss/style.css') }}">
</head>

<body class="register-page">

    <section class="register-container">
        <h2 class="text-center">Daftar Akun Baru</h2>
        <p class="text-center text-light">Buat akun untuk mulai mengelola tugas kamu.</p>

        <form action="{{ route('register.submit') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label class="form-label text-light">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control register-input"
                               placeholder="Masukkan Nama" required value="{{ old('name') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-light">Email</label>
                        <input type="email" name="email" class="form-control register-input"
                               placeholder="Masukkan Email" required value="{{ old('email') }}">
                    </div>
                </div>

                <div class="col-6">
                    <div class="mb-3">
                        <label class="form-label text-light">Password</label>
                        <input type="password" name="password"
                               class="form-control register-input" placeholder="Masukkan Password" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-light">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation"
                               class="form-control register-input" placeholder="Ulangi Password" required>
                    </div>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <button type="submit" class="btn btn-register-submit w-100 mt-3">
                Daftar <i class="bi bi-person-plus-fill ms-1"></i>
            </button>

            <p class="text-center mt-4 text-light">
                Sudah punya akun? <a href="{{ route('login') }}" class="text-light"><b>Login</b></a>
            </p>
        </form>
    </section>

</body>
</html>
