<?php 
    $result = $mysqli->query("SELECT * FROM kurikulum");
?>
<div class="card">
    <div class="card-header row justify-content-between">
        <h5 class="col">Daftar Kurikulum</h5>
        <div class="col-lg-2 col-md-3 col-sm-4 row justify-content-end">
            <a href="/<?= $folder ?>/kurikulum/new">
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
                    <th>Kode Kurikulum</th>
                    <th>Tahun Berlaku</th>
                    <th>Di Buat Pada</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php 
                    while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?= $row['kode_kurikulum'] ?></td>
                    <td><?= $row['tahun_berlaku'] ?></td>
                    <td><?= $row['dibuat_pada'] ?></td>
                    <td>
                        <?php 
                        form_delete_start('delete-'.$row['kode_kurikulum'], "/$folder/kurikulum/delete", 'post');
                        ?>
                            <input type="hidden" name="kode_kurikulum" value="<?= $row['kode_kurikulum'] ?>">
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