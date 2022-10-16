<?php 
    $result = $mysqli->query("SELECT * FROM jadwal_hdr h JOIN prodi p ON h.no_prodi=p.no_prodi");
?>
<div class="card">
    <div class="card-header row justify-content-between">
        <h5 class="col">Daftar Jadwal Header</h5>
        <div class="col-lg-2 col-md-3 col-sm-4 row justify-content-end">
            <a href="/<?= $folder ?>/prodi/jadwal_hdr/new">
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
                    <th>No Jadwal Header</th>
                    <th>Nama Prodi</th>
                    <th>Semester</th>
                    <th>Tahun Akademik</th>
                    <th>Tahun Kurikulum</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php 
                    while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?= $row['no_jadwal_hdr'] ?></td>
                    <td><?= $row['nama_prodi'] ?></td>
                    <td><?= $row['semester'] ?></td>
                    <td><?= $row['tahun_akademik'] ?></td>
                    <td><?= $row['tahun_kurikulum'] ?></td>
                    <td>
                        <a href="/<?= $folder ?>/prodi/jadwal_hdr/edit?no_jadwal_hdr=<?= $row['no_jadwal_hdr'] ?>">
                            <button type="button" class="btn btn-icon btn-outline-primary">
                                <span class="tf-icons bx bx-edit-alt"></span>
                            </button>
                        </a>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>