// Fungsi generic untuk mengambil dan menampilkan data JSON
async function muatData(namaFile, namaArray, kolom) {
  const tbody = document.querySelector(".table-responsive table tbody");
  const loading = document.getElementById("loading-indicator");

  if (!tbody) return;

  loading.style.display = "block";
  tbody.innerHTML = "";

  try {
    await new Promise((resolve) => setTimeout(resolve, 600));

    const res = await fetch("../data/" + namaFile);

    if (!res.ok) {
      throw new Error("Gagal mengambil data (status " + res.status + ")");
    }

    const data = await res.json();

    data.forEach(function (item) {
      const tr = document.createElement("tr");

      tr.innerHTML =
        "<td>" +
        item[kolom[0]] +
        "</td>" +
        "<td>" +
        item[kolom[1]] +
        "</td>" +
        "<td>" +
        item[kolom[2]] +
        "</td>" +
        "<td>" +
        item[kolom[3]] +
        "</td>" +
        "<td>" +
        item[kolom[4]] +
        "</td>" +
        "<td>" +
        '<button type="button">Edit</button> ' +
        '<button type="button" class="btn-hapus">Hapus</button>' +
        "</td>";

      tbody.appendChild(tr);
    });
  } catch (err) {
    tbody.innerHTML =
      '<tr><td colspan="6">Gagal memuat data: ' + err.message + "</td></tr>";
  } finally {
    loading.style.display = "none";
  }
}

// Memuat daftar buku
async function muatDaftarBuku() {
  await muatData("buku.json", "daftarBuku", [
    "judul",
    "pengarang",
    "tahun",
    "stok",
    "kategori",
  ]);
}

// Memuat daftar anggota
async function muatDaftarAnggota() {
  await muatData("anggota.json", "daftarAnggota", [
    "no_anggota",
    "nama",
    "alamat",
    "no_hp",
  ]);
}

// Menentukan data berdasarkan halaman
document.addEventListener("DOMContentLoaded", function () {
  if (document.title.includes("Daftar Buku")) {
    muatDaftarBuku();
  }

  if (document.title.includes("Daftar Anggota")) {
    muatDaftarAnggota();
  }
});
