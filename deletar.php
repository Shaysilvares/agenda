<?php

    include_once('conexao.php');

$id = $_GET['id'];
// sql to delete a record
$sql = "DELETE FROM contatos WHERE id=$id";

if (mysqli_query($conn, $sql)) {
    header('Location: http://localhost/apsweb/');
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}


