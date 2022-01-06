# Kabar Vaksin

Kabar vaksin adalah platform untuk berbagi kabar mengenai jadwal vaksinasi Covid-19.

## Getting Started

Untuk menjalankan project secara lokal, ikuti langkah-langkah dibawah.

Pertama, clone repository.

```bash
git clone https://github.com/najmulfaiz/uas-web.git
```

Kemudian, install dependencies dan jalankan migrate beserta seeder.

```bash
cd uas-web
composer install
php artisan migrate --seed
```

Terakhir, jalankan development server.

```bash
php artisan serve
```

Buka [http://localhost:8000](http://localhost:8000) dengan browser untuk melihat hasil.
