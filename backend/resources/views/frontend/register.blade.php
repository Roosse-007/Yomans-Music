<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register - YomansMusic</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: radial-gradient(circle at top, #1db954 0%, #0f2027 40%, #000 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }

        .register-card {
            width: 100%;
            max-width: 420px;
            background: rgba(17, 17, 17, 0.9);
            backdrop-filter: blur(12px);
            border-radius: 18px;
            box-shadow: 0 25px 50px rgba(0,0,0,.6);
            padding: 32px;
        }

        .brand {
            font-weight: 700;
            letter-spacing: .5px;
        }

        .brand span {
            color: #1ED760;
        }

        .form-label {
            font-size: .9rem;
            color: #bbb;
        }

        .form-control {
            background: #1c1c1c;
            border: 1px solid #333;
            color: #fff;
            padding: 12px 14px;
            border-radius: 10px;
        }

        .form-control:focus {
            background: #1c1c1c;
            border-color: #1ED760;
            box-shadow: 0 0 0 0.2rem rgba(30, 215, 96, .25);
            color: #fff;
        }

        .btn-register {
            background: linear-gradient(135deg, #1ED760, #17a84b);
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-weight: 600;
            transition: transform .2s, box-shadow .2s;
        }

        .btn-register:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(30, 215, 96, .35);
        }

        .text-muted-link {
            color: #aaa;
            font-size: .9rem;
        }

        .text-muted-link a {
            color: #1ED760;
            text-decoration: none;
            font-weight: 500;
        }

        .text-muted-link a:hover {
            text-decoration: underline;
        }

        .divider {
            height: 1px;
            background: linear-gradient(to right, transparent, #333, transparent);
            margin: 24px 0;
        }
    </style>
</head>
<body>

<div class="register-card">
    <div class="text-center mb-4">
        <h3 class="brand">Yomans<span>Music</span></h3>
        <p class="text-muted mb-0">Buat akun baru untuk mulai mendengarkan</p>
    </div>

    {{-- ERROR VALIDASI --}}
    @if($errors->any())
        <div class="alert alert-danger py-2">
            <ul class="mb-0 small">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="/register">
        @csrf

        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" placeholder="email@example.com" required>
        </div>

        <div class="mb-4">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
        </div>

        <button class="btn btn-register w-100">Daftar Akun</button>
    </form>

    <div class="divider"></div>

    <p class="text-center text-muted-link mb-0">
        Sudah punya akun?
        <a href="{{ route('login') }}">Login</a>
    </p>
</div>

</body>
</html>
