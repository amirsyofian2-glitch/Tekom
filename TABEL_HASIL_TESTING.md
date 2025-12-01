# LAPORAN HASIL PENGUJIAN BLACK BOX
## Sistem Inventaris Telekomunikasi (Tekom)

---

## RINGKASAN HASIL PENGUJIAN

| Informasi | Keterangan |
|-----------|------------|
| Total Pengujian | 43 |
| Berhasil | 43 |
| Gagal | 0 |
| Tingkat Keberhasilan | 100% |
| Waktu Pengujian | 11.05 detik |
| Database | MySQL (tekom_testing) |
| Metode Pengujian | Black Box Testing |
| Tanggal Pengujian | 24 November 2025 |

---

## HASIL PENGUJIAN

| No | Fitur yang Diuji | Yang Diuji | Cara Pengujian | Hasil | Catatan |
|----|------------------|------------|----------------|-------|---------|
| **1** | **Login dan Keamanan** | | | | |
| 1.1 | | Login dengan email yang salah | Memasukkan email yang tidak terdaftar | BERHASIL | Sistem menolak dan menampilkan pesan error |
| 1.2 | | Login dengan password yang salah | Memasukkan password yang tidak sesuai | BERHASIL | Sistem menolak dan menampilkan pesan error |
| 1.3 | | Akses halaman admin tanpa login | Mencoba membuka halaman admin tanpa login | BERHASIL | Sistem redirect ke halaman login |
| 1.4 | | Login dengan akun belum terverifikasi | Mencoba login dengan akun yang belum diverifikasi | BERHASIL | Sistem menolak akses |
| **2** | **Kelola Data Organisasi** | | | | |
| 2.1 | | Akses halaman organisasi tanpa login | Mencoba buka halaman tanpa login | BERHASIL | Sistem redirect ke login |
| 2.2 | | Tambah organisasi baru | Mengisi form dengan data lengkap dan valid | BERHASIL | Data tersimpan di database |
| 2.3 | | Edit data organisasi | Mengubah data organisasi yang sudah ada | BERHASIL | Perubahan tersimpan dengan baik |
| 2.4 | | Hapus data organisasi | Menghapus organisasi dari sistem | BERHASIL | Data terhapus (soft delete) |
| 2.5 | | Input tipe organisasi yang valid | Memilih tipe: POLDA, POLRES, dll | BERHASIL | Sistem menerima semua tipe valid |
| 2.6 | | Filter organisasi berdasarkan tipe | Mencoba filter data berdasarkan tipe | BERHASIL | Data terfilter sesuai pilihan |
| **3** | **Kelola Data Site** | | | | |
| 3.1 | | Tambah site baru | Mengisi form site dengan data lengkap | BERHASIL | Data tersimpan di database |
| 3.2 | | Edit data site | Mengubah informasi site yang ada | BERHASIL | Perubahan tersimpan dengan baik |
| 3.3 | | Hapus data site | Menghapus site dari sistem | BERHASIL | Data terhapus (soft delete) |
| 3.4 | | Input kepemilikan site | Memilih: POLRI, TELKOM, TVRI, INDOSAT, SWASTA, LAINNYA | BERHASIL | Semua pilihan kepemilikan berfungsi |
| **4** | **Kelola Data Tower** | | | | |
| 4.1 | | Tambah tower baru | Mengisi form tower dengan data lengkap | BERHASIL | Data tersimpan di database |
| 4.2 | | Edit data tower | Mengubah informasi tower yang ada | BERHASIL | Perubahan tersimpan dengan baik |
| 4.3 | | Hapus data tower | Menghapus tower dari sistem | BERHASIL | Data terhapus (soft delete) |
| 4.4 | | Input koordinat lokasi tower | Memasukkan latitude dan longitude | BERHASIL | Koordinat valid dan tersimpan |
| **5** | **Kelola Data Inventaris** | | | | |
| 5.1 | | Edit jumlah inventaris | Mengubah quantity barang | BERHASIL | Perubahan jumlah tersimpan |
| 5.2 | | Hapus data inventaris | Menghapus barang inventaris | BERHASIL | Data terhapus (soft delete) |
| 5.3 | | Tambah inventaris baru | Input data perangkat lengkap | BERHASIL | Data tersimpan, kode aset auto-generate |
| 5.4 | | Lihat detail inventaris | Klik item inventaris | BERHASIL | Detail informasi lengkap tampil |
| 5.5 | | Filter inventaris | Filter berdasarkan kondisi, lokasi, jenis | BERHASIL | Data terfilter sesuai kriteria |
| **6** | **API dan Komunikasi Data** | | | | |
| 6.1 | | API menampilkan data JSON | Mengakses endpoint API | BERHASIL | Response format JSON valid |
| 6.2 | | API dengan parameter yang benar | Mengirim request dengan parameter valid | BERHASIL | Data sesuai parameter ditampilkan |
| 6.3 | | API dengan parameter salah | Mengirim request dengan parameter invalid | BERHASIL | Sistem menampilkan pesan error |
| 6.4 | | Pagination API | Mengakses data dengan halaman | BERHASIL | Pagination berfungsi dengan baik |
| 6.5 | | Filter data di API | Mencoba filter data melalui API | BERHASIL | Filter berfungsi sesuai kriteria |
| 6.6 | | Pembatasan request API | Mengirim banyak request berturut-turut | BERHASIL | Rate limiting berfungsi |
| 6.7 | | Penanganan error API | Memicu error di API | BERHASIL | Error response sesuai format |
| **7** | **Hak Akses dan Permission** | | | | |
| 7.1 | | Tambah jenis perangkat baru | Input jenis perangkat | BERHASIL | Data tersimpan, bisa dipilih di inventaris |
| 7.2 | | Super admin punya semua akses | Login sebagai super admin dan cek permission | BERHASIL | Super admin memiliki semua permission |
| 7.3 | | Berikan permission ke user | Menambahkan permission langsung ke user | BERHASIL | Permission berhasil ditambahkan |
| 7.4 | | User tanpa permission ditolak | User tanpa akses coba buka fitur | BERHASIL | Sistem menolak akses |
| 7.5 | | Tambahkan role ke user | Memberikan role kepada user | BERHASIL | Role berhasil ditambahkan |
| 7.6 | | Permission dari role berfungsi | Cek apakah user dapat akses dari role | BERHASIL | Permission via role berfungsi |
| 7.7 | | User dengan banyak role | Berikan beberapa role ke satu user | BERHASIL | Semua role berfungsi bersamaan |
| **8** | **Generate Laporan** | | | | |
| 8.1 | | Generate laporan PDF | Pilih parameter laporan | BERHASIL | File PDF terdownload dengan data lengkap |
| 8.2 | | Laporan site jarkom | Generate laporan site tertentu | BERHASIL | PDF berisi data site dan tower terkait |
| **9** | **Dashboard dan Statistik** | | | | |
| 9.1 | | Akses halaman dashboard | Buka halaman dashboard | BERHASIL | Statistik dan chart tampil dengan data real |
| 9.2 | | Widget statistik dashboard | Cek widget statistik | BERHASIL | Angka sesuai total data di database |
| **10** | **Kelola User** | | | | |
| 10.1 | | Tambah user baru | Input data user dan role | BERHASIL | User created, bisa login dengan role sesuai |

