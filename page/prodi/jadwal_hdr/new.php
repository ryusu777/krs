<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $statement = $mysqli->prepare("INSERT INTO jadwal_hdr (no_jadwal_hdr, no_prodi, semester, tahun_akademik, tahun_kurikulum) VALUES (?, ?, ?, ?, ?)");
    $statement->bind_param('sssss', $_POST['no_jadwal_hdr'], $_POST['no_prodi'], $_POST['semester'], $_POST['tahun_akademik'], $_POST['tahun_kurikulum']);
    $statement->execute();
    $statement->close();
    redirect('prodi/jadwal_hdr/');
    exit;
}
else {
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
                    <input type="number" class="form-control" id="basic-default-name" placeholder="No Jadwal Header" name="no_jadwal_hdr">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">No Prodi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="basic-default-name" placeholder="No Prodi" name="no_prodi">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Semester</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="basic-default-company" placeholder="Semester" name="semester">
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