<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduTask — Login</title>

    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('scss/style.css') }}">
</head>

<body class="login-page">

    <!-- LOGIN FORM -->
    <section class="login-container">
        <h2 class="text-center mb-4 fw-bold text-white">Selamat Datang</h2>
        <p class="text-center text-light">Masuk untuk melanjutkan ke dashboard kamu</p>

        <form action="{{ route('login.submit') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label text-light">Email</label>
                <input type="email" name="email" class="form-control login-input"
                       placeholder="Masukkan Email" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-light">Password</label>
                <input type="password" name="password" class="form-control login-input"
                       placeholder="Masukkan Password" required>
            </div>

            <!-- Error message -->
            @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    {{ $errors->first() }}
                </div>
            @endif

            <button type="submit" class="btn btn-login-submit w-100 mt-3">
                Login <i class="bi bi-box-arrow-in-right ms-1"></i>
            </button>

            <p class="text-center mt-4 text-light">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-light"><b>Register</b></a>
            </p>

        </form>
    </section>

</body>
</html>
