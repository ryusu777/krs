<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $statement = $mysqli->prepare("INSERT INTO kurikulum (kode_kurikulum, tahun_berlaku) VALUES (?, ?)");
    $statement->bind_param('ss', $_POST['kode_kurikulum'], $_POST['tahun_berlaku']);
    $statement->execute();
    $statement->close();
    redirect("kurikulum");
    exit;
}
else {
?>
<div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Tambah Kurikulum</h5>
    </div>
    <div class="card-body">
        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Kode Kurikulum</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="basic-default-name" placeholder="Kode Kurikulum" name="kode_kurikulum">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Tahun Berlaku</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="basic-default-company" placeholder="Tahun Berlaku" name="tahun_berlaku">
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