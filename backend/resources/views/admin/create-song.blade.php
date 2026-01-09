<!-- resources/views/admin/create-song.blade.php -->
<!DOCTYPE html>
<html>
<head>
  <title>Tambah Lagu</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">

<div class="container mt-5">
  <h3>➕ Tambah Lagu</h3>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <form method="POST" action="{{ route('admin.songs.store') }}" enctype="multipart/form-data">
    @csrf

    <input class="form-control mb-3"
           name="title"
           placeholder="Judul Lagu"
           required>

    {{-- PILIH ARTIS --}}
    <select class="form-control mb-3" name="artist_id" required>
        <option value="">Pilih Artis</option>
        @foreach($artists as $artist)
            <option value="{{ $artist->id }}">{{ $artist->name }}</option>
        @endforeach
    </select>

    {{-- PILIH ALBUM --}}
    <select class="form-control mb-3" name="album_id" required>
        <option value="">Pilih Album</option>
        @foreach($albums as $album)
            <option value="{{ $album->id }}">
                {{ $album->title }} ({{ $album->artist->name }})
            </option>
        @endforeach
    </select>

    {{-- PILIH GENRE --}}
    <select class="form-control mb-3" name="genre_id" required>
        <option value="">Pilih Genre</option>
        @foreach($genres as $genre)
            <option value="{{ $genre->id }}">{{ $genre->name }}</option>
        @endforeach
    </select>

    <input type="file"
           name="audio"
           class="form-control mb-3"
           required>

    <button class="btn btn-success w-100">
        Simpan Lagu
    </button>
</form>

</div>

</body>
</html>
