<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Yomans Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: radial-gradient(circle at top, #1e1e1e, #000000);
            color: #eaeaea;
        }

        .page-title {
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .action-btn {
            border-radius: 14px;
            padding: 10px 18px;
            font-weight: 500;
            transition: all .3s ease;
        }

        .action-btn i {
            margin-right: 6px;
        }

        .artist-card {
            background: linear-gradient(145deg, #0c0c0c, #151515);
            border-radius: 18px;
            padding: 18px 22px;
            transition: all .35s ease;
            border: 1px solid #1f1f1f;
        }

        .artist-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, .7);
        }

        .artist-avatar {
            width: 68px;
            height: 68px;
            object-fit: cover;
            border-radius: 16px;
            border: 1px solid #2b2b2b;
        }

        .artist-name {
            font-size: 1.1rem;
            font-weight: 600;
        }

        .icon-btn {
            border-radius: 12px;
            padding: 7px 12px;
            font-size: .9rem;
            transition: all .25s ease;
        }

        .btn-detail {
            background: linear-gradient(135deg, #00c6ff, #0072ff);
            border: none;
        }

        .btn-edit {
            background: transparent;
            border: 1px solid #555;
            color: #ddd;
        }

        .btn-delete {
            background: linear-gradient(135deg, #ff5252, #b71c1c);
            border: none;
        }

        .btn-detail:hover {
            filter: brightness(1.1);
        }

        .btn-edit:hover {
            background: #2b2b2b;
        }

        .btn-delete:hover {
            filter: brightness(1.1);
        }

        .section-title {
            font-weight: 600;
            letter-spacing: .4px;
        }
        /* Cursor telunjuk */
button,
a,
.icon-btn,
.action-btn,
.artist-card {
    cursor: pointer;
}

    </style>
</head>

<body>

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <h3 class="page-title">
            <i class="bi bi-headphones"></i> Yomans Admin Panel
        </h3>

        <div class="d-flex gap-2">
            <a href="/admin/songs/create" class="btn btn-success action-btn">
                <i class="bi bi-plus-circle"></i> Tambah Lagu
            </a>

            <a href="{{ route('admin.artists.create') }}" class="btn btn-primary action-btn">
                <i class="bi bi-person-plus"></i> Tambah Artis
            </a>

            <a href="{{ route('admin.songs.index') }}" class="btn btn-warning action-btn">
                <i class="bi bi-music-note-list"></i> Kelola Lagu
            </a>
        </div>
    </div>

    <h6 class="section-title mb-3">
        <i class="bi bi-mic"></i> Daftar Artis
    </h6>

    @forelse($artists as $artist)
        <div class="artist-card d-flex justify-content-between align-items-center mb-3">

            <div class="d-flex align-items-center gap-3">
                @if($artist->photo)
                    <img src="{{ asset('storage/' . $artist->photo) }}" class="artist-avatar">
                @endif
                <div class="artist-name">{{ $artist->name }}</div>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('admin.artists.show', $artist->id) }}" class="btn btn-detail icon-btn text-white">
                    <i class="bi bi-eye"></i>
                </a>

                <a href="{{ route('admin.artists.edit', $artist->id) }}" class="btn btn-edit icon-btn">
                    <i class="bi bi-pencil"></i>
                </a>

                <form action="{{ route('admin.artists.destroy', $artist->id) }}" method="POST" onsubmit="return confirm('Hapus artis ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-delete icon-btn text-white">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </div>

        </div>
    @empty
        <p class="text-muted">Belum ada artis</p>
    @endforelse

</div>

</body>
</html>