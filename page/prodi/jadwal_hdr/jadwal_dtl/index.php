<?php 
    if (!isset($no_jadwal_hdr)) {
        include "page/not-found.php";
        exit;
    }
    $result = $mysqli->query("SELECT 
        jd.no_jadwal_detail,
        m.nama_matkul,
        jd.hari,
        k.kode_kelas,
        r.nama_ruang,
        jd.jam_mulai,
        jd.jam_selesai,
        m.sks,
        m.smt_matkul,
        d.nama_dosen
        FROM jadwal_dtl jd
            JOIN kelas      k   ON jd.kode_kelas    = k.kode_kelas
            JOIN jadwal_hdr jh  ON jd.no_jadwal_hdr = jh.no_jadwal_hdr
            JOIN ruang      r   ON jd.kode_ruang    = r.kode_ruang
            JOIN matkul     m   ON k.kode_matkul    = m.kode_matkul
            JOIN dosen      d   ON k.nid_dosen      = d.nid_dosen
        WHERE jd.no_jadwal_hdr=$no_jadwal_hdr");
?>
<div class="card">
    <div class="card-header row justify-content-between">
        <h5 class="col">Jadwal Detail</h5>
        <div class="col-lg-2 col-md-3 col-sm-4 row justify-content-end">
            <a href="/<?= $folder ?>/prodi/jadwal_hdr/jadwal_dtl/new?no_jadwal_hdr=<?= $no_jadwal_hdr ?>">
                <button type="button" class="btn btn-primary">
                    <span class="tf-icons bx bx-plus"></span>&nbsp; Tambah
                </button>
            </a>
        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Matakuliah</th>
                    <th>Hari</th>
                    <th>Kelas</th>
                    <th>Ruang</th>
                    <th>Mulai</th>
                    <th>Selesai</th>
                    <th>Sks</th>
                    <th>Semester</th>
                    <th>Dosen</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php 
                    while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?= $row['nama_matkul'] ?></td>
                    <td><?= $row['hari'] ?></td>
                    <td><?= $row['kode_kelas'] ?></td>
                    <td><?= $row['nama_ruang'] ?></td>
                    <td><?= $row['jam_mulai'] ?></td>
                    <td><?= $row['jam_selesai'] ?></td>
                    <td><?= $row['sks'] ?></td>
                    <td><?= $row['smt_matkul'] ?></td>
                    <td><?= $row['nama_dosen'] ?></td>
                    <td>
                        <a href="/<?= $folder ?>/prodi/jadwal_hdr/jadwal_dtl/edit?no_jadwal_detail=<?= $row['no_jadwal_detail'] ?>">
                            <button type="button" class="btn btn-icon btn-outline-primary">
                                <span class="tf-icons bx bx-edit-alt"></span>
                            </button>
                        </a>
                        <?php 
                        form_delete_start('delete-'.$row['no_jadwal_detail'], "/$folder/prodi/jadwal_hdr/jadwal_dtl/delete", 'post');
                        ?>
                            <input type="hidden" name="no_jadwal_detail" value="<?= $row['no_jadwal_detail'] ?>">
                        <?php 
                        form_delete_end();
                        ?>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>