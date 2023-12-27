<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sistem Informasi Akademik::Edit Data Dosen</title>
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
    $npp = decrypturl($_GET['kode']);
    $sql = "SELECT * FROM dosen WHERE npp = '$npp'";
    $qry = mysqli_query($koneksi, $sql);
    $row = mysqli_fetch_assoc($qry);
    ?>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-3 text-center">EDIT DATA DOSEN</h2>
                <form enctype="multipart/form-data" method="post" action="sv_editDosen.php">
                    <div class="form-group">
                        <label for="npp">NPP:</label>
                        <input class="form-control-ku col-md-3" type="text" name="npp" id="npp" value="<?php echo $row['npp']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="namadosen">Nama dosen:</label>
                        <input class="form-control" type="text" name="namadosen"  id="namadosen" value="<?php echo $row['namadosen']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="homebase">Homebase:</label>
                        <select class="form-control" name="homebase" id="homebase">
                            <?php
                            $arrhobe = array('A11', 'A12', 'A14', 'A15', 'A16', 'A17', 'A22', 'A24', 'P31');
                            foreach($arrhobe as $hb) {
                                if ($hb == $row['homebase']) {
                                    echo "<option value='$hb' selected>$hb</option>";
                                } else {
                                    echo "<option value='$hb'>$hb</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div>		
                        <button class="btn btn-primary" type="submit" id="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $('#submit').on('click',function(){
            var npp = $('#npp').val();
            var namadosen = $('#namadosen').val();
            var homebase = $('#homebase').val();
            $.ajax({
                method: "POST",
                url: "sv_editDosen.php",
                data: { npp: npp, namadosen: namadosen, homebase: homebase}
            });
        });
    </script>
</body>
</html>
