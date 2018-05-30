<?php

include_once('conexao.php');

$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$rua = $_POST['rua'];
$numero = $_POST['numero'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];

$sql = "INSERT INTO contatos (nome, telefone, rua, numero, bairro, cidade)
VALUES ('$nome', '$telefone', '$rua', $numero, '$bairro', '$cidade')";

if (mysqli_query($conn, $sql)) {
    header('Location: http://localhost/apsweb/');
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

?>