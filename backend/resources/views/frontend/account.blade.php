<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Akun Saya</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(180deg, #0d0d0d, #000);
      color: #fff;
    }

    .account-wrapper {
      max-width: 520px;
      margin: auto;
    }

    .main-card {
      background: rgba(0,0,0,0.85);
      border-radius: 18px;
      padding: 32px;
      box-shadow: 0 15px 40px rgba(0,0,0,0.6);
    }

    .profile-card {
      width: 150px;
      margin: auto;
      background: #111;
      border-radius: 16px;
    }

    .profile-card img {
      width: 96px;
      height: 96px;
      object-fit: cover;
    }

    .section {
      border-top: 1px solid rgba(255,255,255,0.08);
      padding-top: 20px;
      margin-top: 20px;
    }

    .label {
      font-size: 0.8rem;
      color: #aaa;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .value {
      font-size: 1rem;
      color: #eee;
    }

    .upload-input {
      background: #111;
      border: 1px dashed #444;
      color: #ccc;
    }

    .upload-input::file-selector-button {
      background: #222;
      border: none;
      color: #fff;
      padding: 6px 12px;
      margin-right: 10px;
    }

    .upload-input:hover {
      border-color: #666;
    }

    .logout-card {
      background: #111;
      border: 1px solid #333;
      border-radius: 14px;
      cursor: pointer;
      transition: all 0.25s ease;
    }

    .logout-card:hover {
      background: #161616;
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(255,255,255,0.05);
    }

    .logout-card.text-danger {
  border-color: rgba(255,80,80,0.4);
}

.logout-card.text-danger:hover {
  background: rgba(255,0,0,0.05);
  box-shadow: 0 10px 25px rgba(255,0,0,0.15);
}
.account-actions {
  margin-top: 28px;
}

    
  </style>
</head>

<body>


<div class="container py-5">
  <div class="account-wrapper">

  <div class="d-flex gap-2 mb-4">
  <a href="{{ route('home') }}" class="btn btn-outline-light">
    ← Beranda
  </a>

  <a href="{{ route('favorites') }}" class="btn btn-outline-light">
    ♫ Favorit
  </a>
</div>



    <h3 class="text-center mb-4">Akun Saya</h3>

    @auth
    <div class="main-card">

      <!-- FOTO PROFIL -->
      <div class="profile-card text-center p-3 mb-4">
        <img
          src="{{ auth()->user()->photo
              ? asset('storage/' . auth()->user()->photo) . '?v=' . time()
              : asset('storage/img/avatardef.jpg') }}"
          class="rounded-circle border border-secondary mb-2"
        >
        <div class="small text-secondary">Foto Profil</div>
      </div>

      <!-- GANTI FOTO -->
      <form action="/account/update-photo" method="POST" enctype="multipart/form-data">
        @csrf
        <input
          type="file"
          name="photo"
          class="form-control upload-input mb-2"
          accept="image/*"
          required
        >
        <button class="btn btn-outline-light w-100">
          Ganti Foto Profil
        </button>
      </form>

      <!-- INFO AKUN -->
<div class="section mt-4">
  <div class="mb-3">
    <div class="label">Nama</div>
    <div class="value">{{ auth()->user()->name }}</div>
  </div>

  <div class="mb-3">
    <div class="label">Email</div>
    <div class="value">{{ auth()->user()->email }}</div>
  </div>

  <div>
    <div class="label">Bergabung Sejak</div>
    <div class="value">
      {{ optional(auth()->user()->created_at)->format('d M Y') ?? '-' }}
    </div>
  </div>
</div>

<!-- ACTION AKUN -->
<div class="section mt-4">

  <!-- GANTI AKUN -->
  <form action="/logout" method="POST" class="mb-3">
    @csrf
    <div class="logout-card p-3 d-flex align-items-center justify-content-between"
         onclick="this.closest('form').submit()">
      <div>
        <div class="fw-semibold">Ganti Akun</div>
        <div class="small text-secondary">
          Logout dan masuk dengan akun lain
        </div>
      </div>
      <span class="fs-4">⟲</span>
    </div>
  </form>

  <!-- LOGOUT -->
  <form action="/logout" method="POST">
    @csrf
    <div class="logout-card p-3 d-flex align-items-center justify-content-between text-danger"
         onclick="this.closest('form').submit()">
      <div>
        <div class="fw-semibold">Logout</div>
        <div class="small text-secondary">
          Keluar dari akun ini
        </div>
      </div>
      <span class="fs-4">⎋</span>
    </div>
  </form>


    </div>
    @endauth

    @guest
      <div class="alert alert-warning text-center">
        Silakan login untuk melihat halaman akun.
      </div>
    @endguest

  </div>
</div>

</body>
</html>
