<?php
// Pastikan Anda memiliki koneksi database yang sesuai
require "fungsi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari permintaan POST
    $idmatkul = $_POST["idmatkul"];
    $namamatkul = $_POST["namamatkul"];
    $sks = $_POST["sks"];
    $jns = $_POST["jns"];
    $smt = $_POST["smt"];

    // Lakukan validasi atau operasi lain jika diperlukan

    // Lakukan kueri pembaruan SQL
    $updateSql = "UPDATE matkul SET namamatkul = '$namamatkul', sks = '$sks', jns = '$jns', smt = '$smt' WHERE idmatkul = '$idmatkul'";
    $updateResult = mysqli_query($koneksi, $updateSql);

    if (!$updateResult) {
        echo "Kesalahan dalam query: " . mysqli_error($koneksi);
    } else {
        // Berhasil mengupdate data, Anda dapat memberikan respons atau pesan sukses
        header("location:updateMatkul.php");
    }
} else {
    // Permintaan bukan metode POST, mungkin perlu ditangani dengan cara lain
    echo "Permintaan tidak valid.";
}
?>
