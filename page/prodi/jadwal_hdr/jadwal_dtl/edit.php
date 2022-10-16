<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $statement = $mysqli->prepare("UPDATE jadwal_dtl SET
        kode_ruang=?, 
        kode_kelas=?, 
        hari=?, 
        jam_mulai=?, 
        jam_selesai=?
        WHERE no_jadwal_detail=?
    ");
    $statement->bind_param('ssssss', 
        $_POST['kode_ruang'], 
        $_POST['kode_kelas'],
        $_POST['hari'],
        $_POST['jam_mulai'],
        $_POST['jam_selesai'],
        $_POST['no_jadwal_detail']
    );
    $statement->execute();
    $statement->close();
    $no_jadwal_hdr = $_POST['no_jadwal_hdr'];
    redirect("prodi/jadwal_hdr/detail?no_jadwal_hdr=$no_jadwal_hdr");
    exit;
}
else {
    if (!isset($_GET['no_jadwal_detail'])) {
        redirect("not-found");
        exit;
    }
    $result = $mysqli->query("SELECT * FROM jadwal_dtl WHERE no_jadwal_detail=".$_GET['no_jadwal_dtl']);
    $row = $result->fetch_assoc();
    if (!$row) {
        redirect('not-found');
        exit;
    }
    $ruangResult = $mysqli->query("SELECT * FROM ruang");
    $no_jadwal_hdr = $row['no_jadwal_hdr'];
    $kelasResult = $mysqli->query("SELECT 
        m.nama_matkul,
        k.kode_kelas,
        d.nama_dosen
        FROM kelas k
        JOIN jadwal_hdr jh ON jh.no_jadwal_hdr=$no_jadwal_hdr
        JOIN matkul m ON m.tahun_kurikulum_matkul=jh.tahun_kurikulum
        JOIN dosen d ON d.nid_dosen=k.nid_dosen");
?>
<div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Tambah Jadwal</h5>
    </div>
    <div class="card-body">
        <form method="post">
            <input name="no_jadwal_hdr" type="hidden" value="<?= $row['no_jadwal_hdr'] ?>">
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Ruang</label>
                <div class="col-sm-10">
                    <input class="form-control" list="ruang-list" placeholder="Cari..." name="kode_ruang" value="<?= $row['kode_ruang'] ?>">
                    <datalist id="ruang-list">
                        <?php 
                            while ($row = $ruangResult->fetch_assoc()) {
                        ?>
                        <option value="<?= $row['kode_ruang'] ?>"><?= $row['nama_ruang']?></option>
                        <?php
                            }
                        ?>
                    </datalist>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Hari</label>
                <div class="col-sm-10">
                    <select class="form-select" name="hari">
                        <?php 
                            $days = array_slice($nama_hari, 1, 6);
                            foreach ($days as $day) {
                        ?>
                        <option value="<?= strtoupper($day) ?>" <?php if ($day == $row['hari']) echo 'selected'; ?>><?= $day ?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Kelas</label>
                <div class="col-sm-10">
                    <input class="form-control" list="kelas-list" placeholder="Cari..." name="kode_kelas">
                    <datalist id="kelas-list">
                        <?php 
                            while ($rowKelas = $kelasResult->fetch_assoc()) {
                        ?>
                        <option value="<?= $rowKelas['kode_kelas'] ?>" <?php if ($rowKelas['kode_kelas'] == $row['kode_kelas'] ) echo 'selected'; ?>><?= $rowKelas['nama_matkul'].', '.$rowKelas['nama_dosen'] ?></option>
                        <?php
                            }
                        ?>
                    </datalist>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Jam Mulai</label>
                <div class="col-sm-10">
                    <input class="form-control" type="time" name="jam_mulai" id="jam-mulai-input" value="<?= $row['jam_mulai'] ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Jam Selesai</label>
                <div class="col-sm-10">
                    <input class="form-control" type="time" name="jam_selesai" id="jam-selesai-input" value="<?= $row['jam_selesai'] ?>">
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