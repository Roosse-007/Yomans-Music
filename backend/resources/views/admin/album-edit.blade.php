<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Album</title>
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
    color:#facc15;
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
    border-color:#facc15;
    box-shadow:none;
    color:#fff;
}

.cover-preview{
    width:140px;
    height:140px;
    border-radius:18px;
    object-fit:cover;
    border:2px solid #1f2937;
    box-shadow:0 10px 30px rgba(0,0,0,.7);
}

.btn-save{
    background:#00c853;
    border:none;
    color:#000;
    border-radius:16px;
    font-weight:600;
    padding:12px;
}

.btn-save:hover{
    background:linear-gradient(135deg,#fde047,#facc15);
}

.btn-back{
    border-radius:14px;
    padding:8px 16px;
}
</style>
</head>

<body>

<div class="container py-5" style="max-width:520px">

<a href="{{ route('admin.artists.show', $album->artist_id) }}"
   class="btn btn-outline-light btn-back mb-4">
<i class="bi bi-arrow-left"></i> Kembali
</a>

<div class="form-card">

<h4 class="form-title">
<i class="bi bi-pencil-square"></i> Edit Album
</h4>

<form action="{{ route('admin.albums.update', $album->id) }}"
      method="POST"
      enctype="multipart/form-data">

@csrf
@method('PUT')

<div class="mb-4">
    <label class="form-label">Judul Album</label>
    <input type="text"
           name="title"
           class="form-control"
           value="{{ old('title', $album->title) }}"
           required>
</div>

<div class="mb-4">
    <label class="form-label">Cover Album</label>

    @if($album->cover)
        <img src="{{ asset('storage/'.$album->cover) }}"
             class="cover-preview mb-3 d-block">
    @endif

    <input type="file" name="cover" class="form-control mt-2">
    <small class="text-muted">
        Kosongkan jika tidak ingin mengganti cover
    </small>
</div>

<button class="btn btn-save w-100 mt-3">
<i class="bi bi-save"></i> Simpan Perubahan
</button>

</form>

</div>

</div>

</body>
</html>