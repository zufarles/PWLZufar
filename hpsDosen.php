<?php
require "fungsi.php"; // Pastikan Anda telah menyertakan file koneksi

// Dekripsi ID dari parameter GET
$npp = decrypturl($_GET["kode"]);

// Buat query SQL untuk mengambil data dosen
$q = "SELECT * FROM dosen WHERE npp = '" . mysqli_real_escape_string($koneksi, $npp) . "'";
$rs = mysqli_query($koneksi, $q);

// Periksa jika ada satu baris data yang sesuai
if(mysqli_num_rows($rs) == 1) {
    // Buat query SQL untuk menghapus data dosen
    $sql = "DELETE FROM dosen WHERE npp = '" . mysqli_real_escape_string($koneksi, $npp) . "'";
    
    // Eksekusi query penghapusan
    if (mysqli_query($koneksi, $sql)) {
        header("location: updateDosen.php");
        exit; // Hentikan eksekusi skrip setelah mengalihkan halaman
    } else {
        echo "Hapus dosen gagal: " . mysqli_error($koneksi);
    }
} else {
    echo "<script>
    alert('Hapus dosen gagal: npp tidak ditemukan');
    window.history.back();
    </script>";
}
?>
