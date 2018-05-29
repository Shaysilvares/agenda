<?php

include_once('conexao.php');

$id = $_POST['id'];
$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$rua = $_POST['rua'];
$numero = $_POST['numero'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];

$sql = "UPDATE contatos SET nome='$nome', telefone='$telefone', rua='$rua', numero=$numero, cidade='$cidade', bairro='$bairro' WHERE id=$id";

if (mysqli_query($conn, $sql)) {
    header('Location: http://localhost/apsweb/');
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>