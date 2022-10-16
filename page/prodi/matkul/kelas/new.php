<?php 
$result = $mysqli->query("SELECT * FROM matkul m 
    WHERE m.kode_matkul='".$_GET['kode_matkul']."'");
$row = $result->fetch_assoc();
if (!$row) {
    include "page/not-found.php";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $statement = $mysqli->prepare("INSERT INTO kelas (kode_kelas, kode_matkul, nid_dosen) VALUES (?, ?, ?)");
    $statement->bind_param('sss', $_POST['kode_kelas'], $_POST['kode_matkul'], $_POST['nid_dosen']);
    $statement->execute();
    $statement->close();
    $kode_matkul = $row['kode_matkul'];
    redirect("prodi/matkul/detail?kode_matkul=$kode_matkul");
    exit;
}
else {
    if (!isset($_GET['kode_matkul'])) {
        include "page/not-found.php";
        exit;
    }
?>
<div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Tambah kelas</h5>
        <small class="text-muted float-end"><?= $row['nama_matkul'] ?></small>
    </div>
    <div class="card-body">
        <form method="post">
            <div class="row mb-3">
                <input type="hidden" name="kode_matkul" value="<?= $_GET['kode_matkul'] ?>">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Kode Kelas</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="basic-default-name" placeholder="Kode Kelas" name="kode_kelas">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">NID Dosen</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="basic-default-company" placeholder="NID Dosen" name="nid_dosen">
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