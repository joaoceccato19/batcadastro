<?php

class perfil {
    public $usuario;
    public $email;
    public $senha;

    public function __construct($usuario, $email, $senha) {
        $this->usuario = $usuario;
        $this->email = $email;
        $this->senha = password_hash($senha, PASSWORD_DEFAULT);
    }
}


function registroexiste($conn, $usuario, $email){
    $sql = $conn->prepare("SELECT * FROM perfilusuario WHERE usuario = ? OR email = ?");
    $sql->bind_param("ss", $usuario, $email);
    $sql->execute();
    $result = $sql->get_result();
    return $result->num_rows > 0;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];

    $conn = new mysqli('localhost', 'root', '190304', 'batcadastro');

    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    if (registroexiste($conn, $usuario, $email)) {
        die('registro já existe');
    }

   
}




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $perfil = new perfil($usuario, $email, $senha);


    $conn = new mysqli('localhost', 'root', '190304', 'batcadastro');

  
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

   
    $sql = "INSERT INTO perfilusuario (usuario, email, senha) 
            VALUES ('$perfil->usuario', '$perfil->email', '$perfil->senha')";

   
    if ($conn->query($sql) === TRUE) {
        echo "Novo registro criado com sucesso";
    } else {
        echo "Erro ao criar registro: " . $conn->error;
    }

    $conn->close();
}
?>
