<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Artis - {{ $artist->name }}</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
body{
    font-family:'Inter',sans-serif;
    background:radial-gradient(circle at top,#1b1b1b,#000);
    color:#e5e5e5;
    min-height:100vh;
}

.page-title{
    font-weight:700;
    letter-spacing:.5px;
}

.back-btn{
    background:linear-gradient(145deg,#1f1f1f,#0d0d0d);
    border:1px solid #2a2a2a;
    color:#e5e5e5;
    border-radius:14px;
    padding:10px 18px;
}

.back-btn:hover{background:#222}

.artist-box{
    display:flex;
    align-items:center;
    gap:20px;
    background:linear-gradient(145deg,#0f0f0f,#141414);
    border-radius:22px;
    padding:24px;
    border:1px solid #1f1f1f;
    box-shadow:0 12px 30px rgba(0,0,0,.6);
}

.artist-avatar{
    width:96px;
    height:96px;
    border-radius:18px;
    object-fit:cover;
    border:1px solid #2a2a2a;
}

.artist-name{
    font-size:1.6rem;
    font-weight:700;
}

.stat-text{
    color:#9e9e9e;
    font-size:.95rem;
}

.btn-add{
    background:#ffc107;
    color:#000;
    border:none;
    border-radius:16px;
    padding:12px 22px;
    font-weight:600;
}

.btn-add:hover{filter:brightness(1.1)}

.album-card{
    width:200px;
    background:linear-gradient(145deg,#0f0f0f,#141414);
    border-radius:22px;
    border:1px solid #1f1f1f;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,.7);
    transition:.3s;
}

.album-card:hover{
    transform:translateY(-4px);
    box-shadow:0 20px 45px rgba(0,0,0,.9);
}

.album-cover{
    height:200px;
    object-fit:cover;
}

.album-info{
    padding:12px;
    text-align:center;
}

.album-title{
    font-weight:600;
    font-size:1rem;
    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
}

.album-count{
    font-size:.85rem;
    color:#9e9e9e;
}

.album-actions{
    padding:14px;
    display:grid;
    gap:10px;
}

.btn-edit{
    border:1px solid #ffc107;
    color:#ffc107;
    background:transparent;
    border-radius:14px;
}

.btn-delete{
    background:#e53935;
    color:#fff;
    border:none;
    border-radius:14px;
}

.btn-edit:hover,
.btn-delete:hover{filter:brightness(1.15)}
</style>
</head>

<body>

<div class="container py-5">

<a href="{{ route('admin.dashboard') }}" class="btn back-btn mb-4">
<i class="bi bi-arrow-left"></i> Kembali ke Dashboard
</a>

<div class="artist-box mb-4">
@if($artist->photo)
<img src="{{ asset('storage/'.$artist->photo) }}" class="artist-avatar">
@endif
<div>
<div class="artist-name">{{ $artist->name }}</div>
<div class="stat-text">Total Album: {{ $artist->albums->count() }}</div>
</div>
</div>

<a href="{{ route('admin.albums.create',$artist->id) }}" class="btn btn-add mb-5">
<i class="bi bi-plus-circle"></i> Tambah Album
</a>

<h5 class="mb-4 page-title">
<i class="bi bi-disc"></i> Daftar Album
</h5>

@if($artist->albums->isEmpty())
<p class="text-muted">Belum ada album untuk artis ini.</p>
@else
<div class="d-flex flex-wrap gap-4">

@foreach($artist->albums as $album)
<div class="album-card">

@if($album->cover)
<img src="{{ asset('storage/'.$album->cover) }}" class="album-cover w-100">
@else
<div class="d-flex align-items-center justify-content-center album-cover bg-dark">
<span class="text-muted">No Cover</span>
</div>
@endif

<div class="album-info">
<div class="album-title">{{ $album->title }}</div>
<div class="album-count">{{ $album->songs->count() ?? 0 }} Lagu</div>
</div>

<div class="album-actions">
<a href="{{ route('admin.albums.edit',$album->id) }}" class="btn btn-edit btn-sm">
<i class="bi bi-pencil"></i> Edit Album
</a>

<form action="{{ route('admin.albums.destroy',$album->id) }}" method="POST"
onsubmit="return confirm('Yakin hapus album ini? Semua lagu di dalamnya akan ikut terhapus!')">
@csrf
@method('DELETE')
<button class="btn btn-delete btn-sm w-100">
<i class="bi bi-trash"></i> Hapus Album
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