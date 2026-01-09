<!DOCTYPE html>
<html>
<head>
    <title>Tambah Album</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">

<div class="container mt-5">
    <h3 class="mb-4">💿 Tambah Album</h3>

    <form action="{{ route('admin.albums.store', $artist->id) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="artist_id" value="{{ $artist->id }}">

        <div class="mb-3">
            <label>Artis</label>
            <input type="text"
                   class="form-control"
                   value="{{ $artist->name }}"
                   disabled>
        </div>

        <div class="mb-3">
            <label>Judul Album</label>
            <input type="text"
                   name="title"
                   class="form-control"
                   required>
        </div>

        <div class="mb-3">
            <label>Cover Album</label>
            <input type="file"
                   name="cover"
                   class="form-control">
        </div>

        <button class="btn btn-success">
            💾 Simpan Album
        </button>

        <a href="{{ route('admin.dashboard') }}"
           class="btn btn-secondary">
           ⬅ Kembali
        </a>
    </form>
</div>

</body>
</html>
