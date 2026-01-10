<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Artis</title>
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

.card-form{
    background:linear-gradient(145deg,#0f0f0f,#141414);
    border-radius:24px;
    padding:32px;
    border:1px solid #1f1f1f;
    box-shadow:0 15px 40px rgba(0,0,0,.7);
}

.page-title{
    font-weight:700;
    letter-spacing:.4px;
    text-align:center;
}

.artist-preview{
    width:160px;
    height:160px;
    object-fit:cover;
    border-radius:20px;
    border:1px solid #2a2a2a;
    box-shadow:0 10px 25px rgba(0,0,0,.7);
}

.form-control{
    background:#111;
    border:1px solid #2a2a2a;
    color:#fff;
    border-radius:14px;
}

.form-control:focus{
    background:#111;
    color:#fff;
    border-color:#ffc107;
    box-shadow:none;
}

label{
    font-weight:500;
    margin-bottom:6px;
}

.btn-save{
    background:#22c55e;
    border:none;
    color:#000;
    font-weight:600;
    border-radius:16px;
    padding:12px;
}

.btn-save:hover{filter:brightness(1.1)}

.btn-back{
    background:transparent;
    border:1px solid #555;
    color:#ddd;
    border-radius:16px;
    padding:12px;
}

.btn-back:hover{background:#222}

.helper-text{
    font-size:.85rem;
    color:#9e9e9e;
}
</style>
</head>

<body>

<div class="container py-5" style="max-width:620px">

<div class="card-form">

<h3 class="page-title mb-4">
<i class="bi bi-pencil-square"></i> Edit Artis
</h3>

<div class="text-center mb-4">
<img src="{{ asset('storage/'.$artist->photo) }}" class="artist-preview">
</div>

<form action="{{ route('admin.artists.update',$artist->id) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')

<div class="mb-3">
<label>Nama Artis</label>
<input type="text" name="name" class="form-control" value="{{ $artist->name }}" required>
</div>

<div class="mb-4">
<label>Ganti Foto</label>
<input type="file" name="photo" class="form-control">
<div class="helper-text mt-1">Kosongkan jika tidak ingin mengganti foto</div>
</div>

<button class="btn btn-save w-100 mb-3">
<i class="bi bi-save"></i> Simpan Perubahan
</button>

<a href="/admin" class="btn btn-back w-100">
<i class="bi bi-arrow-left"></i> Kembali
</a>

</form>

</div>
</div>

</body>
</html>