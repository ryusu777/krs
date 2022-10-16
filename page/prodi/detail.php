<?php 
    $result = $mysqli->query("SELECT * FROM prodi WHERE no_prodi=".$_GET['no_prodi']);
    $row = $result->fetch_assoc();
    if (!$row) {
        include "page/not-found.php";
        exit;
    }
?>
<a href="/<?= $folder ?>/prodi">Kembali ke daftar prodi</a>
<div class="card mb-4 mt-4">
    <div class="card-body">
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">No Prodi</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="basic-default-name" placeholder="No Prodi" name="no_prodi" value="<?= $row['no_prodi'] ?>" disabled>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-company">Nama Prodi</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="basic-default-company" placeholder="Nama" name="nama_prodi" value="<?= $row['nama_prodi'] ?>" disabled>
            </div>
        </div>
    </div>
</div>
<h1>Include Grid Jadwal_Hdr disini</h1>
<?php 
    $no_prodi = $row['no_prodi'];
    include "page/prodi/matkul/index.php";
?>