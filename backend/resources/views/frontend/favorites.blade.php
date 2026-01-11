<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Lagu Favorit - YomansMusic</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('storage/css/style.css') }}">

<style>
body {
  background: linear-gradient(#131614, #000);
  color: white;
  font-family: 'Fira Sans', sans-serif;
}

/* ===== FAVORITE LIST ===== */
.fav-item {
  background: #1c1c1c;
  border-radius: 12px;
  padding: 14px 18px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 12px;
  transition: background .25s ease;
}

.fav-item:hover {
  background: #242424;
}

.fav-left {
  display: flex;
  align-items: center;
  gap: 14px;
}

.fav-left img {
  width: 56px;
  height: 56px;
  border-radius: 8px;
  object-fit: cover;
}

.fav-title {
  font-weight: 600;
}

.fav-artist {
  font-size: 13px;
  color: #aaa;
}

/* =========================
   MINI PLAYER PLAY BUTTON
========================= */
/* PLAY BUTTON DEFAULT */
.play-btn {
  width: 46px;
  height: 46px;
  border-radius: 50%;
  background: #ffffff;
  border: none;
  color: #000;
  font-size: 26px;

  display: flex;
  align-items: center;
  justify-content: center;

  transition: background .25s ease,
              transform .2s ease,
              box-shadow .25s ease;
}

/* HOVER = HIJAU */
.play-btn:hover {
  background: #1db954;
  box-shadow: 0 0 16px rgba(29,185,84,.6);
  transform: scale(1.08);
}

/* KLIK */
.play-btn:active {
  transform: scale(0.95);
}

/* ICON TETAP HITAM */
.play-btn i {
  color: #000;
}

/* Matikan hover sementara saat mini player baru muncul */
#miniPlayer.no-hover .play-btn:hover {
  background: #ffffff;
  box-shadow: none;
  transform: none;
}


/* ===== MINI PLAYER ===== */
#miniPlayer {
  background: #000;
  border-top: 1px solid #222;
  transform: translateY(100%);
  transition: transform .35s ease;
  z-index: 9999;
}

#miniPlayer.show {
  transform: translateY(0);
}

.player-grid {
  display: grid;
  grid-template-columns: 1fr 1.5fr 1fr;
  align-items: center;
}

.player-left {
  display: flex;
  align-items: center;
  gap: 12px;
}

.player-left img {
  width: 56px;
  height: 56px;
  border-radius: 6px;
  object-fit: cover;
}

.player-center {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 6px;
}

.controls {
  display: flex;
  gap: 18px;
  align-items: center;
}

.icon-btn {
  background: none;
  border: none;
  color: #aaa;
  font-size: 18px;
}

.icon-btn:hover {
  color: #fff;
}

.play-btn {
  width: 46px;
  height: 46px;
  border-radius: 50%;
  background: #fff;
  border: none;
  color: #000;
  font-size: 26px;
}

.progress-wrap {
  display: flex;
  align-items: center;
  gap: 10px;
  width: 100%;
}

#progressBar {
  flex: 1;
  height: 4px;
  accent-color: #1db954;
}
/* =========================
   MINI PLAYER PLAYING STATE
========================= */
/* =========================
   MINI PLAYER PLAY BUTTON (SAMA DENGAN HOME)
========================= */
#miniPlayer .play-btn {
  background: #ffffff !important; /* PUTIH DEFAULT */
  color: #000 !important;
  box-shadow: none;
}

/* HOVER SAJA YANG HIJAU */
#miniPlayer .play-btn:hover {
  background: #1db954 !important;
  color: #000 !important;
}

/* ICON JANGAN WARNA HIJAU */
#miniPlayer .play-btn i {
  color: #000 !important;
}

/* PASTIKAN TIDAK ADA STATE PLAYING */
#miniPlayer.playing .play-btn,
#miniPlayer .play-btn.active {
  background: #ffffff !important;
}


small {
  font-size: 12px;
  color: #aaa;
}
</style>
</head>

<body>

<div class="container-md mt-5 mb-5 pb-5">
  <h3 class="mb-4">Lagu Favorit</h3>

  @forelse ($favorites as $i => $song)
    <div class="fav-item">
      <div class="fav-left">
        <img src="{{ $song->cover ? asset('storage/'.$song->cover) : asset('storage/img/logo.jpg') }}">
        <div>
          <div class="fav-title">{{ $song->title }}</div>
          <div class="fav-artist">{{ $song->artist }}</div>
        </div>
      </div>

      <button class="play-fav-btn" onclick="playSong({{ $i }})">
        ▶
      </button>
    </div>
  @empty
    <p class="text-muted">Belum ada lagu favorit</p>
  @endforelse
