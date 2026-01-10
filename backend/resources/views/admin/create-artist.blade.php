<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Artis</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
body{
    font-family:'Inter',sans-serif;
    background:radial-gradient(circle at top,#1e1e1e,#0b0b0b);
    color:#e5e5e5;
    min-height:100vh;
}

.card-form{
    max-width:800px;
    margin:auto;
    background:linear-gradient(145deg,#121212,#181818);
    border-radius:22px;
    padding:40px;
    border:1px solid #262626;
    box-shadow:0 25px 60px rgba(0,0,0,.8);
}

.page-title{
    font-weight:700;
    margin-bottom:28px;
    letter-spacing:.4px;
}

.page-title i{
    margin-right:10px;
    color:#8b5cf6;
}

label{
    font-weight:500;
    margin-bottom:6px;
}

.form-control{
    background:#0f0f0f;
    border:1px solid #2a2a2a;
    color:#fff;
    border-radius:14px;
    padding:12px 14px;
}

.form-control:focus{
    background:#0f0f0f;
    color:#fff;
    border-color:#22c55e;
    box-shadow:none;
}

.file-input::-webkit-file-upload-button{
    background:#1f1f1f;
    border:none;
    color:#d4d4d4;
    padding:8px 14px;
    border-radius:10px;
}

.file-input{
    cursor:pointer;
}

.btn-save{
    background:linear-gradient(135deg,#22c55e,#16a34a);
    border:none;
    color:#000;
    font-weight:600;
    border-radius:16px;
    padding:14px;
}

.btn-save:hover{
    filter:brightness(1.1);
}
</style>
</head>

<body>

<div class="container py-5">

  <a href="/admin" class="btn btn-outline-light btn-back mb-4">
<i class="bi bi-arrow-left"></i> Kembali Ke Dashboard
</a>

<div class="card-form">

<h3 class="page-title">
<i class="bi bi-person-plus-fill"></i> Tambah Artis
</h3>

<form action="{{ route('admin.artists.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="mb-3">
<label>Nama Artis</label>
<input type="text" name="name" class="form-control" placeholder="Masukkan nama artis" required>
</div>

<div class="mb-3">
<label>Foto Artis</label>
<input type="file" name="photo" class="form-control file-input" required>
</div>

<div class="mb-4">
<label>Bio</label>
<textarea name="bio" rows="4" class="form-control" placeholder="Deskripsi singkat artis"></textarea>
</div>

<button class="btn btn-save w-100">
<i class="bi bi-save"></i> Simpan
</button>

</form>

</div>

</div>

</body>
</html>