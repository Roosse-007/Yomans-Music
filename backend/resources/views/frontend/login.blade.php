<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - YomansMusic</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to bottom, #131614, #000);
            color: white;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-box {
            background: #1e1e1e;
            padding: 2rem;
            border-radius: 12px;
            width: 100%;
            max-width: 400px;
        }
        .btn-primary {
            background: #1DB954;
            border: none;
        }
        .btn-primary:hover {
            background: #1ed760;
        }
        a {
            color: #1DB954;
            text-decoration: none;
        }
    </style>
</head>
<body>

@if (session('success'))
<div class="alert alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show">
    {{ session('error') }}
    <button class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif


<div class="login-box">
    <h3 class="text-center mb-4">Login YomansMusic</h3>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- ✅ LOGIN SESSION -->
    <form method="POST" action="/login">
        @csrf

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button class="btn btn-primary w-100" type="submit">
            Login
        </button>
    </form>

    <hr class="my-3">

    <p class="text-center mb-0">
        Belum punya akun?
        <a href="{{ route('register') }}">Daftar di sini</a>
    </p>
</div>

</body>
</html>
