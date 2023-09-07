<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "conveniencia";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Recebe o código de barras enviado pelo formulário
$cod_barra = $_GET['cod_barra'];

// Consulta o banco de dados para buscar o produto com o código de barras recebido
$sql = "SELECT * FROM estoque WHERE cod_barra = $cod_barra";
$result = mysqli_query($conn, $sql);

// Verifica se encontrou algum produto
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    // Retorna os dados do produto em formato JSON
    echo json_encode($row);
} else {
    // Se não encontrou, retorna null em formato JSON
    echo json_encode(null);
}

mysqli_close($conn);
?>