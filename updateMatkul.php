<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Dosen</title>
    <link rel="stylesheet" type="text/css" href="bootstrap4/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/styleku.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- Use fontawesome 5-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" 
    integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>
<body>
    <div class="utama">
        <h2 class="text-center">Daftar Dosen</h2>
        
        <div class="d-flex justify-content-between">
            <div class="p-2">
                <form action="" method="post" class="form-inline">
                    <div class="input-group">

                        <div class="input-group-append">

                        </div>
                    </div>
                </form>
            </div>
            <div class="p-2">
                <a class="btn btn-success" href="addDatamatkul.php">Tambah Data</a>
            </div>
        </div>

        <?php
        require "fungsi.php";
        require "head.html";
 
            $sql = "SELECT * FROM matkul";
        

        $rs = mysqli_query($koneksi, $sql) or die(mysqli_error($koneksi));

        if (!$rs) {
            echo "Kesalahan dalam query: " . mysqli_error($koneksi);
        } else {
            if (mysqli_num_rows($rs) == 0) {
                echo "<p>Data tidak ditemukan</p>";
            } else {
        ?>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                    <th>No</th>
                <th>Kode</th>
                <th>Nama Matakuliah</th>
                <th>SKS</th>
                <th>Jenis</th>
                <th>Semester</th>
                <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    while ($result = mysqli_fetch_object($rs)) {
                    ?>
                        <tr>
                        <td><?php echo $i ?></td>
                <td><?php echo $result->idmatkul ?></td>
                <td><?php echo $result->namamatkul ?></td>
                <td><?php echo $result->sks ?></td>
                <td><?php echo $result->jns ?></td>
                <td><?php echo $result->smt ?></td>
                <td>
                <a class="btn btn-outline-primary btn-sm" href="editMatkul.php?kode=<?php echo encryptid($result->idmatkul) ?>">Edit</a>
                                <a class="btn btn-outline-danger btn-sm" href="hpsMatkul.php?kode=<?php echo encryptid($result->idmatkul) ?>" onclick="return confirm('Yakin dihapus nih?')">Hapus</a>
                            </td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                </tbody>
            </table>
        <?php
            }
        }
        ?>
    </div>
</body>
</html>
