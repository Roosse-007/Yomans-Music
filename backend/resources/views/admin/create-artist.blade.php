<!DOCTYPE html>
<html>
<head>
  <title>Tambah Artis</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">

<div class="container mt-5">
  <h3>➕ Tambah Artis</h3>

  <form action="{{ route('admin.artists.store') }}"
        method="POST"
        enctype="multipart/form-data">

    @csrf

    <div class="mb-3">
      <label>Nama Artis</label>
      <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>Foto Artis</label>
      <input type="file" name="photo" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>Bio</label>
      <textarea name="bio" class="form-control"></textarea>
    </div>

    <button class="btn btn-success w-100">Simpan</button>
  </form>
</div>

</body>
</html>
