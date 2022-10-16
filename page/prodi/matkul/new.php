<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $statement = $mysqli->prepare("INSERT INTO matkul (kode_matkul, tahun_kurikulum_matkul, no_prodi, sks, smt_matkul, nama_matkul) VALUES (?, ?, ?, ?, ?, ?)");
    $statement->bind_param('sssiss', $_POST['kode_matkul'], $_POST['tahun_kurikulum_matkul'], $_POST['no_prodi'], $_POST['sks'], $_POST['smt_matkul'], $_POST['nama_matkul']);
    $statement->execute();
    $statement->close();
    $no_prodi = $_POST['no_prodi'];
    redirect("prodi/detail?no_prodi=$no_prodi");
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
        <h5 class="mb-0">Tambah Matkul</h5>
        <small class="text-muted float-end"><?= $row['nama_prodi'] ?></small>
    </div>
    <div class="card-body">
        <form method="post">
            <input type="hidden" name="no_prodi" value="<?= $_GET['no_prodi'] ?>" />
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Kode Mata Kuliah</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="basic-default-name" placeholder="Kode Matkul" name="kode_matkul">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Tahun Kurikulum</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="basic-default-company" placeholder="Tahun Kurikulum" name="tahun_kurikulum_matkul">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">SKS</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="basic-default-company" placeholder="Sks" name="sks">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Semester Mata Kuliah</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="basic-default-company" placeholder="Smt Matkul" name="smt_matkul">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Nama Mata Kuliah</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="basic-default-company" placeholder="Nama Matkul" name="nama_matkul">
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