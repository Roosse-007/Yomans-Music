<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Akun Saya</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-white">

@include('frontend.navbar')

<div class="container mt-5">

  <h2 class="mb-4">👤 Akun Saya</h2>

  @auth
    <div class="card bg-black text-white p-4">

      {{-- ✅ TAMBAHAN FOTO PROFIL (TANPA UBAH TAMPILAN LAIN) --}}
      <div class="card bg-dark border-0 shadow-sm mx-auto mb-4" style="width:160px;">
  <div class="card-body text-center p-3">

    <img
  src="{{ auth()->user()->photo
      ? asset('storage/' . auth()->user()->photo) . '?v=' . time()
      : asset('storage/img/avatardef.jpg') }}"

      width="88"
      height="88"
      class="rounded-circle border border-secondary mb-2"
      style="object-fit:cover"
    >

    <div class="small text-secondary">
      Foto Profil
    </div>

  </div>
</div>


      {{-- ✅ OPSI GANTI FOTO --}}
      <form action="/account/update-photo" method="POST" enctype="multipart/form-data" class="mb-4">
        @csrf
        <input
          type="file"
          name="photo"
          class="form-control mb-2"
          accept="image/*"
          required
        >
        <button class="btn btn-outline-light w-100">
          Ganti Foto Profil
        </button>
      </form>

      {{-- ================= ISI LAMA (TIDAK DIUBAH) ================= --}}

      <div class="mb-3">
        <strong>Nama</strong>
        <div class="text-secondary">
          {{ auth()->user()->name }}
        </div>
      </div>

      <div class="mb-3">
        <strong>Email</strong>
        <div class="text-secondary">
          {{ auth()->user()->email }}
        </div>
      </div>

      <div class="mb-3">
        <strong>Bergabung sejak</strong>
        <div class="text-secondary">
          {{ optional(auth()->user()->created_at)->format('d M Y') ?? '-' }}
        </div>
      </div>

      <form action="/logout" method="POST">
        @csrf
        <button class="btn btn-danger mt-3">
          🚪 Logout
        </button>
      </form>

    </div>
  @endauth

  @guest
    <div class="alert alert-warning">
      Silakan login untuk melihat halaman akun.
    </div>
  @endguest

</div>

</body>
</html>
