<?php 
    if (!isset($no_jadwal_hdr)) {
        include "page/not-found.php";
        exit;
    }
    $result = $mysqli->query("SELECT 
        no_jadwal_detail,
        nama_matkul,
        hari,
        nama_ruang,
        jam_mulai,
        jam_selesai,
        sks,
        smt_matkul,
        nama_dosen
        FROM vjadwal
        WHERE no_jadwal_hdr='$no_jadwal_hdr'");
?>
<div class="card">
    <div class="card-header row justify-content-between">
        <h5 class="col">Jadwal Detail</h5>
        <div class="col-lg-2 col-md-3 col-sm-4 row justify-content-end">
            <a href="/<?= $folder ?>/jadwal/jadwal_dtl/new?no_jadwal_hdr=<?= $no_jadwal_hdr ?>">
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
                    <th>Mata Kuliah</th>
                    <th>Hari</th>
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
                    <td><?= $row['nama_ruang'] ?></td>
                    <td><?= $row['jam_mulai'] ?></td>
                    <td><?= $row['jam_selesai'] ?></td>
                    <td><?= $row['sks'] ?></td>
                    <td><?= $row['smt_matkul'] ?></td>
                    <td><?= $row['nama_dosen'] ?></td>
                    <td>
                        <a href="/<?= $folder ?>/jadwal/jadwal_dtl/edit?no_jadwal_detail=<?= $row['no_jadwal_detail'] ?>">
                            <button type="button" class="btn btn-icon btn-outline-primary">
                                <span class="tf-icons bx bx-edit-alt"></span>
                            </button>
                        </a>
                        <?php 
                        form_delete_start('delete-'.$row['no_jadwal_detail'], "/$folder/jadwal/jadwal_dtl/delete", 'post');
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