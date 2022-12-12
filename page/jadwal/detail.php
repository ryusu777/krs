<?php 
    $result = $mysqli->query("SELECT * FROM jadwal_hdr h 
        JOIN takd t on h.kode_takd=t.kode_takd 
        JOIN dosen d on h.nid_dosen=d.nid_dosen 
        jOIN prodi p on h.no_prodi=p.no_prodi 
        JOIN kurikulum k on h.kode_kurikulum=k.kode_kurikulum
        WHERE h.no_jadwal_hdr='".$_GET['no_jadwal_hdr']."'"
    );
    $row = $result->fetch_assoc();
    if (!$row) {
        include "page/not-found.php";
        exit;
    }
?>
<div class="card mb-4">
    <div class="card-header row justify-content-between">
        <h5 class="row"><center><b>JADWAL KULIAH</center></b></h5>
        <h5 class="row"><center><b>SEMESTER <?= $row['semester'] ?> TAHUN AKADEMIK <?= $row['kode_takd'] ?></b></center</h5> </br></br></br>
        <h5 class="row"><center>Program Studi : <?= $row['nama_prodi'] ?></center</h5>
    </div>
</div>

<?php 
    $no_jadwal_hdr = $row['no_jadwal_hdr'];
    include 'page/jadwal/jadwal_dtl/index.php';
?>