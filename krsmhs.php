<?php
require "fungsi.php";

$nim = $_GET['nim'];
$sql = "SELECT * FROM krs b JOIN kultawar v ON (b.idJadwal = c.idkultawar) JOIN matkul d ON (c.idmatkul = d.id) WHERE b.nim='".$nim."'";


$mhs = search('mhs', "nim = '".$nim."'");
$rsmhs = mysqli_fetch_object($mhs);

$rs = mysqli_query($koneksi, $sql) or die(mysql_error());

$html = '<h3>KRS Mahasiswa</h3>';
$html .= '<p>NIM: Mahasiswa: '.$rsmhs->nama;
$html .= '<table border=1 cellspacing=0 xellpadding=10>
          <tr>
                <th>NO</th>
                <th>Kode Mata Kuliah</th>
                <th>Nama Mata Kuliah</th>
                <th>SKS<th>
                <th>Jadwal</th>
                <th>Dosen Pengampu</th>
                </tr>';
$i = 1;
$totalsks = 0;
while($data = mysqli_fetch_object($rs))
{
    $totalsks+=$data->sks;
    $html .='
    <tr>
         <td>'.$i.'</td>
         <td>'.$data->idmatkul.'</td>
         <td>'.$data->namamatkul.'</td>
         <td>'.$data->sks.'</td>
         <td>'.$data->idJadwal.'</td>
         <td>'.$data->namadosen.'</td>
         <td>'.$data->npp.'</td>
    </tr>';

}
$html .= '
<tr>
    <td colspan=3>Total SKS</td>
    <td>'.$totalsks.'</td>
    <td colspan=2></td>
    </tr>';
    $html .= '</table>';


    generatepdf(html:$html,filename:'krs_mhs_'.$nim);