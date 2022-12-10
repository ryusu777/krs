<?php 
if (!isset($_GET['no_jadwal_hdr'])) {
    redirect("not-found");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $statement = $mysqli->prepare("INSERT INTO jadwal_dtl 
        (kode_ruang,
        kode_matkul, 
        no_jadwal_hdr, 
        nid_dosen, 
        hari, 
        jam_mulai, 
        jam_selesai) 
        VALUES 
        (?, ?, ?, ?, ?, ?, ?)");
    $statement->bind_param('sssssss', 
        $_POST['kode_ruang'],
        $_POST['kode_matkul'], 
        $_POST['no_jadwal_hdr'],
        $_POST['nid_dosen'],
        $_POST['hari'],
        $_POST['jam_mulai'],
        $_POST['jam_selesai']
    );
    $statement->execute();
    $statement->close();
    $no_jadwal_hdr = $_POST['no_jadwal_hdr'];
    redirect("prodi/jadwal_hdr/detail?no_jadwal_hdr=$no_jadwal_hdr");
    exit;
}
else {
    $ruangResult = $mysqli->query("SELECT * FROM ruang");
    $no_jadwal_hdr = $_GET['no_jadwal_hdr'];
    $jadwalHdrResult = $mysqli->query("SELECT * FROM jadwal_hdr WHERE no_jadwal_hdr=$no_jadwal_hdr");
    $rowJadwalHdr = $jadwalHdrResult->fetch_assoc();
    if (!$rowJadwalHdr) {
        redirect("not-found");
        exit;
    }
    $tahun_kurikulum = $rowJadwalHdr['tahun_kurikulum'];
    $no_prodi = $rowJadwalHdr['no_prodi'];
    $kelasResult = $mysqli->query("SELECT 
        m.nama_matkul,
        k.nama_ruang,
        d.nama_dosen
        FROM kelas k
        JOIN matkul m ON m.kode_matkul=$tahun_kurikulum AND k.nama_ruang=m.nama_ruang
        JOIN dosen d ON d.nid_dosen=k.nid_dosen
        WHERE m.no_prodi=$no_prodi");
?>
<div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Tambah Jadwal</h5>
    </div>
    <div class="card-body">
        <form method="post">
            <input name="no_jadwal_hdr" type="hidden" value="<?= $no_jadwal_hdr ?>">
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Ruang</label>
                <div class="col-sm-10">
                    <input class="form-control" list="ruang-list" placeholder="Cari..." name="kode_ruang">
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
                        <option value="<?= strtoupper($day) ?>"><?= $day ?></option>
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
                            while ($row = $kelasResult->fetch_assoc()) {
                        ?>
                        <option value="<?= $row['kode_kelas'] ?>"><?= $row['nama_matkul'].', '.$row['nama_dosen'] ?></option>
                        <?php
                            }
                        ?>
                    </datalist>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Jam Mulai</label>
                <div class="col-sm-10">
                    <input class="form-control" type="time" name="jam_mulai" id="jam-mulai-input">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Jam Selesai</label>
                <div class="col-sm-10">
                    <input class="form-control" type="time" name="jam_selesai" id="jam-selesai-input">
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