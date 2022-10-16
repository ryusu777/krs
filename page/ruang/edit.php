<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $statement = $mysqli->prepare("UPDATE ruang SET nama_ruang=? WHERE kode_ruang=?");
    $statement->bind_param('ss', $_POST['nama_ruang'], $_GET['nid']);
    $statement->execute();
    $statement->close();
    redirect('ruang');
    exit;
}
else {
    $result = $mysqli->query("SELECT * FROM ruang WHERE kode_ruang=".$_GET['nid']);
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
                <label class="col-sm-2 col-form-label" for="basic-default-name">Kode Ruang</label>
                <div class="col-sm-10">
                    <input value="<?= $row['kode_ruang'] ?>" type="text" class="form-control" placeholder="kode" name="kode_ruang" disabled>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Nama Ruang</label>
                <div class="col-sm-10">
                    <input value="<?= $row['nama_ruang'] ?>" type="text" class="form-control" placeholder="Nama" name="nama_ruang">
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