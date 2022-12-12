<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $statement = $mysqli->prepare("DELETE FROM matkul WHERE kode_matkul=?");
    $statement->bind_param('s', $_POST['kode_matkul']);
    $statement->execute();
    $statement->close();
    $no_prodi = $_POST['no_prodi'];
    redirect("matkul?no_prodi=$no_prodi");
    exit;
}
?>