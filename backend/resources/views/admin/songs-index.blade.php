<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Admin - Daftar Lagu</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
body{
    font-family:'Inter',sans-serif;
    background:radial-gradient(circle at top,#1c1f23,#0b0d10);
    color:#e5e7eb;
    min-height:100vh;
}

.page-card{
    background:linear-gradient(145deg,#111418,#171b20);
    border-radius:22px;
    padding:32px;
    border:1px solid #262a30;
    box-shadow:0 30px 70px rgba(0,0,0,.85);
}

.page-title{
    font-weight:700;
    letter-spacing:.4px;
    margin-bottom:20px;
}

.page-title i{
    color:#22c55e;
    margin-right:10px;
}

.alert{
    border-radius:14px;
    background:#052e16;
    color:#bbf7d0;
    border:none;
}

.table{
    border-radius:18px;
    overflow:hidden;
}

.table thead{
    background:#0f172a;
}

.table th{
    color:#94a3b8;
    font-weight:600;
    text-transform:uppercase;
    font-size:13px;
    letter-spacing:.5px;
    border-bottom:1px solid #1f2937;
}

.table td{
    vertical-align:middle;
    border-color:#1f2937;
}

.table tbody tr:hover{
    background:#020617;
}

.badge-genre{
    background:#1f2937;
    color:#e5e7eb;
    padding:6px 10px;
    border-radius:12px;
    font-size:12px;
}

.btn-delete{
    background:#dc2626;
    border:none;
    border-radius:12px;
    padding:6px 12px;
}

.btn-delete:hover{
    background:#ef4444;
}

.btn-back{
    border-radius:14px;
    padding:10px 18px;
}
</style>
</head>

<body>

<div class="container py-5">

<div class="page-card">

<h3 class="page-title">
<i class="bi bi-music-note-list"></i> Daftar Lagu
</h3>

@if(session('success'))
<div class="alert mb-4">
<i class="bi bi-check-circle"></i> {{ session('success') }}
</div>
@endif

<div class="table-responsive">
<table class="table table-dark table-hover align-middle">
<thead>
<tr>
    <th>Judul Lagu</th>
    <th>Artis</th>
    <th>Album</th>
    <th>Genre</th>
    <th class="text-center">Aksi</th>
</tr>
</thead>

<tbody>
@foreach($songs as $song)
<tr>
    <td class="fw-semibold">{{ $song->title }}</td>
    <td>{{ optional($song->album->artist)->name ?? '-' }}</td>
    <td>{{ optional($song->album)->title ?? '-' }}</td>
    <td>
        @if($song->genre)
            <span class="badge-genre">{{ $song->genre->name }}</span>
        @else
            <span class="text-muted">-</span>
        @endif
    </td>
    <td class="text-center">
        <form action="{{ route('admin.songs.destroy', $song->id) }}"
              method="POST"
              onsubmit="return confirm('Yakin hapus lagu ini?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-delete btn-sm">
                <i class="bi bi-trash"></i>
            </button>
        </form>
    </td>
</tr>
@endforeach
</tbody>
</table>
</div>

<a href="/admin" class="btn btn-outline-light btn-back mt-4">
<i class="bi bi-arrow-left"></i> Kembali ke Dashboard
</a>

</div>

</div>

</body>
</html>