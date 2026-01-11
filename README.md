# 🎵 YomansMusic API & Web App

YomansMusic adalah aplikasi **music streaming & playlist** berbasis **Laravel** yang menyediakan **REST API (JWT Authentication)** dan **Web Interface**. Pengguna atau admin dapat login, melihat lagu, memutar musik, serta menambahkan lagu ke playlist favorit menggunakan ikon ❤️.

---

## 🚀 Fitur Utama

### 👤 Authentication

* Login & Register User
* JWT Authentication (`tymon/jwt-auth`)
* Role-based Access (`admin` & `user`)

### 🎶 Music

* Daftar lagu,album & artis
* Streaming lagu (MP3)
* Detail lagu per artis

### ❤️ Playlist / Favorite

* Menambahkan lagu ke playlist melalui icon ❤️
* Semua lagu favorit otomatis masuk ke **Playlist milik user**
* Hanya user yang sudah login dapat membuat & mengelola playlist

### 🛡 Middleware & Security

* `auth:api` (JWT)
* `AdminMiddleware` untuk akses admin
* Proteksi route berbasis role

### 📜 Activity Log

* Mencatat aktivitas login user
* Siap dikembangkan untuk mencatat GET / POST / PUT / DELETE

---

## 🧱 Teknologi yang Digunakan

| Teknologi   | Keterangan         |
| ----------- | ------------------ |
| Laravel     | Backend Framework  |
| JWT Auth    | Authentication API |
| MySQL       | Database           |
| Bootstrap 5 | UI Web             |
| Blade       | Template Engine    |
| Postman     | API Testing        |

---

## 📂 Struktur Project

