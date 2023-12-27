<?php
require "fungsi.php";
$nim = $_GET['nim'];
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Gantilah 'id' dengan nama kolom yang sesuai di tabel KRS
    $key = "id = $id";

    // Gantilah 'krs' dengan nama tabel yang sesuai
    $rowsAffected = deleteData('krs', $key);

    if ($rowsAffected > 0) {
        echo "Data berhasil dihapus.";
    } else {
        echo "Gagal menghapus data atau data tidak ditemukan.";
    }
} else {
    echo "ID tidak ditemukan.";
}

header('location: inputKRS.php?nim=' . $_GET['nim']);
?>
