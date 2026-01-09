<!DOCTYPE html>
<html>
<head>
    <title>Admin - Daftar Lagu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">

<div class="container mt-5">
    <h3>🎵 Daftar Lagu</h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-dark table-striped mt-3">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Artis</th>
                <th>Album</th>
                <th>Genre</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach($songs as $song)
            <tr>
                <td>{{ $song->title }}</td>
                <td>{{ optional($song->album->artist)->name }}</td>
                <td>{{ optional($song->album)->title ?? '-' }}</td>
                <td>{{ optional($song->genre)->name ?? '-' }}</td>
                <td>
                    <!-- 🔥 TOMBOL HAPUS -->
                    <form action="{{ route('admin.songs.destroy', $song->id) }}"
                          method="POST"
                          onsubmit="return confirm('Yakin hapus lagu ini?')"
                          style="display:inline">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-sm">
                            🗑 Hapus
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <a href="/admin" class="btn btn-outline-light mt-3">
        ⬅ Kembali ke Dashboard
    </a>
</div>

</body>
</html>