---

## RINGKASAN HASIL

| Fitur yang Diuji | Total Test | Berhasil | Gagal | Persentase |
|------------------|------------|----------|-------|------------|
| Login dan Keamanan | 4 | 4 | 0 | 100% |
| Kelola Data Organisasi | 6 | 6 | 0 | 100% |
| Kelola Data Site | 4 | 4 | 0 | 100% |
| Kelola Data Tower | 4 | 4 | 0 | 100% |
| Kelola Data Inventaris | 5 | 5 | 0 | 100% |
| API dan Komunikasi Data | 7 | 7 | 0 | 100% |
| Hak Akses dan Permission | 7 | 7 | 0 | 100% |
| Generate Laporan | 2 | 2 | 0 | 100% |
| Dashboard dan Statistik | 2 | 2 | 0 | 100% |
| Kelola User | 1 | 1 | 0 | 100% |
| **TOTAL KESELURUHAN** | **43** | **43** | **0** | **100%** |

---

## CARA PENGUJIAN YANG DIGUNAKAN

| No | Metode | Penjelasan | Jumlah |
|----|--------|------------|--------|
| 1 | Equivalence Partitioning | Menguji dengan data yang valid dan tidak valid | 15 |
| 2 | Boundary Value Analysis | Menguji dengan nilai batas minimum dan maksimum | 7 |
| 3 | Decision Table Testing | Menguji berbagai kombinasi kondisi | 6 |
| 4 | State Transition Testing | Menguji perubahan status sistem | 1 |
| 5 | Input/Output Testing | Menguji data masuk dan keluar sistem | 5 |

---

## KESIMPULAN

Pengujian dilakukan terhadap 43 skenario pada sistem Inventaris Telekomunikasi dan **semua pengujian berhasil (100%)**. 

### Hasil Pengujian:
- Login dan Keamanan: 4 dari 4 berhasil ✓
- Kelola Data Organisasi: 6 dari 6 berhasil ✓
- Kelola Data Site: 4 dari 4 berhasil ✓
- Kelola Data Tower: 4 dari 4 berhasil ✓
- Kelola Data Inventaris: 5 dari 5 berhasil ✓
- API dan Komunikasi Data: 7 dari 7 berhasil ✓
- Hak Akses dan Permission: 7 dari 7 berhasil ✓
- Generate Laporan: 2 dari 2 berhasil ✓
- Dashboard dan Statistik: 2 dari 2 berhasil ✓
- Kelola User: 1 dari 1 berhasil ✓

### Penilaian Sistem:
**SANGAT BAIK** - Semua fitur berfungsi dengan baik, validasi data bekerja dengan benar, dan tidak ditemukan error dalam pengujian.

---

**Tanggal Pengujian:** 24 November 2025  
**Sistem:** Laravel 11.31 dengan Filament 4.0  
**Database:** MySQL 8.0  
**Metode:** Black Box Testing (Manual)
