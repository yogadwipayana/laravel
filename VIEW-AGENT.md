# Sistem Pemesanan Meja Restoran - Dokumentasi Lengkap

**Status:** v1.0 - Final  
**Last Updated:** Desember 2024  
**Framework:** Laravel  
**Database:** MySQL/PostgreSQL  

---

## 📋 Daftar Isi

1. [Landing Page](#1-landing-page)
2. [Booking List (Admin)](#2-booking-list-admin)
3. [Add Booking (Admin)](#3-add-booking-admin)
4. [Edit Booking (Admin)](#4-edit-booking-admin)
5. [Booking Detail (Admin)](#5-booking-detail-admin)
6. [Admin Dashboard](#6-admin-dashboard)
7. [Login Admin](#7-login-admin)
8. [API Endpoints](#8-api-endpoints-opsional--untuk-spaajax)
9. [Struktur Database](#9-struktur-database)

---

## 📊 Ringkasan Fitur

### User Flows

```
┌─────────────────────────────────────────────────────────────┐
│                     SISTEM BOOKING MEJA                      │
└─────────────────────────────────────────────────────────────┘

    ┌──────────────────┐
    │ Landing Page (/) │
    └────────┬─────────┘
             │
    ┌────────▼─────────────────────────┐
    │ User Lihat Info + CTA Buttons    │
    │ ├─ WhatsApp (Direct Chat)        │
    │ └─ Form Booking (di landing)     │
    └────────┬─────────────────────────┘
             │
    ┌────────▼──────────────────────────┐
    │ Booking Masuk ke Database         │
    │ Status: PENDING                   │
    └────────┬──────────────────────────┘
             │
    ┌────────▼──────────────────────────┐
    │ Admin Panel (/admin)              │
    │ ├─ Dashboard (statistik)          │
    │ ├─ Booking List (tabel)           │
    │ ├─ Detail & Edit Booking          │
    │ └─ Ubah Status + Send Confirmation│
    └────────┬──────────────────────────┘
             │
    ┌────────▼──────────────────────────┐
    │ Customer Notifikasi (WhatsApp)    │
    │ Status: CONFIRMED                 │
    └──────────────────────────────────┘
```

### Technology Stack

| Layer | Tools |
|-------|-------|
| **Backend** | Laravel 10+ / 11 |
| **Database** | MySQL 8.0+ / PostgreSQL |
| **Frontend** | TailwindCSS / Bootstrap 5 |
| **Auth** | Laravel Sanctum / Breeze |
| **APIs** | RESTful JSON |
| **Testing** | PHPUnit / Pest |
| **Deployment** | Apache / Nginx / Docker |

---

# Sistem Pemesanan Meja Restoran - Dokumentasi Fitur

Panduan lengkap fitur per halaman untuk sistem pemesanan meja restoran berbasis Laravel.

---

## 1. Landing Page

### Informasi Teknis

| Properti | Nilai |
|----------|-------|
| **Route** | `/wbs` |
| **Controller** | `LandingController@index` |
| **Auth** | Public |
| **Method** | GET |

### Tujuan Halaman

Menampilkan profil restoran (contoh: *Warung Bali Sangeh*) dan memudahkan pengunjung melakukan reservasi melalui WhatsApp atau form booking. Halaman juga menampilkan informasi penting (jam operasional, lokasi, menu unggulan, dan galeri).

### Struktur Konten

- Hero Section: judul, tagline, gambar latar berkualitas, CTA utama.
- Informasi Restoran: jam operasional, alamat, embed Google Maps.
- Highlight Menu: 3–6 item best-seller dalam layout card.
- Galeri Foto: beberapa kategori (suasana, fasilitas, makanan, exterior).
- CTA Floating (WhatsApp) untuk akses cepat.
- (Opsional) Form Booking untuk input langsung dari pengunjung.

### Hero Section (Contoh)

- **H1:** Warung Bali Sangeh
- **Tagline:** Nikmati spesialis Ikan Nyat-Nyat & pemandangan sawah.
- **CTA:** `Pesan Meja Sekarang` → buka WhatsApp atau modal booking.

### Call-to-Action (WhatsApp)

Gunakan URL WhatsApp dengan pesan template yang ter-encode. Contoh:

```text
https://wa.me/6281234567890?text=Om%20Swastiastu%2C%20saya%20ingin%20reservasi%20di%20Warung%20Bali%20Sangeh%20pada%20tanggal%20%5BTANGGAL%5D%20pukul%20%5BTIME%5D%20untuk%20%5BJUMLAH%5D%20orang.
```

Catatan:
- Pastikan nomor bisnis dalam format internasional tanpa tanda plus (contoh: `628...`).
- Encode spasi dan karakter khusus agar tautan berfungsi.

### Form Booking (Opsional)

Gunakan form singkat dengan validasi client/server. Contoh field:

| Field | Tipe | Validasi |
|-------|------|----------|
| Nama | text | required, min:3 |
| Nomor Telepon | tel | required, regex `^(\+62|0)[0-9]{9,12}$` |
| Tanggal | date | required, >= hari esok |
| Jam | time | required, dalam jam operasional |
| Jumlah Orang | number | required, 1-50 |
| Catatan | textarea | optional, max:500 |

Action:
- Submit ke: `POST /api/bookings`
- Respon sukses: 201 + toast/alert dan opsi redirect.

### Mobile Floating CTA

- Posisi: pojok kanan bawah (fixed)
- Ikon: WhatsApp
- Aksi: buka WhatsApp atau modal booking

### Flow Singkat Pengguna

```text
User membuka Landing Page (/wbs)
  ↓
  ├─ Melihat hero, info, galeri
  ├─ Klik WhatsApp CTA → membuka chat dengan template pesan
  └─ (Opsional) Isi Form Booking → Submit → tersimpan (status: pending)
```

---

## 2. Booking List (Admin)

### Informasi Teknis

| Properti | Nilai |
|----------|-------|
| **Route** | `/admin/bookings` |
| **Controller** | `BookingController@index` |
| **Auth** | Admin Only (middleware: auth, role:admin) |
| **Method** | GET |

### Tujuan Halaman

Menampilkan seluruh daftar booking yang masuk dari WhatsApp, telepon, atau form landing page dalam satu dashboard terpusat.

### Fitur Utama

#### 1. Tabel Booking

| Kolom | Deskripsi | Keterangan |
|-------|-----------|-----------|
| **ID** | ID Booking unik | Auto-increment dari database |
| **Nama Pelanggan** | Nama lengkap pemesan | Clickable → Detail booking |
| **Nomor Telepon** | Kontak WhatsApp/telepon | Clickable → Buka WhatsApp |
| **Tanggal Booking** | Tanggal pemesanan meja | Format: DD/MM/YYYY |
| **Jam Booking** | Jam kedatangan | Format: HH:MM |
| **Jumlah Orang** | Kapasitas | 1-50 orang |
| **Status** | Status booking | pending, confirmed, completed, cancelled |
| **Aksi** | Tombol action | Detail, Edit, Delete |

**Status Booking:**
- **pending** - Belum dikonfirmasi (warna: kuning/warning)
- **confirmed** - Sudah dikonfirmasi admin (warna: hijau/success)
- **completed** - Sudah datang (warna: biru/info)
- **cancelled** - Dibatalkan (warna: merah/danger)

#### 2. Filter & Pencarian

**Filter Berdasarkan:**
- Tanggal (from-to date range picker)
- Status (dropdown: all, pending, confirmed, completed, cancelled)
- Nama/Telepon (search bar)

**Urutan Default:** Tanggal terbaru dahulu (DESC)

#### 3. Pagination

- Menampilkan 10-50 item per halaman (user dapat pilih)
- Total data ditampilkan
- Navigation: Previous, halaman aktif, Next

#### 4. Tombol Aksi

- **+ Tambah Booking Baru** - Tombol di atas tabel (hijau/primary)
  - Navigasi ke: `/admin/bookings/create`
  - Untuk input manual pemesanan via telepon
  
- **Detail** - Lihat detail lengkap booking
  - Navigasi ke: `/admin/bookings/{id}`
  
- **Edit** - Edit informasi booking
  - Navigasi ke: `/admin/bookings/{id}/edit`
  - Hanya untuk booking yang masih pending/confirmed
  
- **Delete** - Hapus booking (dengan konfirmasi)
  - Request method: DELETE
  - Require password confirmation atau 2FA (opsional)

### Flow Admin Diagram
```
Admin Masuk Dashboard
    ↓
    /admin/bookings (Booking List)
    ↓
    ├─→ Lihat tabel dengan filter
    │    ├─→ Filter by tanggal/status
    │    ├─→ Search by nama/telepon
    │    └─→ Pagination
    │
    ├─→ Klik Detail → Lihat selengkapnya & ubah status
    │
    ├─→ Klik Edit → Ubah data booking
    │
    └─→ Klik Delete → Hapus booking
         (+ modal konfirmasi)
```



---

## 3. Add Booking (Admin)

### Informasi Teknis

| Properti | Nilai |
|----------|-------|
| **Route** | `/admin/bookings/create` |
| **Controller** | `BookingController@create` (GET), `BookingController@store` (POST) |
| **Auth** | Admin Only |
| **Method** | GET (form), POST (submit) |

### Tujuan Halaman

Memberikan form untuk admin/staff memasukkan booking manual dari pesanan melalui telepon, chat langsung, atau bantuan customer yang datang langsung.

### Fitur Utama

#### 1. Form Input

| Field | Tipe | Validasi | Keterangan |
|-------|------|----------|-----------|
| **Nama Pelanggan** | Text Input | Required, min 3, max 100 | Nama lengkap pemesan |
| **Nomor Telepon** | Text Input | Required, format +62/08 | Nomor WhatsApp/HP aktif |
| **Tanggal Booking** | Date Picker | Required, ≥ hari esok | Tanggal meja dipakai |
| **Jam Booking** | Time Picker | Required, sesuai jam operasional | HH:MM (01:00-23:00) |
| **Jumlah Orang** | Number Input | Required, 1-50 | Kapasitas meja |
| **Catatan** | Textarea | Optional, max 500 | Preferensi khusus/alergi |
| **Status** | Dropdown | Default: pending | pending/confirmed/completed |

#### 2. Validasi

**Client-side Validation:**
- Field required check
- Format telepon (menggunakan regex atau library)
- Min-Max karakter
- Date picker hanya bisa pilih tanggal valid

**Server-side Validation (Laravel):**
```php
$validated = $request->validate([
    'name' => 'required|string|min:3|max:100',
    'phone' => 'required|regex:/^(\+62|0)[0-9]{9,12}$/',
    'date' => 'required|date|after:today',
    'time' => 'required|date_format:H:i',
    'people' => 'required|integer|between:1,50',
    'notes' => 'nullable|string|max:500',
    'status' => 'in:pending,confirmed,completed,cancelled'
]);
```

#### 3. Tombol Aksi

| Tombol | Fungsi | Validasi |
|--------|--------|----------|
| **Simpan Booking** | POST ke `/admin/bookings` | Validasi server |
| **Batal** | Kembali ke `/admin/bookings` | Tanpa perubahan |
| **Reset Form** | Kosongkan semua field | Konfirmasi (opsional) |

#### 4. Hasil Submit

**Jika Valid:**
- Booking tersimpan di database
- Redirect ke `/admin/bookings` atau `/admin/bookings/{id}`
- Toast notifikasi: "Booking berhasil ditambahkan"
- (Opsional) Kirim WhatsApp notifikasi ke customer

**Jika Ada Error:**
- Tampilkan pesan error per field
- Form tidak kosong (preserve data yang sudah diinput)
- Scroll ke field yang error

### Flow Form Diagram
```
Admin Klik "Tambah Booking"
    ↓
    /admin/bookings/create
    ↓
    Tampilkan Form Kosong
    ↓
    Admin Isi Data:
    ├─ Nama
    ├─ Nomor Telepon
    ├─ Tanggal
    ├─ Jam
    ├─ Jumlah Orang
    ├─ Catatan (opsional)
    └─ Status (default: pending)
    ↓
    Klik "Simpan Booking"
    ↓
    Server Validasi
    ├─ ✓ Valid → Simpan & Redirect ke List
    └─ ✗ Invalid → Tampilkan Error & Kembalikan Form
```



---

## 4. Edit Booking (Admin)

### Informasi Teknis

| Properti | Nilai |
|----------|-------|
| **Route** | `/admin/bookings/{id}/edit` |
| **Controller** | `BookingController@edit` (GET), `BookingController@update` (PUT/PATCH) |
| **Auth** | Admin Only |
| **Method** | GET (form), PUT/PATCH (submit) |

### Tujuan Halaman

Memungkinkan admin mengubah data booking yang sudah tercatat, misalnya perubahan tanggal, jam, atau jumlah orang dari pelanggan.

### Fitur Utama

#### 1. Form Edit (Pre-filled dengan data existing)

Sama dengan form Add Booking, tetapi:
- Semua field sudah terisi dengan data lama
- Field **Nama** dan **Nomor Telepon** bisa diubah (atau readonly, tergantung policy)
- Field yang dapat diubah:

| Field | Dapat Diubah | Keterangan |
|-------|--------------|-----------|
| **Nama** | ✓ | Bisa dirubah |
| **Nomor Telepon** | ✓ | Bisa dirubah |
| **Tanggal Booking** | ✓ | Dapat disesuaikan |
| **Jam Booking** | ✓ | Dapat disesuaikan |
| **Jumlah Orang** | ✓ | Dapat disesuaikan |
| **Catatan** | ✓ | Dapat ditambah/diubah |
| **Status** | ✓ | pending → confirmed → completed → cancelled |

#### 2. Validasi & Aturan

**Pembatasan Perubahan (Business Logic):**
- Booking dengan status **completed** atau **cancelled** tidak bisa diubah (readonly/disabled)
- Tanggal tidak boleh kurang dari hari ini
- Jam harus sesuai jam operasional restoran
- Jumlah orang minimal 1, maksimal 50

#### 3. Tombol Aksi

| Tombol | Fungsi | Kondisi |
|--------|--------|---------|
| **Update Booking** | PATCH ke `/admin/bookings/{id}` | Validasi server |
| **Batal** | Kembali ke `/admin/bookings` | Tanpa perubahan |
| **Hapus Booking** | Modal konfirmasi delete | Danger action (merah) |

#### 4. Audit Log (Opsional tapi Disarankan)

Tambahkan di bagian bawah form:
- Dibuat pada: {created_at}
- Diubah terakhir: {updated_at}
- Diubah oleh: {admin_name}

### Flow Edit Diagram
```
Admin Klik "Edit" pada Booking List
    ↓
    /admin/bookings/{id}/edit
    ↓
    Load Data dari Database
    ↓
    Tampilkan Form dengan Data Lama:
    ├─ Nama: "Budi Santoso"
    ├─ Telepon: "081234567890"
    ├─ Tanggal: "2024-12-15"
    ├─ Jam: "19:00"
    ├─ Orang: "6"
    ├─ Catatan: "Kursi tinggi untuk anak"
    └─ Status: "confirmed"
    ↓
    Admin Ubah Sebagian Data (misal: jam 19:00 → 20:00)
    ↓
    Klik "Update Booking"
    ↓
    Server Validasi
    ├─ ✓ Valid → Update Database & Redirect
    │          → Toast: "Booking berhasil diubah"
    └─ ✗ Invalid → Tampilkan Error
```



---

## 5. Booking Detail (Admin)

### Informasi Teknis

| Properti | Nilai |
|----------|-------|
| **Route** | `/admin/bookings/{id}` |
| **Controller** | `BookingController@show` |
| **Auth** | Admin Only |
| **Method** | GET |

### Tujuan Halaman

Menampilkan detail lengkap satu booking dan memungkinkan admin melakukan aksi cepat seperti perubahan status dan pengiriman konfirmasi WhatsApp.

### Fitur Utama

#### 1. Informasi Detail Booking

**Card/Section dengan Layout Rapi:**

| Informasi | Deskripsi |
|-----------|-----------|
| **ID Booking** | #BOOKING-2024-12-001 |
| **Nama Pelanggan** | Nama lengkap pemesan |
| **Nomor Telepon** | Format clickable → WhatsApp |
| **Tanggal Booking** | DD/MM/YYYY |
| **Jam Booking** | HH:MM |
| **Jumlah Orang** | {jumlah} orang |
| **Catatan Khusus** | Deskripsi/preferensi |
| **Status Saat Ini** | Badge dengan warna sesuai status |
| **Tanggal Dibuat** | {created_at} oleh {creator} |
| **Diubah Terakhir** | {updated_at} oleh {last_editor} |

#### 2. Tombol Aksi Cepat

| Aksi | Fungsi | Navigasi |
|-----|--------|----------|
| **Edit Booking** | Ubah data booking | `/admin/bookings/{id}/edit` |
| **Ubah Status** | Dropdown/Modal select status | PATCH `/admin/bookings/{id}/status` |
| **Kirim Konfirmasi WA** | Kirim pesan ke WhatsApp | POST `/admin/bookings/{id}/send-wa` |
| **Kembali ke List** | Kembali | `/admin/bookings` |
| **Hapus Booking** | Delete dengan konfirmasi | DELETE `/admin/bookings/{id}` |

#### 3. Quick Status Update

**Dropdown/Button Group untuk Ubah Status:**
- pending → confirmed (tombol hijau)
- confirmed → completed (tombol biru)
- any status → cancelled (tombol merah)

**Efek Update:**
- Badge status berubah langsung
- Toast notifikasi sukses
- Log perubahan status terekam

#### 4. WhatsApp Integration (Opsional)

**Tombol "Kirim Konfirmasi via WhatsApp":**
- Format Pesan Template:
  ```
  Halo {nama}, terima kasih telah booking meja kami.
  
  Konfirmasi Pemesanan:
  📅 Tanggal: {tanggal}
  🕐 Jam: {jam}
  👥 Jumlah Orang: {jumlah}
  
  Mohon tiba 5-10 menit lebih awal.
  Silakan hubungi kami jika ada perubahan.
  
  Terima kasih! 🙏
  ```
- URL: `https://wa.me/{phone}?text={encoded_message}`
- Buka di tab baru (user confirm manual)
- (Opsional) Catat di history jika sudah terkirim

#### 5. Riwayat Perubahan (Audit Log - Optional tapi Recommended)

**Tabel Kecil berisi:**
| Waktu | Admin | Aksi | Detail |
|-------|-------|------|--------|
| 2024-12-10 19:00 | Admin Budi | Created | Booking dibuat via form |
| 2024-12-10 20:15 | Admin Ani | Status Changed | pending → confirmed |
| 2024-12-11 10:00 | Admin Budi | Modified | Jumlah orang: 4 → 6 |

### Flow Detail Diagram
```
Admin Klik Nama pada Booking List
    ↓
    /admin/bookings/{id}
    ↓
    Load Data dari Database
    ↓
    Tampilkan Detail Lengkap:
    ├─ Informasi dasar booking
    ├─ Status badge
    ├─ Tanggal dibuat/diubah
    └─ Riwayat perubahan (opsional)
    ↓
    Admin Dapat:
    ├─ Klik Edit → Update ke halaman edit
    ├─ Ubah Status (dropdown) → Update instant
    ├─ Kirim WA → Buka template pesan
    └─ Hapus (dengan konfirmasi)
```



---

## 6. Admin Dashboard

### Informasi Teknis

| Properti | Nilai |
|----------|-------|
| **Route** | `/admin` atau `/admin/dashboard` |
| **Controller** | `AdminController@index` atau `DashboardController@index` |
| **Auth** | Admin Only |
| **Method** | GET |

### Tujuan Halaman

Memberikan overview cepat (snapshot) mengenai status booking dan statistik operasional restoran, sehingga admin dapat melihat situasi real-time tanpa harus membuka setiap halaman.

### Fitur Utama

#### 1. Statistik Kartu (KPI Cards)

**Tampilkan dalam 4 atau 5 kartu besar:**

| Kartu | Metrik | Contoh | Navigasi |
|-------|--------|--------|----------|
| **Booking Hari Ini** | Jumlah booking tanggal hari ini | 8 bookings | → Booking List filtered by today |
| **Booking Minggu Ini** | Jumlah booking 7 hari ke depan | 42 bookings | → Booking List filtered by week |
| **Status Pending** | Booking belum dikonfirmasi | 5 bookings | → Booking List filtered by pending |
| **Status Confirmed** | Booking sudah dikonfirmasi | 15 bookings | → Booking List filtered by confirmed |
| **Total Orang (Hari Ini)** | Total kapasitas booking hari ini | 156 orang | Info only |

**Visual:**
- Setiap kartu menampilkan angka besar dan label jelas
- Warna berbeda per kartu (biru, hijau, kuning, merah, ungu)
- Klik kartu → navigate ke filtered view

#### 2. Kalender Booking (Opsional)

**Mini Calendar:**
- Tampilkan bulan saat ini
- Highlight tanggal yang ada booking
- Warna semakin gelap = semakin banyak booking
- Klik tanggal → Lihat booking detail hari tersebut

#### 3. Grafik Mingguan (Opsional)

**Bar/Line Chart - Booking 7 Hari Terakhir:**
- X-axis: Hari (Sen-Min)
- Y-axis: Jumlah booking
- Gunakan library: Chart.js atau ApexCharts
- Hover tooltip: detail per hari

**Grafik Status Pie/Donut:**
- 4 segmen: pending, confirmed, completed, cancelled
- Persentase masing-masing
- Total di tengah (jika donut chart)

#### 4. Quick Actions (Opsional)

**Tombol Shortcut:**
- ➕ Tambah Booking Baru → `/admin/bookings/create`
- 📊 Lihat Semua Booking → `/admin/bookings`
- 📋 Export Laporan → Export to PDF/Excel
- ⚙️ Pengaturan Restoran → Settings page

#### 5. Recent Bookings (Widget)

**Tabel Kecil - 5 Booking Terakhir:**

| Nama | Tanggal | Jam | Orang | Status | Aksi |
|------|---------|-----|-------|--------|------|
| Adi Kurniawan | 2024-12-12 | 19:00 | 4 | pending | Detail |
| Siti Nurhaliza | 2024-12-12 | 20:00 | 6 | confirmed | Detail |
| ... | ... | ... | ... | ... | ... |

Klik nama → detail, klik "Lihat Semua" → ke booking list

### Flow Dashboard Diagram
```
Admin Login & Masuk Dashboard
    ↓
    /admin
    ↓
    Load Statistik & Data dari Database
    ↓
    Tampilkan:
    ├─ 5 Kartu Statistik
    │  ├─ Booking Hari Ini: 8
    │  ├─ Booking Minggu Ini: 42
    │  ├─ Pending: 5
    │  ├─ Confirmed: 15
    │  └─ Total Orang: 156
    │
    ├─ Kalender (opsional)
    │
    ├─ Grafik Mingguan (opsional)
    │
    └─ Daftar 5 Booking Terakhir
    ↓
    Admin Dapat:
    ├─ Klik kartu → Filter view di booking list
    ├─ Klik nama booking → detail
    ├─ Klik "Lihat Semua" → ke booking list
    └─ Klik button "Tambah" → create booking
```



---

## 7. Login Admin

### Informasi Teknis

| Properti | Nilai |
|----------|-------|
| **Route** | `/login` |
| **Controller** | Laravel Native |
| **Auth** | Public (Unauthenticated) |
| **Method** | GET (form), POST (submit) |

### Tujuan Halaman

Mengotentikasi admin sebelum mengakses dashboard dan fitur admin lainnya. Menggunakan email dan password untuk keamanan.

### Fitur Utama

#### 1. Form Login

| Field | Tipe | Validasi |
|-------|------|----------|
| **Email** | Email Input | Required, valid email format |
| **Password** | Password Input | Required, min 6 karakter |
| **Remember Me** | Checkbox | Optional, untuk remember token |

#### 2. Validasi

**Client-side:**
- Email format validation
- Password field tidak kosong

**Server-side:**
```php
$validated = $request->validate([
    'email' => 'required|email|exists:users,email',
    'password' => 'required|string|min:6',
]);

// Authenticate
if (Auth::attempt($validated, $request->boolean('remember'))) {
    $request->session()->regenerate();
    return redirect()->intended('/admin');
}

// Failed
return back()->withErrors(['email' => 'Invalid credentials.']);
```

#### 3. Tombol Aksi

| Tombol | Fungsi |
|--------|--------|
| **Login** | POST `/login` dengan validasi |
| **Register** (opsional) | Link ke halaman register (admin saja, bukan public) |
| **Lupa Password?** (opsional) | Link ke password reset form |

#### 4. Keamanan

**Implementasi:**
- CSRF token protection (Laravel default)
- Rate limiting untuk brute force prevention
- Password hashing (bcrypt)
- Session management
- (Opsional) 2FA / SMS verification

**Middleware Protection:**
- Route `/admin/*` harus ter-protect dengan middleware `auth` dan `role:admin`
- Redirect ke login jika belum authenticated
- Logout button di setiap halaman admin

#### 5. User Model (Database)

```php
// users table fields
- id (int, primary key)
- name (string)
- email (string, unique)
- password (string, hashed)
- role (enum: admin, staff, customer) // opsional, default: admin
- is_active (boolean, default: true)
- remember_token (string, nullable)
- created_at (timestamp)
- updated_at (timestamp)
```

### Flow Login Diagram
```
User Akses /admin
    ↓
    Belum Login?
    ├─ ✓ Ya → Redirect ke /login
    └─ ✗ Tidak → Langsung ke dashboard
    ↓
    /login (Login Form)
    ↓
    User Input:
    ├─ Email: admin@restoran.com
    ├─ Password: ••••••••
    └─ ☑ Remember Me
    ↓
    Klik "Login"
    ↓
    Server Validasi Credentials
    ├─ ✓ Valid → Create Session & Redirect ke /admin
    │           → Dashboard Admin
    └─ ✗ Invalid → Tampilkan Error "Email/Password salah"
                   → Kembali ke form login
    ↓
    Admin Dapat Logout
    └─ POST /logout → Destroy session & Redirect ke login
```

### Relasi dengan Route Protection

**Middleware Stack:**
```php
// routes/web.php

// Public Routes
Route::get('/', [LandingController::class, 'index']);
Route::post('/api/bookings', [BookingController::class, 'store']); // Landing form

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Admin Routes (Protected)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [DashboardController::class, 'index']);
    Route::resource('/admin/bookings', BookingController::class);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
```



---

## 8. API Endpoints (Opsional - Untuk SPA/AJAX)

### Deskripsi

Jika ingin menggunakan frontend framework seperti Vue.js, React, atau Alpine.js untuk admin panel, berikut adalah API endpoints yang diperlukan dengan format JSON RESTful.

### Informasi Teknis

| Properti | Nilai |
|----------|-------|
| **Base URL** | `/api/` |
| **Auth** | Bearer Token / Session (middleware: auth, role:admin) |
| **Response Format** | JSON |
| **Error Handling** | HTTP Status Codes + JSON error messages |

### Endpoint List

#### 1. GET - Daftar Booking (List)

```
GET /api/bookings
```

**Query Parameters (Optional):**
```
?page=1&per_page=10&status=pending&date_from=2024-12-01&date_to=2024-12-31&search=nama
```

**Response Success (200):**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Budi Santoso",
      "phone": "081234567890",
      "date": "2024-12-12",
      "time": "19:00",
      "people": 4,
      "notes": "Kursi tinggi untuk anak",
      "status": "confirmed",
      "created_at": "2024-12-10T19:00:00Z",
      "updated_at": "2024-12-10T20:15:00Z"
    }
  ],
  "pagination": {
    "total": 50,
    "per_page": 10,
    "current_page": 1,
    "last_page": 5
  }
}
```

#### 2. POST - Tambah Booking (Create)

```
POST /api/bookings
Content-Type: application/json
```

**Request Body:**
```json
{
  "name": "Siti Nurhaliza",
  "phone": "082345678901",
  "date": "2024-12-13",
  "time": "20:00",
  "people": 6,
  "notes": "Alergi seafood",
  "status": "pending"
}
```

**Response Success (201):**
```json
{
  "success": true,
  "message": "Booking created successfully",
  "data": {
    "id": 51,
    "name": "Siti Nurhaliza",
    "phone": "082345678901",
    "date": "2024-12-13",
    "time": "20:00",
    "people": 6,
    "notes": "Alergi seafood",
    "status": "pending",
    "created_at": "2024-12-11T10:00:00Z"
  }
}
```

**Response Error (422):**
```json
{
  "success": false,
  "message": "Validation failed",
  "errors": {
    "phone": ["Format telepon tidak valid"],
    "people": ["Jumlah orang harus antara 1-50"]
  }
}
```

#### 3. GET - Detail Booking (Show)

```
GET /api/bookings/{id}
```

**Response Success (200):**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "name": "Budi Santoso",
    "phone": "081234567890",
    "date": "2024-12-12",
    "time": "19:00",
    "people": 4,
    "notes": "Kursi tinggi untuk anak",
    "status": "confirmed",
    "created_at": "2024-12-10T19:00:00Z",
    "updated_at": "2024-12-10T20:15:00Z"
  }
}
```

**Response Error (404):**
```json
{
  "success": false,
  "message": "Booking not found",
  "error_code": "BOOKING_NOT_FOUND"
}
```

#### 4. PUT/PATCH - Update Booking (Update)

```
PUT /api/bookings/{id}
Content-Type: application/json
```

**Request Body:** (hanya field yang ingin diubah)
```json
{
  "time": "20:00",
  "people": 5,
  "notes": "Tiba lebih awal"
}
```

**Response Success (200):**
```json
{
  "success": true,
  "message": "Booking updated successfully",
  "data": {
    "id": 1,
    "name": "Budi Santoso",
    "phone": "081234567890",
    "date": "2024-12-12",
    "time": "20:00",
    "people": 5,
    "notes": "Tiba lebih awal",
    "status": "confirmed",
    "updated_at": "2024-12-11T10:30:00Z"
  }
}
```

#### 5. DELETE - Hapus Booking (Delete)

```
DELETE /api/bookings/{id}
```

**Response Success (200):**
```json
{
  "success": true,
  "message": "Booking deleted successfully"
}
```

**Response Error (404):**
```json
{
  "success": false,
  "message": "Booking not found"
}
```

#### 6. PATCH - Update Status Booking (Special)

```
PATCH /api/bookings/{id}/status
Content-Type: application/json
```

**Request Body:**
```json
{
  "status": "confirmed"
}
```

**Response Success (200):**
```json
{
  "success": true,
  "message": "Status updated successfully",
  "data": {
    "id": 1,
    "status": "confirmed",
    "updated_at": "2024-12-11T10:45:00Z"
  }
}
```

### Authentication & Error Handling

**Header Authentication:**
```
Authorization: Bearer {access_token}
```

**Common HTTP Status Codes:**

| Code | Kondisi |
|------|---------|
| **200** | OK - Request berhasil |
| **201** | Created - Resource berhasil dibuat |
| **400** | Bad Request - Data format salah |
| **401** | Unauthorized - Token tidak valid/expired |
| **403** | Forbidden - Tidak punya akses (role check) |
| **404** | Not Found - Resource tidak ditemukan |
| **422** | Unprocessable Entity - Validasi gagal |
| **500** | Internal Server Error - Server error |

### Implementation in Laravel

**Routes (routes/api.php):**
```php
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::apiResource('bookings', BookingController::class);
    Route::patch('bookings/{id}/status', [BookingController::class, 'updateStatus']);
});
```

**Response Wrapper (Helper):**
```php
// Dalam controller
return response()->json([
    'success' => true,
    'data' => $booking,
    'message' => 'Success message'
], 200);
```



---

## 9. Struktur Database

### Tabel: bookings

**Deskripsi:** Menyimpan data seluruh pemesanan meja restoran.

| Field | Tipe | Constraint | Deskripsi |
|-------|------|-----------|-----------|
| **id** | bigInteger | Primary Key, Auto Increment | ID unik booking |
| **name** | string(100) | NOT NULL | Nama pelanggan pemesan |
| **phone** | string(20) | NOT NULL | Nomor telepon/WhatsApp |
| **date** | date | NOT NULL | Tanggal pemesanan meja |
| **time** | time | NOT NULL | Jam pemesanan meja (HH:MM) |
| **people** | integer | NOT NULL, between(1,50) | Jumlah orang |
| **notes** | text | Nullable | Catatan khusus/preferensi |
| **status** | enum | NOT NULL, default='pending' | Status booking (pending, confirmed, completed, cancelled) |
| **created_by** | bigInteger | Nullable, FK to users.id | Admin yang membuat (untuk manual input) |
| **created_at** | timestamp | NOT NULL, default=CURRENT_TIMESTAMP | Waktu booking dibuat |
| **updated_at** | timestamp | NOT NULL, default=CURRENT_TIMESTAMP | Waktu booking diubah terakhir |

**Migrations (Laravel):**
```php
Schema::create('bookings', function (Blueprint $table) {
    $table->id();
    $table->string('name', 100);
    $table->string('phone', 20);
    $table->date('date');
    $table->time('time');
    $table->integer('people')->between(1, 50);
    $table->text('notes')->nullable();
    $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled'])
        ->default('pending');
    $table->foreignId('created_by')->nullable()->constrained('users');
    $table->timestamps(); // created_at, updated_at
    
    $table->index('date');
    $table->index('status');
    $table->index('created_at');
});
```

### Tabel: users (Sudah Ada - DiPerluas)

**Deskripsi:** Menyimpan data admin dan user sistem.

| Field | Tipe | Constraint | Deskripsi |
|-------|------|-----------|-----------|
| **id** | bigInteger | Primary Key, Auto Increment | ID unik user |
| **name** | string(100) | NOT NULL | Nama lengkap user |
| **email** | string(255) | Unique, NOT NULL | Email login |
| **password** | string(255) | NOT NULL | Password hashed |
| **role** | enum | default='admin' | Role (admin, staff, customer) |
| **is_active** | boolean | default=true | Status aktif |
| **remember_token** | string | Nullable | Token remember me |
| **created_at** | timestamp | NOT NULL | Waktu user dibuat |
| **updated_at** | timestamp | NOT NULL | Waktu user diubah |

**Notes:** Tabel ini sudah di-generate otomatis oleh Laravel. Jika perlu menambah role, lakukan migration tambahan.

### Relasi Model (Eloquent)

**Booking Model:**
```php
class Booking extends Model {
    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by');
    }
    
    public function statusLogs() {
        return $this->hasMany(BookingStatusLog::class);
    }
}
```

**User Model:**
```php
class User extends Model {
    public function createdBookings() {
        return $this->hasMany(Booking::class, 'created_by');
    }
    
    public function statusChanges() {
        return $this->hasMany(BookingStatusLog::class, 'changed_by');
    }
}
```

### ERD (Entity Relationship Diagram)

```
┌─────────────────┐         ┌──────────────────────┐
│     users       │         │     bookings         │
├─────────────────┤         ├──────────────────────┤
│ id (PK)         │────────→│ id (PK)              │
│ name            │ 1    ∞ │ name                 │
│ email           │         │ phone                │
│ password        │         │ date                 │
│ role            │         │ time                 │
│ is_active       │         │ people               │
└─────────────────┘         │ notes                │
                            │ status               │
                            │ created_by (FK)      │
                            │ created_at           │
                            │ updated_at           │
                            └──────────────────────┘
                                    ↓ 1
                                    │ ∞
                            ┌──────────────────────┐
                            │ booking_status_logs  │
                            ├──────────────────────┤
                            │ id (PK)              │
                            │ booking_id (FK)      │
                            │ old_status           │
                            │ new_status           │
                            │ changed_by (FK)      │
                            │ notes                │
                            │ created_at           │
                            └──────────────────────┘
```


---