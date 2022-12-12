<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $statement = $mysqli->prepare("DELETE FROM kurikulum WHERE kode_kurikulum=?");
    $statement->bind_param('s', $_POST['kode_kurikulum']);
    $statement->execute();
    $statement->close();
    redirect("kurikulum");
    exit;
}
?>