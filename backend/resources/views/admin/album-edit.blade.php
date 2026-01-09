<!DOCTYPE html>
<html>
<head>
    <title>Edit Album</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">

<div class="container mt-5" style="max-width:500px">

    <a href="{{ route('admin.artists.show', $album->artist_id) }}"
       class="btn btn-secondary mb-4">⬅ Kembali</a>

    <h4 class="mb-3">✏️ Edit Album</h4>

    <form action="{{ route('admin.albums.update', $album->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Judul Album</label>
            <input type="text"
                   name="title"
                   class="form-control"
                   value="{{ old('title', $album->title) }}"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Cover Album</label>

            @if($album->cover)
                <img src="{{ asset('storage/'.$album->cover) }}"
                     class="d-block mb-2 rounded"
                     style="width:120px;height:120px;object-fit:cover">
            @endif

            <input type="file" name="cover" class="form-control">
            <small class="text-muted">
                Kosongkan jika tidak ingin mengganti cover
            </small>
        </div>

        <button class="btn btn-warning w-100">
            💾 Simpan Perubahan
        </button>

    </form>
</div>

</body>
</html>
