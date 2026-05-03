# Batak Product API (Laravel - No Database)

## Deskripsi

API sederhana untuk manajemen produk berbasis Laravel tanpa database (menggunakan array sebagai penyimpanan data sementara).

Produk mengangkat tema **UMKM dan budaya Batak** seperti kain ulos dan makanan khas.

---

## Cara Menjalankan

```bash
composer install
php artisan serve
```

Akses:

```
http://127.0.0.1:8000/api/products
```

---

## Endpoint API

### 1. GET All Products

GET `/api/products`

### 2. GET Product by ID

GET `/api/products/{id}`

### 3. POST Create Product

POST `/api/products`

Body:

```json
{
  "name": "Ulos Sibolang",
  "price": 1200000,
  "stock": 10,
  "category": "Kain Tradisional",
  "origin": "Tapanuli"
}
```

### 4. PUT Update Full

PUT `/api/products/{id}`

### 5. PATCH Update Partial

PATCH `/api/products/{id}`

### 6. DELETE Product

DELETE `/api/products/{id}`

---

## Error Handling

Jika ID tidak ditemukan:

```json
{
  "status": "error",
  "message": "Item dengan ID tidak ditemukan"
}
```

---

## Teknologi

* Laravel
* PHP
* REST API
