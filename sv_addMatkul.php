<?php
require "fungsi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil nilai dari form
    $idmatkul = $_POST["idmatkul"];
    $namamatkul = $_POST["namamatkul"];
    $sks = $_POST["sks"];
    $jns = $_POST["jns"];
    $smt = $_POST["smt"];

    // Menyimpan data matakuliah ke database
    $sql = "INSERT INTO matkul (idmatkul, namamatkul, sks, jns, smt) VALUES ('$idmatkul', '$namamatkul', '$sks', '$jns', '$smt')";

    $query = mysqli_query($koneksi, $sql);

    if ($query) {
        // Data berhasil disimpan
        mysqli_close($koneksi);
        header("Location: updateMatkul.php"); // Ganti dengan halaman yang sesuai
        exit();
    } else {
        // Terjadi kesalahan saat mengeksekusi pernyataan SQL
        echo "Terjadi kesalahan saat menyimpan data: " . mysqli_error($koneksi);
    }
} else {
    // Terjadi kesalahan saat menyiapkan pernyataan SQL
    echo "Terjadi kesalahan saat menyiapkan pernyataan SQL: " . mysqli_error($koneksi);
}

?>
