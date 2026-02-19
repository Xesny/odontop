<?php

$host = 'localhost';  
$user = 'root';       
$password = '';       
$database = 'agenda'; 


$conn = new mysqli($host, $user, $password, $database);


if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}


$nome = isset($_GET['nome']) ? $_GET['nome'] : '';
$cpf = isset($_GET['cpf']) ? $_GET['cpf'] : '';

 
$sql = "SELECT * FROM consulta WHERE nome LIKE ? AND cpf LIKE ?";


$stmt = $conn->prepare($sql);

 
if ($stmt === false) {
    die("Erro na preparação da consulta: " . $conn->error);
}


$stmt->bind_param("ss", $nome, $cpf);  


$stmt->execute();


$result = $stmt->get_result();


if ($result->num_rows > 0) {
    
    echo "<table>";
    echo "<tr><th>Nome</th><th>Data do Exame</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['nome']) . "</td>
                <td>" . htmlspecialchars($row['data_exame']) . "</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "Nenhum agendamento encontrado com o nome e CPF fornecidos.";
}


$conn->close();
?>
