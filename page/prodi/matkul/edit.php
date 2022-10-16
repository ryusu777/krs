<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $statement = $mysqli->prepare("UPDATE matkul SET tahun_kurikulum_matkul=?, no_prodi=?, sks=?, smt_matkul=?, nama_matkul=? WHERE kode_matkul=?");
    $statement->bind_param('ss', $_POST['nama_ruang'], $_GET['nid']);
    $statement->execute();
    $statement->close();
    redirect('matkul');
    exit;
}
else {
    $result = $mysqli->query("SELECT * FROM matkul WHERE kode_matkul=".$_GET['nid']);
    $row = $result->fetch_assoc();
    if (!$row) {
        redirect('not-found');
        return;
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
                <label class="col-sm-2 col-form-label" for="basic-default-name">Kode Matkul</label>
                <div class="col-sm-10">
                    <input value="<?= $row['kode_ruang'] ?>" type="text" class="form-control" placeholder="Kodemat" name="kode_matkul" disabled>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Tahun Kurikulum Mata Kuliah</label>
                <div class="col-sm-10">
                    <input value="<?= $row['nama_ruang'] ?>" type="text" class="form-control" placeholder="Tahunkur" name="tahum_kurikulum_matkul">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">No Prodi</label>
                <div class="col-sm-10">
                    <input value="<?= $row['nama_ruang'] ?>" type="text" class="form-control" placeholder="Nopro" name="no_prodi">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">SKS</label>
                <div class="col-sm-10">
                    <input value="<?= $row['nama_ruang'] ?>" type="text" class="form-control" placeholder="Sks" name="sks">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Semester Mata Kuliah</label>
                <div class="col-sm-10">
                    <input value="<?= $row['nama_ruang'] ?>" type="text" class="form-control" placeholder="Smsmt" name="smt_matkul">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Nama Mata Kuliah</label>
                <div class="col-sm-10">
                    <input value="<?= $row['nama_ruang'] ?>" type="text" class="form-control" placeholder="Namkul" name="nama_matkul">
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