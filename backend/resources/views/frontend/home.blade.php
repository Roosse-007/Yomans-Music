<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>YomansMusic</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('storage/css/style.css') }}">
</head>

@if (session('success'))
<div class="alert alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show">
    {{ session('error') }}
    <button class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif


<body style="background: linear-gradient(#131614, #000); min-height:100vh; color:white;">

<div class="container-md">

<!-- ================= NAVBAR ================= -->
<nav class="navbar navbar-expand-lg bg-dark navbar-dark mt-3 rounded px-3">
  <div class="container-fluid">

    <a class="navbar-brand d-flex align-items-center gap-2" href="#">
      <img src="{{ asset('storage/img/logo.jpg') }}" height="40">
      <div class="brand-text d-flex flex-column">
        <span>Yomans</span>
        <span>Music</span>
      </div>
    </a>

    <form class="d-flex mx-auto" style="width:400px">
      <input
        id="searchArtist"
        class="form-control"
        type="search"
        placeholder="Cari penyanyi favorit..."
      >
    </form>

    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-3">
      <li class="nav-item">
        <a class="nav-link active" href="http://127.0.0.1:8000/">Beranda</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="http://127.0.0.1:8000/favorites">Favorit</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="http://127.0.0.1:8000/login">Login</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="http://127.0.0.1:8000/account">Akun</a>
      </li>
    </ul>

  </div>
</nav>

<!-- ================= BANNER CAROUSEL ================= -->
<div id="bannerCarousel" class="carousel slide mt-4" data-bs-ride="carousel">
  <div class="carousel-inner rounded overflow-hidden">

    <!-- VIDEO SLIDE 1 -->
    <div class="carousel-item active" data-bs-interval="10000">
      <video
        class="d-block w-100"
        autoplay
        muted
        loop
        playsinline
        disablepictureinpicture
  controlslist="nodownload nofullscreen noremoteplayback"
        style="height:420px; object-fit:cover;"
      >
        <source src="{{ asset('storage/video/alonica.mp4') }}" type="video/mp4">
      </video>
    </div>

    <!-- VIDEO SLIDE 2 -->
    <div class="carousel-item" data-bs-interval="10000">
      <video
        class="d-block w-100"
        autoplay
        muted
        loop
        playsinline
        disablepictureinpicture
  controlslist="nodownload nofullscreen noremoteplayback"
        style="height:420px; object-fit:cover;"
      >
        <source src="{{ asset('storage/video/onelove.mp4') }}" type="video/mp4">
      </video>
    </div>

    <!-- VIDEO SLIDE 3 -->
    <div class="carousel-item" data-bs-interval="10000">
      <video
        class="d-block w-100"
        autoplay
        muted
        loop
        playsinline
        disablepictureinpicture
  controlslist="nodownload nofullscreen noremoteplayback"
        style="height:420px; object-fit:cover;"
      >
        <source src="{{ asset('storage/video/weeknd.mp4') }}" type="video/mp4">
      </video>
    </div>

  </div>

  <!-- CONTROL -->
  <!-- <button class="carousel-control-prev" type="button"
          data-bs-target="#bannerCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>

  <button class="carousel-control-next" type="button"
          data-bs-target="#bannerCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button> -->
</div>



<!-- ================= ARTIST GRID ================= -->
<div class="main mt-5 d-flex flex-wrap justify-content-center gap-4">

  @foreach ($artists as $artist)
    <div
      class="audio"
      data-artist-id="{{ $artist->id }}"
      data-artist-image="{{ $artist->photo
          ? asset('storage/' . $artist->photo)
          : asset('storage/img/artist-default.png') }}"
    >

      <img
        src="{{ $artist->photo
            ? asset('storage/' . $artist->photo)
            : asset('storage/img/artist-default.png') }}"
      >

      <h2>{{ $artist->name }}</h2>
      <p>Artist</p>

    </div>
  @endforeach

</div>


<!-- ================= MODAL ================= -->
<div class="modal fade" id="artistModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content bg-dark text-white">

      <div class="modal-header d-flex align-items-center gap-3">
        <img id="modalArtistImage" src="" style="width:60px;height:60px;object-fit:cover;border-radius:8px">
        <h5 class="modal-title" id="modalArtistName">Artist</h5>
        <button class="btn-close btn-close-white ms-auto" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

  <!-- TAB -->
  <ul class="nav nav-tabs mb-3">
    <li class="nav-item">
      <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tabSongs">
        Lagu
      </button>
    </li>
    <li class="nav-item">
      <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabAlbums">
        Album
      </button>
    </li>
  </ul>

  <div class="tab-content">

    <!-- TAB LAGU -->
    <div class="tab-pane fade show active" id="tabSongs">
      <ul class="list-group list-group-flush" id="songList"></ul>
    </div>

    <!-- TAB ALBUM -->
    <div class="tab-pane fade" id="tabAlbums">
      <div id="albumList" class="d-flex flex-wrap gap-3"></div>
    </div>

  </div>
</div>

    </div>
  </div>
</div>

<!-- ================= MINI PLAYER ================= -->
<div id="miniPlayer" class="fixed-bottom spotify-player d-none">
  <div class="container-fluid px-4">

    <div class="player-grid">

      <!-- LEFT : SONG INFO -->
      <div class="player-left">
        <img id="playerArtistImage" src="{{ asset('storage/img/logo.jpg') }}">
        <div>
          <div id="playerTitle">Judul Lagu</div>
          <small id="playerArtist">Artist</small>
        </div>
      </div>

      <!-- CENTER : CONTROLS -->
      <div class="player-center">

        <div class="controls">
          <button id="shuffleBtn" class="icon-btn">
            <i class="bi bi-shuffle"></i>
          </button>

          <button id="prevBtn" class="icon-btn">
            <i class="bi bi-skip-start-fill"></i>
          </button>

          <button id="playPauseBtn" class="play-btn">
            <i class="bi bi-play-fill"></i>
          </button>

          <button id="nextBtn" class="icon-btn">
            <i class="bi bi-skip-end-fill"></i>
          </button>

          <button class="icon-btn">
            <i class="bi bi-arrow-repeat"></i>
          </button>
        </div>

        <!-- PROGRESS BAR CENTER -->
        <div class="progress-wrap">
          <small id="currentTime">0:00</small>
          <input type="range" id="progressBar" min="0" value="0">
          <small id="duration">0:00</small>
        </div>

      </div>

      <!-- RIGHT (kosong / future feature) -->
      <div class="player-right"></div>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('storage/js/player.js') }}"></script>
<script src="{{ asset('storage/js/app.js') }}"></script>
</body>
</html>