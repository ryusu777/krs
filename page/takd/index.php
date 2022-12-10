<?php 
    $result = $mysqli->query("SELECT * FROM takd");
?>

<div class="card">
    <div class="card-header row justify-content-between">
        <h5 class="col">Daftar Ruang</h5>
        <div class="col-lg-2 col-md-3 col-sm-4 row justify-content-end">
            <a href="/<?= $folder ?>/ruang/new">
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
                    <td><?= $row['kode_tkad'] ?></td>
                    <td>
                        <a href="/<?= $folder ?>/ruang/edit?nid=<?= $row['kode_tkad'] ?>">
                            <button type="button" class="btn btn-icon btn-outline-primary">
                                <span class="tf-icons bx bx-edit-alt"></span>
                            </button>
                        </a>
                        <?php 
                        form_delete_start('delete-'.$row['kode_tkad'], "/$folder/tkad/delete", 'post');
                        ?>
                            <input type="hidden" name="kode_tkad" value="<?= $row['kode_tkad'] ?>">
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

