<?php
    $result = $mysqli->query("SELECT * FROM jadwal_dtl_log");
?>
<div class="card">
    <div class="card-header row justify-content-between">
        <h5 class="col">Jadwal Detail</h5>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>No Jadwal Detail</th>
                    <th>Kode Ruang</th>
                    <th>Kode Matkul</th>
                    <th>No Jadwal Header</th>
                    <th>NID Dosen</th>
                    <th>Hari</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Aksi</th>
                    <th>Aksi Pada</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php 
                    while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?= $row['no_jadwal_detail'] ?></td>
                    <td><?= $row['kode_ruang'] ?></td>
                    <td><?= $row['kode_matkul'] ?></td>
                    <td><?= $row['no_jadwal_hdr'] ?></td>
                    <td><?= $row['nid_dosen'] ?></td>
                    <td><?= $row['hari'] ?></td>
                    <td><?= $row['jam_mulai'] ?></td>
                    <td><?= $row['jam_selesai'] ?></td>
                    <td><?= $row['aksi'] ?></td>
                    <td><?= $row['aksi_pada'] ?></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>