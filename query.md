CREATE TABLE `kecamatan` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_kecamatan` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `ibu_kota_kecamatan` varchar(255) DEFAULT NULL,
  `nama_kepala_kecamatan` varchar(255) DEFAULT NULL,
  `foto_kepala_kecamatan` varchar(255) DEFAULT NULL,
  `foto_kantor` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `telp` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `peta_kecamatan` geometry DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `kelurahan` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `kecamatan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama_kelurahan` varchar(255) NOT NULL,
  `nama_kepala_kelurahan` varchar(255) DEFAULT NULL,
  `foto_kepala_kelurahan` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `telp` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `foto_kantor` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `jumlah_penduduk` varchar(255) DEFAULT NULL,
  `peta_kelurahan` geometry DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `perusahaan` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `kelurahan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama_perusahaan` varchar(255) NOT NULL,
  `npwp` varchar(20) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `telp` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `foto_perusahaan` varchar(255) DEFAULT NULL,
  `latitude` decimal(10, 8) DEFAULT NULL,
  `longitude` decimal(11, 8) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


```sql
INSERT INTO perusahaan (kelurahan_id, nama_perusahaan, alamat, latitude, longitude)
VALUES
    (9471020012, 'Saga Abe', 'Baru City, Abepura, Jayapura City', -2.610439808393208, 140.66544035323977),  
    (9471040001, 'Gramedia Jayapura', 'Jl. Dr. Sam Ratulangi No.5, Gurabesi, Kec. Jayapura Utara, Kota Jayapura', -2.5401993273171724, 140.70588016858272),
    (9471040002, 'Mall Jayapura', 'APO, Jl. Samratulangi, Bayangkara, Kec. Jayapura Utara, Kota Jayapura', -2.5349577715564253, 140.70654144715007),
    (9471040002, 'Swiss-BelHotel Jayapura', 'Pusat Bisnis Jayapura, Jl. Pacific Permai, Bayangkara, Kec. Jayapura Utara, Kota Jayapura', -2.538912018645308, 140.71164809741856);
```