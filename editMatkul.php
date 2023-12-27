<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sistem Informasi Akademik::Edit Data Matakuliah</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="bootstrap4/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/styleku.css">
    <script src="bootstrap4/jquery/3.3.1/jquery-3.3.1.js"></script>
    <script src="bootstrap4/js/bootstrap.js"></script>
</head>
<body>
<?php 
require "fungsi.php";
require "head.html";
$idmatkul = decrypturl($_GET['kode']);
$sql = "SELECT * FROM matkul WHERE idmatkul = '$idmatkul'";
$qry = mysqli_query($koneksi, $sql);
$row = mysqli_fetch_assoc($qry);
?>

<div class="utama">
    <h2 class="mb-3 text-center">EDIT DATA MATAKULIAH</h2>
    <div class="row">
        <div class="col-sm-9">
            <form method="post" action="sv_editMatkul.php">
                <div class="form-group row">
                    <label for="idmatkul" class="col-md-6 col-form-label">Kode:</label>
                    <div class="input-group">
                        <div class="input-group">
                            <select class="form-control" name="idmatkul" id="matkul">
                                <?php
                                $arrhobe = array('A11', 'A12', 'A14', 'A15', 'A16', 'A17', 'A22', 'A24', 'P31');
                                foreach ($arrhobe as $hb) {
                                    if ($hb == $row['idmatkul']) {
                                        echo "<option value='$hb' selected>$hb</option>";
                                    } else {
                                        echo "<option value='$hb'>$hb</option>";
                                    }
                                }
                                ?>
                            </select>
                            <input class="form-control" type="text" name="idmatkul" id="idmatkul" value="<?php echo $row['idmatkul']; ?>">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="namamatkul">Nama Matakuliah:</label>
                    <input class="form-control" type="text" name="namamatkul" id="namamatkul" value="<?php echo $row['namamatkul']; ?>">
                </div>
                <div class="form-group">
                    <label for="sks">SKS:</label>
                    <input class="form-control" type="text" name="sks" id="sks" value="<?php echo $row['sks']; ?>">
                </div>
                <div class="form-group">
                    <label for="jns">Jenis:</label>
                    <input class="form-control" type="text" name="jns" id="jns" value="<?php echo $row['jns']; ?>">
                </div>
                <div class="form-group">
                    <label for="smt">Semester:</label>
                    <input class="form-control" type="text" name="smt" id="smt" value="<?php echo $row['smt']; ?>">
                </div>
                <button class="btn btn-primary" type="submit" id="submit">Simpan</button>
            </form>
        </div>
    </div>
</div>

<script>
    $('#submit').on('click', function () {
        var idmatkul = $('#idmatkul').val();
        var namamatkul = $('#namamatkul').val();
        var sks = $('#sks').val();
        var jns = $('#jns').val();
        var smt = $('#smt').val();
        $.ajax({
            method: "POST",
            url: "sv_editMatkul.php",
            data: { idmatkul: idmatkul, namamatkul: namamatkul, sks: sks, jns: jns, smt: smt }
        });
    });
</script>
</body>
</html>
