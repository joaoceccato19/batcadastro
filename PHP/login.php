<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

$conn = new mysqli('localhost', 'root', '190304', 'batcadastro');


if($conn->connect_error){
    die("falha em login" . $conn->connect_error);
}


$sql =$conn->prepare("SELECT id, senha FROM perfilusuario WHERE usuario = ?");
$sql->bind_param("s", $usuario);
$sql->execute();
$result = $sql->get_result();

if($result->num_rows == 1){
    $user = $result->fetch_assoc();
    if(password_verify($senha, $user['senha'])){
        $_session['user_id'] = $user9['id'];
        header('location: home.html');
        exit;
        } else {
            echo "Senha incorreta.";
        }
    } else {
        echo "Usuário não encontrado.";
    }
    }


