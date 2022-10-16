<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $statement = $mysqli->prepare("UPDATE prodi SET nama_prodi=? WHERE no_prodi=?");
    $statement->bind_param('ss', $_POST['nama_prodi'], $_GET['no_prodi']);
    $statement->execute();
    $statement->close();
    redirect('prodi');
    exit;
}
else {
    $result = $mysqli->query("SELECT * FROM prodi WHERE no_prodi=".$_GET['no_prodi']);
    $row = $result->fetch_assoc();
    if (!$row) {
        include "page/not-found.php";
        exit;
    }
?>
<div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Edit Prodi</h5>
    </div>
    <div class="card-body">
        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">No Prodi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="basic-default-name" placeholder="No Prodi" name="no_prodi" value="<?= $row['no_prodi'] ?>" disabled>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Nama Prodi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="basic-default-company" placeholder="Nama" name="nama_prodi" value="<?= $row['nama_prodi']?>">
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