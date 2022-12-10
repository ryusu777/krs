<?php 
$result = $mysqli->query("SELECT * FROM matkul m JOIN prodi p ON m.no_prodi=p.no_prodi WHERE m.kode_matkul='".$_GET['kode_matkul']."'");
$row = $result->fetch_assoc();
if (!$row) {
    include "page/not-found.php";
    return;
}
$no_prodi = $row['no_prodi'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $statement = $mysqli->prepare("UPDATE matkul SET kode_matkul=?, sks=?, smt_matkul=?, nama_matkul=? WHERE kode_matkul=?");
    $statement->bind_param('sisss', $_POST['kode_matkul'], $_POST['sks'], $_POST['smt_matkul'], $_POST['nama_matkul'], $_POST['kode_matkul']);
    $statement->execute();
    $statement->close();

    redirect("prodi/detail?no_prodi=$no_prodi");
    exit;
}
else {
?>
<div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Ubah Matkul</h5>
        <small class="text-muted float-end"><?= $row['nama_prodi'] ?>></small>
    </div>
    <div class="card-body">
        <form method="post">
            <input value="<?= $row['kode_matkul'] ?>" type="hidden" name="kode_matkul">
            <input value="<?= $row['no_prodi'] ?>" type="hidden" name="no_prodi">
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Kode Matkul</label>
                <div class="col-sm-10">
                    <input value="<?= $row['kode_matkul'] ?>" type="text" class="form-control" placeholder="Kode Matkul" disabled>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Kode Kurikulum</label>
                <div class="col-sm-10">
                    <input value="<?= $row['kode_matkul'] ?>" type="text" class="form-control" placeholder="Kode Kurikulum" name="kode_matkul">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">SKS</label>
                <div class="col-sm-10">
                    <input value="<?= $row['sks'] ?>" type="text" class="form-control" placeholder="Sks" name="sks">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Semester Mata Kuliah</label>
                <div class="col-sm-10">
                    <input value="<?= $row['smt_matkul'] ?>" type="text" class="form-control" placeholder="Semester" name="smt_matkul">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Nama Mata Kuliah</label>
                <div class="col-sm-10">
                    <input value="<?= $row['nama_matkul'] ?>" type="text" class="form-control" placeholder="Namkul" name="nama_matkul">
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