<?php
// Membuat koneksi ke database MySQL
$koneksi = mysqli_connect('localhost', 'root', '', 'a122006449');

// Fungsi untuk mengenkripsi ID
function encryptid($id) {
    $enc = base64_encode(rand() . "-" . strtotime(date("Y-m-d H:i:s")) . "-" . $id);
    return $enc;
}

// Fungsi untuk mendekripsi parameter URL
function decrypturl($string) {
    $kode = base64_decode($string);
    $id = explode("-", $kode);
    if (count($id) > 2) {
        return $id[2];
    } else {
        return 0;
    }
}

function search($tipe, $key = null)
{
    $sql = "SELECT * FROM $tipe";
    if (!is_null($key)) {
        $sql .= " WHERE $key";
    }

    $stmt = mysqli_prepare($GLOBALS['koneksi'], $sql);

    if ($stmt) {
        mysqli_stmt_execute($stmt);
        $hasil = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);

        return $hasil;
    } else {
        die(mysqli_error($GLOBALS['koneksi']));
    }
}
// Fungsi untuk menghapus data berdasarkan ID
function deleteData($tipe, $key)
{
    $sql = "DELETE FROM $tipe WHERE $key";

    $stmt = mysqli_prepare($GLOBALS['koneksi'], $sql);

    if ($stmt) {
        mysqli_stmt_execute($stmt);
        $rowsAffected = mysqli_stmt_affected_rows($stmt);
        mysqli_stmt_close($stmt);

        return $rowsAffected;
    } else {
        die(mysqli_error($GLOBALS['koneksi']));
    }
}
function generatepdf($size="A4",$orientation="Portrait",$html=null,$filename="doc")
{
    require_once __DIR__ . '/vendor/autoload.php';
    
    $pdf->loadHtml('$html');
    $pdf->setPaper($size,$orientation);
    $pdf->render();
    $pdf->stream($filename.".pdf",array("Attachment"=>FALSE));
}


?>