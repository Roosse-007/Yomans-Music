<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Album</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
body{
    font-family:'Inter',sans-serif;
    background:
        radial-gradient(circle at top, #1b1b1b, #000);
    color:#e5e5e5;
    min-height:100vh;
}

.container{
    max-width:1100px;
}

.back-btn{
    background:linear-gradient(145deg,#1f1f1f,#0d0d0d);
    border:1px solid #2a2a2a;
    color:#e5e5e5;
    border-radius:14px;
    padding:10px 18px;
    font-weight:500;
}

.back-btn:hover{
    background:#222;
}

.form-card{
    background:linear-gradient(145deg,#0f0f0f,#141414);
    border-radius:22px;
    padding:36px;
    border:1px solid #1f1f1f;
    box-shadow:0 20px 50px rgba(0,0,0,.7);
}

.page-title{
    font-weight:700;
    letter-spacing:.5px;
}

.artist-box{
    display:flex;
    align-items:center;
    gap:18px;
    padding:16px;
    border-radius:18px;
    background:#0b0b0b;
    border:1px solid #1f1f1f;
    margin-bottom:28px;
}

.artist-avatar{
    width:72px;
    height:72px;
    border-radius:16px;
    object-fit:cover;
    border:1px solid #2a2a2a;
}

.artist-name{
    font-size:1.2rem;
    font-weight:600;
}

.form-label{
    color:#cfcfcf;
    font-weight:500;
}

.form-control{
    background:#0b0b0b;
    border:1px solid #2a2a2a;
    color:#e5e5e5;
    border-radius:14px;
    padding:12px 16px;
}

.form-control:focus{
    background:#0b0b0b;
    color:#fff;
    border-color:#00bcd4;
    box-shadow:none;
}

.btn-save{
    background:#00c853;
    border:none;
    color:#000;
    border-radius:16px;
    padding:12px 26px;
    font-weight:600;
}

.btn-cancel{
    background:transparent;
    border:1px solid #444;
    color:#e5e5e5;
    border-radius:16px;
    padding:12px 26px;
}

.btn-save:hover,
.btn-cancel:hover{
    filter:brightness(1.15);
}
</style>
</head>

<body>

<div class="container py-5">

<a href="{{ route('admin.artists.show',$artist->id) }}" class="btn back-btn mb-4">
<i class="bi bi-arrow-left"></i> Kembali
</a>

<div class="form-card mx-auto" style="max-width:600px">

<h4 class="page-title mb-4">
<i class="bi bi-disc"></i> Tambah Album
</h4>

<div class="artist-box">
@if($artist->photo)
<img src="{{ asset('storage/'.$artist->photo) }}" class="artist-avatar">
@endif
<div class="artist-name">{{ $artist->name }}</div>
</div>

<form action="{{ route('admin.albums.store',$artist->id) }}" method="POST" enctype="multipart/form-data">
@csrf

<input type="hidden" name="artist_id" value="{{ $artist->id }}">

<div class="mb-3">
<label class="form-label">Judul Album</label>
<input type="text" name="title" class="form-control" placeholder="Judul album" required>
</div>

<div class="mb-4">
<label class="form-label">Cover Album</label>
<input type="file" name="cover" class="form-control">
</div>

<div class="d-flex gap-3">
<button class="btn btn-save">
<i class="bi bi-save"></i> Simpan
</button>

<a href="{{ route('admin.artists.show',$artist->id) }}" class="btn btn-cancel">
<i class="bi bi-x-circle"></i> Batal
</a>
</div>

</form>
</div>
</div>

</body>
</html>