<?php
// Include file konfigurasi database (fungsi.php)
require "fungsi.php";

// Periksa apakah permintaan datang melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangani data yang dikirimkan melalui AJAX
    $npp = $_POST["npp"];
    $namadosen = $_POST["namadosen"];
    $homebase = $_POST["homebase"];

    // Lakukan validasi data jika diperlukan
    // Misalnya, Anda dapat memeriksa apakah npp adalah unik, dll.

    // Lakukan query SQL untuk memperbarui data dosen
    $updateSql = "UPDATE dosen SET namadosen = '$namadosen', homebase = '$homebase' WHERE npp = '$npp'";
    $updateResult = mysqli_query($koneksi, $updateSql);

    if (!$updateResult) {
        // Gagal dalam query, tampilkan pesan kesalahan
        echo "Kesalahan dalam query: " . mysqli_error($koneksi);
;
    } else {
        // Pembaruan berhasil
        header("location:updateDosen.php");
    }
} else {
    // Jika permintaan bukan dari metode POST, tangani sesuai kebutuhan
    // Misalnya, tampilkan pesan kesalahan
    echo "Metode permintaan tidak valid!";

    
}
?>
