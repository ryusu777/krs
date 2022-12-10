<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $statement = $mysqli->prepare("INSERT INTO jadwal_hdr (kode_takd, nid_dosen, no_prodi, semester, tahun_akademik, tahun_kurikulum) VALUES (?, ?, ?, ?)");
    $statement->bind_param('ssssss', $_POST['kode_takd'], $_POST['nid_dosen'], $_POST['no_prodi'], $_POST['semester'], $_POST['tahun_akademik'], $_POST['tahun_kurikulum']);
    $statement->execute();
    $statement->close();
    $no_prodi = $_POST['no_prodi'];
    redirect("prodi/detail?no_prodi=$no_prodi");
    exit;
}
else {
    $result = $mysqli->query("SELECT * FROM prodi WHERE no_prodi='".$_GET['no_prodi']."'");
    $row = $result->fetch_assoc();
    if (!$row) {
        include "page/not-found.php";
        exit;
    }
?>
<div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Tambah Jadwal Prodi</h5>
        <small class="text-muted float-end"><?= $row['nama_prodi'] ?></small>
    </div>
    <div class="card-body">
        <form method="post">
            <input type="hidden" name="no_prodi" value=<?= $_GET['no_prodi'] ?>>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Semester</label>
                <div class="col-sm-10">
                    <select class="form-select" name="semester">
                        <option value="GENAP">Genap</option>
                        <option value="GANJIL">Ganjil</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Tahun Akademik</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="basic-default-name" placeholder="Tahun Akademik" name="tahun_akademik">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Tahun Kurikulum</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="basic-default-company" placeholder="Tahun Kurikulum" name="tahun_kurikulum">
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php } ?>