<?php

require __DIR__ . '/includes/koneksi.php';

$file = __DIR__ . '/data/buku.json';

if (!file_exists($file)) {
    die("File buku.json tidak ditemukan.");
}

$json = file_get_contents($file);

$data = json_decode($json, true);

if (!is_array($data)) {
    die("Data JSON tidak valid.");
}

$stmt = $pdo->prepare(
    "INSERT INTO buku (judul, penulis, tahun_terbit)
     VALUES (:judul, :penulis, :tahun_terbit)"
);

foreach ($data as $buku) {
    $stmt->execute([
        'judul' => $buku['judul'] ?? '',
        'penulis' => $buku['penulis'] ?? '',
        'tahun_terbit' => $buku['tahun_terbit'] ?? null
    ]);
}

echo "Migrasi data buku berhasil.";