```
backend/
├── .github/
│   └── workflows/
│       ├── issues.yml
│       ├── pull-requests.yml
│       ├── tests.yml
│       └── update-changelog.yml
├── app/
│   ├── Exceptions/
│   │   └── Handler.php
│   ├── Helpers/
│   │   └── Activity_log.php
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── admin/
│   │   │   │   ├── AlbumController.php
│   │   │   │   ├── ArtistController.php
│   │   │   │   └── SongController.php
│   │   │   ├── Api/
│   │   │   │   ├── AlbumController.php
│   │   │   │   ├── ArtistController.php
│   │   │   │   ├── AuthController.php
│   │   │   │   ├── GenreController.php
│   │   │   │   ├── PlaylistController.php
│   │   │   │   ├── PlaylistSongController.php
│   │   │   │   └── SongController.php
│   │   │   ├── Web/
│   │   │   │   ├── AuthWebController.php
│   │   │   │   └── FavoritePageController.php
│   │   │   ├── Controller.php
│   │   │   ├── GenreController.php
│   │   │   └── HomeController.php
│   │   ├── Middleware/
│   │   │   ├── ActivityLogger.php
│   │   │   ├── AdminMiddleware.php
│   │   │   ├── Authenticate.php
│   │   │   ├── CorsMiddleware.php
│   │   │   ├── EncryptCookies.php
│   │   │   ├── LogAPI.php
│   │   │   ├── PreventRequestsDuringMaintenance.php
│   │   │   ├── RedirectIfAuthenticated.php
│   │   │   ├── TrimStrings.php
│   │   │   ├── TrustHosts.php
│   │   │   ├── TrustProxies.php
│   │   │   ├── ValidateSignature.php
│   │   │   └── VerifyCsrfToken.php
│   │   └── kernel.php
│   ├── Models/
│   │   ├── ActivityLog.php
│   │   ├── Album.php
│   │   ├── Artist.php
│   │   ├── Genre.php
│   │   ├── Playlist.php
│   │   ├── Song.php
│   │   └── User.php
│   └── Providers/
│       ├── AppServiceProvider.php
│       ├── AuthServiceProvider.php
│       ├── BroadcastServiceProvider.php
│       ├── EventServiceProvider.php
│       └── RouteServiceProvider.php
├── bootstrap/
│   ├── cache/
│   │   ├── .gitignore
│   │   ├── packages.php
│   │   └── services.php
│   ├── app.php
│   └── providers.php
├── config/
│   ├── app.php
│   ├── auth.php
│   ├── cache.php
│   ├── cors.php
│   ├── database.php
│   ├── filesystems.php
│   ├── jwt.php
│   ├── logging.php
│   ├── mail.php
│   ├── queue.php
│   ├── services.php
│   └── session.php
├── database/
│   ├── factories/
│   │   └── UserFactory.php
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 0001_01_01_000001_create_cache_table.php
│   │   ├── 0001_01_01_000002_create_jobs_table.php
│   │   ├── 2025_12_22_081009_...
│   │   ├── 2025_12_22_081010_...
│   │   ├── 2025_12_22_081011_...
│   │   ├── 2025_12_25_030829_...
│   │   ├── 2025_12_25_031203_...
│   │   ├── 2025_12_25_083252_...
│   │   ├── 2025_12_25_084625_...
│   │   ├── 2026_01_02_091654_...
│   │   └── 2026_01_03_071817_...
│   └── seeders/
│       ├── AlbumSeeder.php
│       ├── ArtistSeeder.php
│       ├── DatabaseSeeder.php
│       ├── GenreSeeder.php
│       ├── PlaylistSeeder.php
│       ├── SongSeeder.php
│       └── UserSeeder.php
├── public/
│   ├── storage/ (link)
│   ├── .htaccess
│   ├── favicon.ico
│   ├── index.php
│   └── robots.txt
├── resources/
│   ├── css/
│   │   └── app.css
│   ├── js/
│   │   ├── app.js
│   │   └── bootstrap.js
│   └── views/
│       ├── admin/
│       │   ├── album-edit.blade.php
│       │   ├── artist-show.blade.php
│       │   ├── create-album.blade.php
│       │   ├── create-artist.blade.php
│       │   ├── create-song.blade.php
│       │   ├── dashboard.blade.php
│       │   ├── edit-artist.blade.php
│       │   └── songs-index.blade.php
│       ├── frontend/
│       │   ├── account.blade.php
│       │   ├── favorites.blade.php
│       │   ├── home.blade.php
│       │   ├── login.blade.php
│       │   ├── navbar.blade.php
│       │   └── register.blade.php
│       └── welcome.blade.php
├── routes/
│   ├── api.php
│   ├── console.php
│   └── web.php
├── storage/
│   ├── app/
│   │   ├── private/
│   │   └── public/
│   │       ├── albums/
│   │       ├── artists/
│   │       ├── css/
│   │       │   └── style.css
│   │       ├── img/
│   │       ├── js/
│   │       │   ├── app.js
│   │       │   ├── auth.js
│   │       │   ├── main.js
│   │       │   └── player.js
│   │       ├── profile/
│   │       ├── songs/
│   │       └── video/
│   ├── framework/
│   └── logs/
│       ├── .gitignore
│       └── laravel.log
├── tests/
├── vendor/
├── .editorconfig
├── .env
├── .env.example
├── .gitattributes
├── .gitignore
├── .styleci.yml
├── artisan
├── CHANGELOG.md
├── composer.json
├── composer.lock
├── package.json
├── phpunit.xml
├── README.md
└── vite.config.js
```

---

## 🔐 Authentication (JWT)

Header wajib untuk API protected:

```
Authorization: Bearer <JWT_TOKEN>
```

Guard yang digunakan:

```
api (driver: jwt)
```

---

## 🧪 API Testing (Postman)

### 🔑 Login

```
POST /api/v1/login
```

Body:

```json
{
  "email": "bigboss@gmail.com",
  "password": "bigboss123"
}
```

### 👤 Get User

```
GET /api/v1/me
```

### 🎶 Get Songs

```
GET /api/v1/songs
```

### ❤️ Toggle Favorite / Playlist

```
POST /api/v1/playlist/favorite
```

Body:

```json
{
  "song_id": 1
}
```

---

## 🛠 Admin Middleware

```php
if (!Auth::guard('api')->check()) {
    abort(401);
}

if (Auth::guard('api')->user()->role !== 'admin') {
    abort(403);
}
```

---

## ⚠ Catatan Penting

* User **harus login** untuk:

  * Menambahkan lagu ke playlist
  * Mengakses halaman Favorite
* Jika halaman Favorite redirect ke Login:

  * Pastikan guard `api` digunakan
  * Token JWT valid

---

## 👨‍💻 Developer
Russependhy ikhtiar & Farhan ismail
Mahasiswa universitas bumigora
Project UAS 

---

✨ *YomansMusic – Stream Your Favorite Songs*
