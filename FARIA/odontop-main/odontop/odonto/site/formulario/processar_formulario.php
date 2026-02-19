<?php

$host = 'localhost';  
$user = 'root';       
$password = '';      
$database = 'agenda'; 


$conn = new mysqli($host, $user, $password, $database);


if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}


$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$endereco = $_POST['endereco'];
$data_exame = $_POST['data_exame'];


$sql = "INSERT INTO consulta (nome, cpf, email, telefone, endereco, data_exame) 
        VALUES ('$nome', '$cpf', '$email', '$telefone', '$endereco', '$data_exame')";


if ($conn->query($sql) === TRUE) {
    echo "Exame agendado com sucesso!";
} else {
    echo "Erro ao agendar o exame: " . $conn->error;
}


$conn->close();
?>