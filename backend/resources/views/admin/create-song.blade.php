<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Lagu</title>
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

.form-card{
    background:linear-gradient(145deg,#111418,#171b20);
    border-radius:24px;
    padding:32px;
    border:1px solid #262a30;
    box-shadow:0 30px 70px rgba(0,0,0,.85);
}

.form-title{
    font-weight:700;
    margin-bottom:24px;
}

.form-title i{
    color:#22c55e;
    margin-right:8px;
}

.form-label{
    color:#cbd5f5;
    font-weight:500;
}

.form-control{
    background:#020617;
    border:1px solid #1f2937;
    color:#e5e7eb;
    border-radius:14px;
    padding:12px;
}

.form-control:focus{
    background:#020617;
    border-color:#22c55e;
    box-shadow:none;
    color:#fff;
}

.btn-save{
    background:linear-gradient(135deg,#22c55e,#16a34a);
    border:none;
    color:#000;
    border-radius:16px;
    font-weight:600;
    padding:12px;
}

.btn-save:hover{
    background:linear-gradient(135deg,#4ade80,#22c55e);
}

.btn-back{
    border-radius:14px;
    padding:8px 16px;
}
</style>
</head>

<body>

<div class="container py-5" style="max-width:700px">

<a href="/admin" class="btn btn-outline-light btn-back mb-4">
<i class="bi bi-arrow-left"></i> Kembali Ke Dashboard
</a>

<div class="form-card">

<h4 class="form-title">
<i class="bi bi-music-note-beamed"></i> Tambah Lagu
</h4>

@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif

<form method="POST" action="{{ route('admin.songs.store') }}" enctype="multipart/form-data">
@csrf

<div class="mb-3">
<label class="form-label">Judul Lagu</label>
<input class="form-control" name="title" required>
</div>

<div class="mb-3">
<label class="form-label">Artis</label>
<select class="form-control" name="artist_id" required>
<option value="">Pilih Artis</option>
@foreach($artists as $artist)
<option value="{{ $artist->id }}">{{ $artist->name }}</option>
@endforeach
</select>
</div>

<div class="mb-3">
<label class="form-label">Album</label>
<select class="form-control" name="album_id" required>
<option value="">Pilih Album</option>
@foreach($albums as $album)
<option value="{{ $album->id }}">
{{ $album->title }} ({{ $album->artist->name }})
</option>
@endforeach
</select>
</div>

<div class="mb-3">
<label class="form-label">Genre</label>
<select class="form-control" name="genre_id" required>
<option value="">Pilih Genre</option>
@foreach($genres as $genre)
<option value="{{ $genre->id }}">{{ $genre->name }}</option>
@endforeach
</select>
</div>

<div class="mb-4">
<label class="form-label">File Lagu</label>
<input type="file" name="audio" class="form-control" required>
</div>

<button class="btn btn-save w-100">
<i class="bi bi-save"></i> Simpan Lagu
</button>

</form>

</div>
</div>

</body>
</html>
