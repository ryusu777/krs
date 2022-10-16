<?php 
    $no_jadwal_hdr = 1;
    $result = $mysqli->query("SELECT * FROM jadwal_hdr h JOIN prodi p ON h.no_prodi=p.no_prodi  WHERE no_jadwal_hdr=".$_GET['no_jadwal_hdr']);
    $row = $result->fetch_assoc();
    if (!$row) {
        include "page/not-found.php";
        exit;
    }
?>
<div class="card">
    <div class="card-header row justify-content-between">
        <h5 class="row"><center><b>JADWAL KULIAH</center></b></h5>
        <h5 class="row"><center><b>SEMESTER <?= $row['semester'] ?> TAHUN AKADEMIK <?= $row['tahun_akademik'] ?></b></center</h5> </br></br></br>
        <h5 class="row"><center>Program Studi : <?= $row['nama_prodi'] ?></center</h5>

    </div>
</div>


<h1>Include Grid Jadwal_Dtl disini</h1>