<?php
require "fungsi.php";
   $type = $_GET['type'];
   $kode = isset ($_GET['kode'])?$_GET['kode']:null;

   if($type == 'krs')
   {
    header("Location: krsmhs.php?nim=".$kode);
   }
   elseif($type == 'krm')
   {
    header("Location: krs.php?npp=".$kode);
   }
   else
   {
    echo "operasitidak dapat dilakukan";
   }

