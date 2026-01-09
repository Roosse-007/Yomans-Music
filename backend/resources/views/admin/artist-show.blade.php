<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Artis - {{ $artist->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-white">

<div class="container mt-5">

    <!-- KEMBALI -->
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mb-4">
        ⬅ Kembali ke Dashboard
    </a>

    <!-- INFO ARTIST -->
    <div class="d-flex align-items-center gap-3 mb-4">
        @if($artist->photo)
            <img src="{{ asset('storage/'.$artist->photo) }}"
                 width="90" height="90"
                 class="rounded"
                 style="object-fit:cover">
        @endif
        <div>
            <h2 class="mb-0">{{ $artist->name }}</h2>
            <small class="text-muted">
                Total Album: {{ $artist->albums->count() }}
            </small>
        </div>
    </div>

    <!-- TAMBAH ALBUM -->
    <a href="{{ route('admin.albums.create', $artist->id) }}"
       class="btn btn-warning mb-4">
        ➕ Tambah Album
    </a>

    <hr class="border-secondary">

    <!-- DAFTAR ALBUM -->
    <h5 class="mb-3">💿 Daftar Album</h5>

    @if($artist->albums->isEmpty())
        <p class="text-muted">Belum ada album untuk artis ini.</p>
    @else
        <div class="d-flex flex-wrap gap-4">

            @foreach($artist->albums as $album)
                <div class="card bg-black text-white shadow"
                     style="width:180px">

                    <!-- COVER -->
                    @if($album->cover)
                        <img src="{{ asset('storage/'.$album->cover) }}"
                             class="card-img-top"
                             style="height:180px; object-fit:cover">
                    @else
                        <div class="d-flex align-items-center justify-content-center"
                             style="height:180px; background:#222">
                            <small class="text-muted">No Cover</small>
                        </div>
                    @endif

                    <!-- INFO -->
                    <div class="card-body text-center p-2">
                        <strong class="d-block text-truncate">
                            {{ $album->title }}
                        </strong>
                        <small class="text-muted">
                            {{ $album->songs->count() ?? 0 }} Lagu
                        </small>
                    </div>

                    <!-- AKSI -->
                    <div class="card-footer bg-transparent border-0 text-center pb-3 d-grid gap-2">

                        <!-- EDIT ALBUM -->
                        <a href="{{ route('admin.albums.edit', $album->id) }}"
                           class="btn btn-sm btn-outline-warning w-100">
                            ✏️ Edit Album
                        </a>

                        <!-- HAPUS ALBUM -->
                        <form action="{{ route('admin.albums.destroy', $album->id) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin hapus album ini? Semua lagu di dalamnya akan ikut terhapus!')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger w-100">
                                🗑️ Hapus Album
                            </button>
                        </form>

                    </div>

                </div>
            @endforeach

        </div>
    @endif

</div>

</body>
</html>
