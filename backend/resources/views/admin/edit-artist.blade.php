<!DOCTYPE html>
<html>
<head>
    <title>Edit Artis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">

<div class="container mt-5" style="max-width:600px">

    <h3 class="mb-4">✏️ Edit Artis</h3>

    <div class="text-center mb-4">
        <img src="{{ asset('storage/' . $artist->photo) }}"
             class="rounded"
             style="width:150px;height:150px;object-fit:cover">
    </div>

    <form action="{{ route('admin.artists.update', $artist->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Artis</label>
            <input type="text" name="name"
                   class="form-control"
                   value="{{ $artist->name }}"
                   required>
        </div>

        <div class="mb-3">
            <label>Ganti Foto</label>
            <input type="file" name="photo" class="form-control">
            <small class="text-muted">
                Kosongkan jika tidak ingin ganti foto
            </small>
        </div>

        <button class="btn btn-success w-100">
            💾 Simpan Perubahan
        </button>

        <a href="/admin" class="btn btn-secondary w-100 mt-2">
            ⬅ Kembali
        </a>

    </form>
</div>

</body>
</html>
