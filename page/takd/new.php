<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $statement = $mysqli->prepare("INSERT INTO tkad (kode_tkad) VALUES (?)");
    $statement->bind_param('s', $_POST['kode_tkad']);
    $statement->execute();
    $statement->close();
    redirect("tkad");
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
                <label class="col-sm-2 col-form-label" for="basic-default-name">Kode Tahun Akademik</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="basic-default-name" placeholder="kode" name="kode_tkad">
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