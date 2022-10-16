<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $statement = $mysqli->prepare("DELETE FROM kelas WHERE kode_kelas=?");
    $statement->bind_param('s', $_POST['kode_kelas']);
    $statement->execute();
    $statement->close();
    redirect("prodi/matkul/kelas/");
    exit;
}
?>