</div>

{{-- ================= MINI PLAYER ================= --}}
<div id="miniPlayer" class="fixed-bottom">
  <div class="container-fluid px-4 py-2">

    <div class="player-grid">

      <div class="player-left">
        <img id="playerCover">
        <div>
          <div id="playerTitle">Judul</div>
          <small id="playerArtist">Artist</small>
        </div>
      </div>

      <div class="player-center">
        <div class="controls">
          <button id="shuffleBtn" class="icon-btn">
            <i class="bi bi-shuffle"></i>
          </button>

          <div class="controls">
  <button class="icon-btn" onclick="prevSong()">
    <i class="bi bi-skip-start-fill"></i>
  </button>

  <!-- INI YANG PENTING -->
  <button id="playPauseBtn" class="play-btn" onclick="togglePlay()">
    <i class="bi bi-play-fill"></i>
  </button>

  <button class="icon-btn" onclick="nextSong()">
    <i class="bi bi-skip-end-fill"></i>
  </button>
</div>


          <button class="icon-btn">
            <i class="bi bi-arrow-repeat"></i>
          </button>
        </div>

        <div class="progress-wrap">
          <small id="currentTime">0:00</small>
          <input type="range" id="progressBar" min="0" value="0">
          <small id="duration">0:00</small>
        </div>
      </div>

      <div></div>
    </div>

  </div>
</div>

<audio id="audio"></audio>

{{-- ===== PHP PREPARE DATA (ANTI PARSE ERROR) ===== --}}
@php
$playlistData = [];
foreach ($favorites as $s) {
  $playlistData[] = [
    'title'  => $s->title,
    'artist' => $s->artist,
    'url'    => $s->audio_url,
    'cover'  => $s->cover
      ? asset('storage/'.$s->cover)
      : asset('storage/img/logo.jpg'),
  ];
}
@endphp

<script>
const playlist = @json($playlistData);

const audio = document.getElementById('audio');
const miniPlayer = document.getElementById('miniPlayer');
const playIcon = document.querySelector('#playPauseBtn i');

const progressBar = document.getElementById('progressBar');
const currentTime = document.getElementById('currentTime');
const duration = document.getElementById('duration');

let currentIndex = -1;
let isPlaying = false;

/* =========================
   PLAY SONG
========================= */
function playSong(index) {
  currentIndex = index;
  const song = playlist[index];

  playerTitle.innerText = song.title;
  playerArtist.innerText = song.artist;
  playerCover.src = song.cover;

  audio.src = song.url;
  audio.play();

  isPlaying = true;
  playIcon.className = 'bi bi-pause-fill';
  miniPlayer.classList.add('show');
}


/* =========================
   TOGGLE PLAY
========================= */
function togglePlay() {
  if (!audio.src) return;

  if (isPlaying) {
    audio.pause();
    playIcon.className = 'bi bi-play-fill';
  } else {
    audio.play();
    playIcon.className = 'bi bi-pause-fill';
  }

  isPlaying = !isPlaying;
}


/* =========================
   NEXT / PREV
========================= */
function nextSong() {
  if (!playlist.length) return;
  currentIndex = (currentIndex + 1) % playlist.length;
  playSong(currentIndex);
}

function prevSong() {
  if (!playlist.length) return;
  currentIndex = (currentIndex - 1 + playlist.length) % playlist.length;
  playSong(currentIndex);
}

/* =========================
   AUTO NEXT
========================= */
audio.addEventListener('ended', () => {
  miniPlayer.classList.remove('playing');
  playIcon.className = 'bi bi-play-fill';
  nextSong();
});

/* =========================
   PROGRESS BAR
========================= */
audio.addEventListener('loadedmetadata', () => {
  progressBar.max = Math.floor(audio.duration);
  duration.innerText = formatTime(audio.duration);
});

audio.addEventListener('timeupdate', () => {
  progressBar.value = Math.floor(audio.currentTime);
  currentTime.innerText = formatTime(audio.currentTime);
});

progressBar.addEventListener('input', () => {
  audio.currentTime = progressBar.value;
});

/* =========================
   FORMAT TIME
========================= */
function formatTime(sec) {
  if (isNaN(sec)) return "0:00";
  const m = Math.floor(sec / 60);
  const s = Math.floor(sec % 60).toString().padStart(2, '0');
  return `${m}:${s}`;
}
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>