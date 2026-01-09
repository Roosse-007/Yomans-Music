<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register - YomansMusic</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
      font-family: 'Fira Sans', sans-serif;
      color: white;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }
        .card {
            background: #111;
            border-radius: 16px;
            width: 400px;
        }
        .form-control {
            background: #222;
            color: white;
            border: 1px solid #444;
        }
        .btn-success {
            background: #1ED760;
            border: none;
        }
    </style>
</head>
<body>

<div class="card p-4">
    <h3 class="text-center text-success mb-4">Daftar Akun</h3>

    {{-- ERROR VALIDASI --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
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
            <input type="text" name="username" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-4">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button class="btn btn-success w-100">Daftar</button>
    </form>

    <p class="text-center mt-3 mb-0">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="text-success">Login</a>
    </p>
</div>

</body>
</html>
