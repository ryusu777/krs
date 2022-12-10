<?php 
    if(!isset($no_prodi)) {
        include "page/not-found.php";
        exit;
    }
    $result = $mysqli->query("SELECT * 
        FROM matkul m
        JOIN prodi p ON m.no_prodi=p.no_prodi
        WHERE m.no_prodi=$no_prodi");
?>

<div class="card">
    <div class="card-header row justify-content-between">
        <h5 class="col">Daftar Mata Kuliah</h5>
        <div class="col-lg-2 col-md-3 col-sm-4 row justify-content-end">
            <a href="/<?= $folder ?>/prodi/matkul/new?no_prodi=<?= $no_prodi ?>">
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
                    <th>Kode Matkul</th>
                    <th>Kode Kurikulum</th>
                    <th>No Prodi</th>
                    <th>SKS</th>
                    <th>Semester</th>
                    <th>Nama Matkul</th>
                    <th>Dibuat Pada</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php 
                    while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?= $row['kode_matkul'] ?></td>
                    <td><?= $row['kode_kurikulum'] ?></td>
                    <td><?= $row['no_prodi'] ?></td>
                    <td><?= $row['sks'] ?></td>
                    <td><?= $row['smt_matkul'] ?></td>
                    <td><?= $row['nama_matkul'] ?></td>
                    <td><?= $row['dibuat_pada'] ?></td>
                    <td>
                        <a href="/<?= $folder ?>/prodi/matkul/detail?kode_matkul=<?= $row['kode_matkul'] ?>">
                            <button type="button" class="btn btn-icon btn-outline-primary">
                                <span class="tf-icons bx bx-show"></span>
                            </button>
                        </a>
                        <a href="/<?= $folder ?>/prodi/matkul/edit?kode_matkul=<?= $row['kode_matkul'] ?>">
                            <button type="button" class="btn btn-icon btn-outline-primary">
                                <span class="tf-icons bx bx-edit-alt"></span>
                            </button>
                        </a>
                        <?php 
                        form_delete_start('delete-'.$row['kode_matkul'], "/$folder/prodi/matkul/delete", 'post');
                        ?>
                            <input type="hidden" name="kode_matkul" value="<?= $row['kode_matkul'] ?>">
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

