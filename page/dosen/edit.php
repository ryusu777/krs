<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $statement = $mysqli->prepare("UPDATE dosen SET nama_dosen=? WHERE nid_dosen=?");
    $statement->bind_param('ss', $_POST['nama_dosen'], $_GET['nid']);
    $statement->execute();
    $statement->close();
    redirect('dosen');
    exit;
}
else {
    $result = $mysqli->query("SELECT * FROM dosen WHERE nid_dosen=".$_GET['nid']);
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
                <label class="col-sm-2 col-form-label" for="basic-default-name">NID</label>
                <div class="col-sm-10">
                    <input value="<?= $row['nid_dosen'] ?>" type="text" class="form-control" placeholder="NID" name="nid_dosen" disabled>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Nama</label>
                <div class="col-sm-10">
                    <input value="<?= $row['nama_dosen'] ?>" type="text" class="form-control" placeholder="Nama" name="nama_dosen">
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