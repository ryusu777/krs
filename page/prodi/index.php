<?php 
    $result = $mysqli->query("SELECT * FROM prodi");
?>
<div class="card">
    <div class="card-header row justify-content-between">
        <h5 class="col">Daftar Prodi</h5>
        <div class="col-lg-2 col-md-3 col-sm-4 row justify-content-end">
            <a href="/<?= $folder ?>/prodi/new">
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
                    <th>No Prodi</th>
                    <th>Nama Prodi</th>
                    <th>Di Buat Pada</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php 
                    while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?= $row['no_prodi'] ?></td>
                    <td><?= $row['nama_prodi'] ?></td>
                    <td><?= $row['dibuat_pada'] ?></td>
                    <td>
                        <a href="/<?= $folder ?>/prodi/detail?no_prodi=<?= $row['no_prodi'] ?>">
                            <button type="button" class="btn btn-icon btn-outline-primary">
                                <span class="tf-icons bx bx-show"></span>
                            </button>
                        </a>
                        <a href="/<?= $folder ?>/prodi/edit?no_prodi=<?= $row['no_prodi'] ?>">
                            <button type="button" class="btn btn-icon btn-outline-primary">
                                <span class="tf-icons bx bx-edit-alt"></span>
                            </button>
                        </a>
                        <?php 
                        form_delete_start('delete-'.$row['no_prodi'], "/$folder/prodi/delete", 'post');
                        ?>
                            <input type="hidden" name="no_prodi" value="<?= $row['no_prodi'] ?>">
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