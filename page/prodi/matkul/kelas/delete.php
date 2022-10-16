<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $result = $mysqli->query("SELECT * FROM kelas WHERE kode_kelas='".$_POST['kode_kelas']."'");
    $row = $result->fetch_assoc();
    if (!$row) {
        redirect('not-found');
        exit;
    }
    $statement = $mysqli->prepare("DELETE FROM kelas WHERE kode_kelas=?");
    $statement->bind_param('s', $_POST['kode_kelas']);
    $statement->execute();
    $statement->close();
    $kode_matkul = $row['kode_matkul'];
    redirect("prodi/matkul/detail?kode_matkul=$kode_matkul");
    exit;
}
?>