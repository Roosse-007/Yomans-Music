<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>YomansMusic</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('storage/css/style.css') }}">
</head>


<body style="background: linear-gradient(#131614, #000); min-height:100vh; color:white;">

<div class="container-md">

<nav class="navbar navbar-expand-lg bg-dark navbar-dark mt-3 rounded px-3">
  <div class="container-fluid">

    <a class="navbar-brand d-flex align-items-center gap-2" href="/">
      <img src="{{ asset('storage/img/YM.jpg') }}" height="40">
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

    <ul class="navbar-nav ms-auto gap-3">

      <li class="nav-item">
        <a class="nav-link" href="/">Beranda</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="/favorites">Favorit</a>
      </li>

     @auth
  <li class="nav-item d-flex align-items-center gap-2">

    {{-- FOTO USER KECIL --}}
    <img
      src="{{ auth()->user()->photo
        ? asset('storage/' . auth()->user()->photo)
        : asset('storage/img/avatardef.jpg') }}"
      class="user-photo-xs"
      alt="User Photo"
    >

    {{-- NAMA USER (TIDAK DIUBAH) --}}
    <a class="nav-link p-0" href="/account">
      {{ auth()->user()->name }}
    </a>

  </li>

  <li class="nav-item">
    <form action="/logout" method="POST">
      @csrf
      <button class="btn btn-link nav-link text-danger">
        Logout
      </button>
    </form>
  </li>
@endauth


      @guest
        <li class="nav-item">
          <a class="nav-link" href="/login">Login</a>
        </li>
      @endguest

    </ul>

  </div>
</nav>
