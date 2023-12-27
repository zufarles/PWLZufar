<?php
require "fungsi.php";

if (isset($_GET['kode'])) {
    $idmatkul = decrypturl($_GET['kode']);
    
    // Lakukan query DELETE ke database sesuai dengan ID matakuliah yang akan dihapus
    $sql = "DELETE FROM matkul WHERE idmatkul = '$idmatkul'";
    
    $query = mysqli_query($koneksi, $sql);
    
    if ($query) {
        // Redirect kembali ke halaman daftar matakuliah setelah berhasil menghapus
        header("Location: updateMatkul.php");
        exit();
    } else {
        echo "Terjadi kesalahan dalam menghapus data matakuliah: " . mysqli_error($koneksi);
    }
} else {
    echo "ID matakuliah tidak valid.";
}
?>
