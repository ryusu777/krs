<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $statement = $mysqli->prepare("UPDATE jadwal_dtl SET
        kode_ruang=?, 
        kode_matkul=?,
        nid_dosen=?, 
        hari=?, 
        jam_mulai=?, 
        jam_selesai=? 
        WHERE no_jadwal_detail=?
    ");
    $statement->bind_param('sssssss', 
        $_POST['kode_ruang'], 
        $_POST['kode_matkul'],
        $_POST['nid_dosen'],
        $_POST['hari'],
        $_POST['jam_mulai'],
        $_POST['jam_selesai'],
        $_POST['no_jadwal_detail']
    );
    $statement->execute();
    $statement->close();
    $no_jadwal_hdr = $_POST['no_jadwal_hdr'];
    redirect("jadwal/detail?no_jadwal_hdr=$no_jadwal_hdr");
    exit;
}
else {
    if (!isset($_GET['no_jadwal_detail'])) {
        include "page/not-found.php";
        exit;
    }
    $result = $mysqli->query("SELECT * FROM jadwal_dtl WHERE no_jadwal_detail=".$_GET['no_jadwal_detail']);
    $row = $result->fetch_assoc();
    if (!$row) {
        include "page/not-found.php";
        exit;
    }
    $ruangResult = $mysqli->query("SELECT * FROM ruang");
    $dosenResult =  $mysqli->query("SELECT * FROM dosen");
    $matkulResult =  $mysqli->query("SELECT * FROM matkul");
    $no_jadwal_hdr = $row['no_jadwal_hdr'];
    $jadwalHdrResult = $mysqli->query("SELECT * FROM jadwal_hdr WHERE no_jadwal_hdr='$no_jadwal_hdr'");
    $rowJadwalHdr = $jadwalHdrResult->fetch_assoc();
    if (!$rowJadwalHdr) {
        redirect("not-found");
        exit;
    }
    if(isset($rowJadwalHdr['tahun_kurikulum'])) {
        $tahun_kurikulum = $rowJadwalHdr['tahun_kurikulum'];
    }
    $no_prodi = $rowJadwalHdr['no_prodi'];
?>
<div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Edit Jadwal</h5>
    </div>
    <div class="card-body">
        <form method="post">
            <input name="no_jadwal_hdr" type="hidden" value="<?= $row['no_jadwal_hdr'] ?>">
            <input name="no_jadwal_detail" type="hidden" value="<?= $row['no_jadwal_detail'] ?>">
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Ruang</label>
                <div class="col-sm-10">
                    <input class="form-control" list="ruang-list" placeholder="Cari..." name="kode_ruang" value="<?= $row['kode_ruang'] ?>">
                    <datalist id="ruang-list">
                        <?php 
                            while ($rowRuang = $ruangResult->fetch_assoc()) {
                        ?>
                        <option value="<?= $rowRuang['kode_ruang'] ?>"><?= $rowRuang['nama_ruang']?></option>
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
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">NID Dosen</label>
                <div class="col-sm-10">
                    <input class="form-control" list="dosen-list" placeholder="Cari..." name="nid_dosen" value="<?= $row['nid_dosen'] ?>">
                    <datalist id="dosen-list">
                        <?php 
                            while ($rowDosen = $dosenResult->fetch_assoc()) {
                        ?>
                        <option value="<?= $rowDosen['nid_dosen'] ?>"><?= $rowDosen['nama_dosen']?></option>
                        <?php
                            }
                        ?>
                    </datalist>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Mata Kuliah</label>
                <div class="col-sm-10">
                    <input class="form-control" list="matkul-list" placeholder="Cari..." name="kode_matkul" value="<?= $row['kode_matkul'] ?>">
                    <datalist id="matkul-list">
                        <?php 
                            while ($rowMatkul = $matkulResult->fetch_assoc()) {
                        ?>
                        <option value="<?= $rowMatkul['kode_matkul'] ?>"><?= $rowMatkul['nama_matkul']?></option>
                        <?php
                            }
                        ?>
                    </datalist>
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