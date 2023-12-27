<!DOCTYPE html>
<html>
<head>
	<title>Sistem Informasi Akademik::Daftar Mahasiswa</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="bootstrap4/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/styleku.css">
	<script src="bootstrap4/jquery/3.3.1/jquery-3.3.1.js"></script>
	<script src="bootstrap4/js/bootstrap.js"></script>
	<!-- Use fontawesome 5-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<script>
		/*function cetak(hal) {
		  var xhttp;
		  var dtcetak;	
		  xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
			  dtcetak= this.responseText;
			}
		  };
		  xhttp.open("GET", "ajaxUpdatekultawar.php?hal="+hal, true);
		  xhttp.send();
		}*/
	</script>		
</head>
<body>
<?php

//memanggil file berisi fungsi2 yang sering dipakai
require "fungsi.php";
require "head.html";
$sql = "select * from matkul a JOIN kultawar b on (a.idmatkul = b.idmatkul) JOIN dosen c ON (c.npp = b.npp)";
$hasil=mysqli_query($koneksi,$sql) or die(mysqli_error($koneksi));
$kosong=false;
if (!mysqli_num_rows($hasil)){
        $kosong=true;
}

?>
<div class="utama">
	<h2 class="text-center">Daftar penawaran mata kuliah</h2>
	<div class="text-center"><a href="prnkultawarPdf.php"><span class="fas fa-print">&nbsp;Print</span></a></div>
	<span class="float-left">
		<a class="btn btn-success" href="addTawar.php">Tambah Data</a>
	</span>
	<!-- Cetak data dengan tampilan tabel -->
	<table class="table table-hover">
	<thead class="thead-light">
	<tr>
		<th>No.</th>
		<th>Mata kuliah</th>
		<th>Dosen</th>
		<th>Jadwal hari</th>
		<th>Jadwal jam</th>
        <th>Aksi</th>
        
	</tr>
	</thead>
	<tbody>
	<?php
	//jika data tidak ada
	if ($kosong){
		?>
		<tr><th colspan="6">
			<div class="alert alert-info alert-dismissible fade show text-center">
			<!--<button type="button" class="close" data-dismiss="alert">&times;</button>-->
			Data tidak ada
			</div>
		</th></tr>
		<?php
	}else{	
		$no=1;
		while($row=mysqli_fetch_assoc($hasil)){
			?>	
			<tr>
				<td><?php echo $no?></td>
				<td><?php echo $row["namamatkul"]?></td>
				<td><?php echo $row["namadosen"]?></td>
				<td><?php echo $row["hari"]?></td>
				<td><?php echo $row["jamkul"]?></td>
                
				<td>
				<a class="btn btn-outline-primary btn-sm" href="editkultawar.php?kode=<?php echo $row['idkultawar']?>">Edit</a>
				<a class="btn btn-outline-danger btn-sm" href="hpskultawar.php?kode=<?php echo $row["idkultawar"]?>" id="linkHps" onclick="return confirm('Yakin dihapus nih?')">Hapus</a>
				</td>
			</tr>
			<?php 
			$no++;
		}
	}
	?>
	</tbody>
	</table>
</div>
</body>
</html>	
