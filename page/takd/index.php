<?php 
    $result = $mysqli->query("SELECT * FROM takd");
?>

<div class="card">
    <div class="card-header row justify-content-between">
        <h5 class="col">Daftar Tahun Akademik</h5>
        <div class="col-lg-2 col-md-3 col-sm-4 row justify-content-end">
            <a href="/<?= $folder ?>/takd/new">
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
                    <th>Kode Tahun Akademik</th>
                    <th>Dibuat Pada</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php 
                    while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?= $row['kode_takd'] ?></td>
                    <td><?= $row['dibuat_pada'] ?></td>
                    <td>
                        <?php 
                        form_delete_start('delete-'.$row['kode_takd'], "/$folder/takd/delete", 'post');
                        ?>
                            <input type="hidden" name="kode_takd" value="<?= $row['kode_takd'] ?>">
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

