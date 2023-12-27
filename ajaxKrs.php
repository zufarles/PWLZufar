<?php
require "fungsi.php";

// Memeriksa apakah formulir dikirimkan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Menggunakan isset() untuk memastikan variabel 'pilih' ada dan tidak null
    if (isset($_POST['pilih']) && !empty($_POST['pilih'])) {
        // Memecah nilai 'pilih' menjadi idkultawar dan sks
        $pilihan = explode('-', $_POST['pilih']);

        // Menyimpan data ke dalam database atau melakukan operasi lain sesuai kebutuhan
        // Misalnya, Anda dapat menggunakan fungsi insertData() yang harus Anda definisikan di file 'fungsi.php'
        $berhasil = insertData('tabel_yang_anda_gunakan', [
            'idkultawar' => $pilihan[0],
            'sks' => $pilihan[1],
            // tambahkan kolom lain sesuai kebutuhan
        ]);

        if ($berhasil) {
            echo "Data berhasil disimpan.";
        } else {
            echo "Gagal menyimpan data.";
        }
    } 
}

// Melakukan pencarian data kultawar
$rs = search('kultawar', "idmatkul='" . $_POST['mk'] . "'");
if ($rs) {
    // Check if there are rows in the result set
    if (mysqli_num_rows($rs) > 0) {
?>
    <div class="container">
        <div class="row justify-content-center">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>No</th>
                    <th>Kode Mata Kuliah</th>
                    <th>Nama Mata Kuliah</th>
                    <th>Dosen</th>
                    <th>Jam Kuliah</th>
                    <th>SKS</th>
                    <th>Aksi</th>
                </tr>
                <?php
                $i = 1;
                while ($data = mysqli_fetch_object($rs)) {
                    $matkul = search('matkul', "idmatkul='" . $_POST['mk'] . "'");
                    $datamatkul = mysqli_fetch_object($matkul);
                    $dosen = search('dosen', "npp='" . $data->npp . "'");
                    $datadosen = mysqli_fetch_object($dosen);
                ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $datamatkul->idmatkul ?></td>
                        <td><?php echo $datamatkul->namamatkul ?></td>
                        <td><?php echo $datadosen->namadosen ?></td>
                        <td><?php echo $data->hari, " ", $data->jamkul ?></td>
                        <td><?php echo $datamatkul->sks ?></td>
                        <td><input type="radio" name="pilih" value="<?php echo $data->idkultawar . '-' . $datamatkul->sks ?>"></td>
                    </tr>
                <?php
                    $i++;
                }
                ?>
            </table>
        </div>
    </div>
<?php
    } else {
        echo "<div style='margin-left: 10px;'>Mata kuliah tidak di tawarkan.</div>"; 
    }
} else {
    echo "Terjadi kesalahan dalam melakukan pencarian data.";
    var_dump($rs); // You can remove this line in production
}
?>
