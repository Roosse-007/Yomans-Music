<!DOCTYPE html>
<html>
<head>
  <title>Admin Panel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">

<div class="container mt-5">

  <h2 class="mb-4">🎧 Admin Panel</h2>

  <div class="mb-4 d-flex gap-2 flex-wrap">
      <a href="/admin/songs/create" class="btn btn-success">
        ➕ Tambah Lagu
      </a>

      <a href="{{ route('admin.artists.create') }}" class="btn btn-primary">
        ➕ Tambah Artis
      </a>

      <a href="{{ route('admin.songs.index') }}" class="btn btn-warning">
        🎵 Kelola Lagu
      </a>
  </div>

  <h5 class="mb-3">🎤 Daftar Artis</h5>

  @if($artists->isEmpty())
      <p class="text-muted">Belum ada artis</p>
  @endif

  @foreach($artists as $artist)
<div class="card bg-black text-white p-3 mb-3 d-flex
            flex-row justify-content-between align-items-center">

    <div class="d-flex align-items-center gap-3">
        @if($artist->photo)
            <img src="{{ asset('storage/' . $artist->photo) }}"
                 width="60" height="60"
                 class="rounded"
                 style="object-fit:cover">
        @endif

        <strong>{{ $artist->name }}</strong>
    </div>

    <div class="d-flex gap-2">
        {{-- ➕ TAMBAH ALBUM --}}
    
        {{-- 👁 DETAIL ARTIST + ALBUM --}}
        <a href="{{ route('admin.artists.show', $artist->id) }}"
           class="btn btn-sm btn-info">
            👁 Detail
        </a>

        {{-- ✏️ EDIT --}}
        <a href="{{ route('admin.artists.edit', $artist->id) }}"
           class="btn btn-sm btn-outline-light">
            ✏️ Edit
        </a>

        {{-- 🗑️ HAPUS --}}
        <form action="{{ route('admin.artists.destroy', $artist->id) }}"
              method="POST"
              onsubmit="return confirm('Yakin hapus artis ini?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-danger">🗑️ Hapus</button>
        </form>
    </div>
</div>
@endforeach


</div>

</body>
</html>
