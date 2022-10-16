<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $statement = $mysqli->prepare("UPDATE jadwal_hdr SET no_prodi=?, semester=?, tahun_akademik=?, tahun_kurikulum=? WHERE no_jadwal_hdr=?");
    $statement->bind_param('sssss', $_POST['no_prodi'], $_POST['semester'], $_POST['tahun_akademik'], $_POST['tahun_kurikulum'], $_GET['no_jadwal_hdr']);
    $statement->execute();
    $statement->close();
    redirect('prodi/jadwal_hdr');
    exit;
}
else {
    $result = $mysqli->query("SELECT * FROM jadwal_hdr WHERE no_jadwal_hdr=".$_GET['no_jadwal_hdr']);
    $row = $result->fetch_assoc();
    if (!$row) {
        redirect('not-found');
        exit;
    }
?>
<div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Basic Layout</h5>
        <small class="text-muted float-end">Default label</small>
    </div>
    <div class="card-body">
        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">No Jadwal Header</label>
                <div class="col-sm-10">
                    <input value="<?= $row['no_jadwal_hdr'] ?>" type="number" class="form-control" placeholder="No Jadwal Header" name="no_jadwal_hdr" disabled>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">No Prodi</label>
                <div class="col-sm-10">
                    <input value="<?= $row['no_prodi'] ?>" type="text" class="form-control" placeholder="No Prodi" name="no_prodi">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Semester</label>
                <div class="col-sm-10">
                    <input value="<?= $row['semester'] ?>" type="text" class="form-control" placeholder="Semester" name="semester">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Tahun Akademik</label>
                <div class="col-sm-10">
                    <input value="<?= $row['tahun_akademik'] ?>" type="text" class="form-control" placeholder="Tahun Akademik" name="tahun_akademik">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Tahun Kurikulum</label>
                <div class="col-sm-10">
                    <input value="<?= $row['tahun_kurikulum'] ?>" type="text" class="form-control" placeholder="Tahun Kurikulum" name="tahun_kurikulum">
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