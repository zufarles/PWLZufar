<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sistem Informasi Akademik::Daftar Mahasiswa</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="bootstrap4/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/styleku.css">
    <script src="bootstrap4/jquery/3.3.1/jquery-3.3.1.js"></script>
    <script src="bootstrap4/js/bootstrap.js"></script>
    <!-- Use fontawesome 5-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ"
        crossorigin="anonymous">
    <style>
        .table th,
        .table td {
            text-align: center;
        }

        .lead {
            margin-left: 10px; /* Adjust this value as needed */
        }
    </style>
</head>

<body>

    <?php
    // Memanggil file berisi fungsi-fungsi yang sering dipakai
    require "fungsi.php";
    require "head.html";

    if (isset($_GET['nim'])) {
        $progdi = substr($_GET['nim'], 0, 3);
    }
    $rs = search('matkul', "substr(idmatkul,1,3)='" . $progdi . "'");
    ?>

    <div class="utama">
        <h3>Input KRS <?php echo $_GET['nim']; ?></h3>
        <form action="sv_krs.php" method="post">
            <div class="form-group">
                <label for="matakuliah">Mata kuliah</label>
                <select name="matakuliah" id="matkul" class="form-control">
                    <option selected disabled>- Pilih mata kuliah -</option>
                    <?php while ($data = mysqli_fetch_object($rs)) : ?>
                        <option value="<?php echo $data->idmatkul; ?>"><?php echo $data->namamatkul; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="row">
                <div id="tabelmatkul"></div>
            </div>
            <input type="text" name="nim" value="<?php echo $_GET['nim']; ?>" hidden>
            <input type="submit" value="Submit" class="btn btn-primary">
        </form>
        <br><br>
        <div class="row">
            <?php
            $krsmhs = search('krs', "nim='" . $_GET['nim'] . "'");
            if (mysqli_num_rows($krsmhs) == 0) :
                echo "<div style='margin-left: 10px;'>Belum ada krs yang di input.</div>"; 
            else :
            ?>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Mata Kuliah</th>
                            <th>Nama Mata Kuliah</th>
                            <th>Dosen</th>
                            <th>Jam Kuliah</th>
                            <th>SKS</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $sks = 0;
                        while ($data = mysqli_fetch_object($krsmhs)) :
                            $tawar = search('kultawar', "idkultawar=" . $data->idJadwal);
                            $datatawar = mysqli_fetch_object($tawar);
                            $dosen = search('dosen', "npp='" . $datatawar->npp . "'");
                            $datadosen = mysqli_fetch_object($dosen);
                            $matkul = search('matkul', "idmatkul='" . $datatawar->idmatkul . "'");
                            $datamatkul = mysqli_fetch_object($matkul);

                            $sks += $data->sks;
                        ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $datamatkul->idmatkul ?></td>
                                <td><?php echo $datamatkul->namamatkul ?></td>
                                <td><?php echo $datadosen->namadosen ?></td>
                                <td><?php echo isset($data->hari) ? $data->hari . " " : ""; ?><?php echo isset($datatawar->jamkul) ? $datatawar->jamkul : ""; ?></td>

                                <td><?php echo $datamatkul->sks ?></td>
                                <td><a href="hpskrs.php?id=<?php echo $data->id; ?>" class="btn btn-danger btn-sm">Hapus</a></td>
                            </tr>
                        <?php
                            $i++;
                        endwhile;
                        ?>
                    </tbody>
                </table>
                <p class="lead">Total SKS: <?php echo $sks; ?></p>
            <?php
            endif;
            ?>
        </div>

        <script>
            $(document).ready(function () {
                $("#matkul").change(function () {
                    var mk = $(this).val()
                    $.post('ajaxKrs.php', {
                            mk: mk
                        },
                        function (data) {
                            $("#tabelmatkul").html(data)
                            console.log(mk)
                        })
                })
            })
        </script>
    </div>
</body>

</html>
