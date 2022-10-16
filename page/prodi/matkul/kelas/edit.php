<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $statement = $mysqli->prepare("UPDATE kelas SET kode_matkul=?, nid_dosen=? WHERE kode_kelas=?");
    $statement->bind_param('sss', $_POST['kode_matkul'], $_POST['nid_dosen'], $_GET['kode_kelas']);
    $statement->execute();
    $statement->close();
    redirect('prodi/matkul/kelas');
    exit;
}
else {
    $result = $mysqli->query("SELECT * FROM kelas WHERE kode_kelas='".$_GET['kode_kelas']."'");
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
            <input value="<?= $row['kode_matkul'] ?>" type="hidden" name="kode_matkul">
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Kode Kelas</label>
                <div class="col-sm-10">
                    <input value="<?= $row['kode_kelas'] ?>" type="text" class="form-control" placeholder="Kode Kelas" name="kode_kelas" disabled>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">NID Dosen</label>
                <div class="col-sm-10">
                    <input value="<?= $row['nid_dosen'] ?>" type="text" class="form-control" placeholder="NID Dosen" name="nid_dosen">
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