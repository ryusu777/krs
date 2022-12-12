<?php
    if(!isset($_GET['no_prodi'])) {
        $result = $mysqli->query("SELECT * FROM prodi"); 
?>
<div class="card">
    <div class="card-header">
        <h1>Pilih prodi</h1>
    </div>
    <div class="card-body">
        <?php
            while ($row = $result->fetch_assoc()) {
        ?>
        <a href="/<?= $folder ?>/jadwal?no_prodi=<?= $row['no_prodi'] ?>">
            <button type="button" class="btn btn-primary">
                <?= $row['nama_prodi'] ?>
            </button>
        </a>
        <?php 
            }
        ?>
    </div>
</div>
<?php
        return;
    }
?>
<?php
    $no_prodi = $_GET['no_prodi'];
    $result = $mysqli->query("SELECT * 
        FROM jadwal_hdr h JOIN takd t on h.kode_takd=t.kode_takd JOIN dosen d on h.nid_dosen=d.nid_dosen jOIN prodi p on h.no_prodi=p.no_prodi JOIN kurikulum k on h.kode_kurikulum=k.kode_kurikulum
        WHERE h.no_prodi=$no_prodi");
?>
<div class="card mb-4">
    <div class="card-header row justify-content-between">
        <h5 class="col">Daftar Jadwal</h5>
        <div class="col-lg-2 col-md-3 col-sm-4 row justify-content-end">
            <a href="/<?= $folder ?>/jadwal/new?no_prodi=<?= $no_prodi ?>">
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
                    <th>No Jadwal</th>
                    <th>Kode Tahun Akademik</th>
                    <th>Nama Dosen</th>
                    <th>Nama Prodi</th>
                    <th>Semester</th>
                    <th>Kode Kurikulum</th>
                    <th>Dibuat Pada</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php 
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?= $row['no_jadwal_hdr'] ?></td>
                    <td><?= $row['kode_takd'] ?></td>
                    <td><?= $row['nama_dosen'] ?></td>
                    <td><?= $row['nama_prodi'] ?></td>
                    <td><?= $row['semester'] ?></td>
                    <td><?= $row['kode_kurikulum'] ?></td>
                    <td><?= $row['dibuat_pada'] ?></td>
                    <td>
                        <a href="/<?= $folder ?>/jadwal/detail?no_jadwal_hdr=<?= $row['no_jadwal_hdr'] ?>">
                            <button type="button" class="btn btn-icon btn-outline-primary">
                                <span class="tf-icons bx bx-show"></span>
                            </button>
                        </a>
                        <?php 
                        form_delete_start('delete-'.$i, "/$folder/jadwal/delete", 'post');
                        ?>
                            <input type="hidden" name="no_jadwal_hdr" value="<?= $row['no_jadwal_hdr'] ?>">
                            <input type="hidden" name="no_prodi" value="<?= $row['no_prodi'] ?>">
                        <?php 
                        form_delete_end();
                        ?>
                    </td>
                </tr>
                <?php
                        $i++;
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>