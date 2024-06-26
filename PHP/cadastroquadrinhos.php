<?php

class Quadrinho {
    public $nomequadrinho;
    public $numeropaginas;

    public function __construct($nomequadrinho, $numeropaginas) {
        $this->nomequadrinho = $nomequadrinho;
        $this->numeropaginas = $numeropaginas;
    }
}

class UploadCapa {
    private $capaquadrinho;

    public function __construct($capaquadrinho) {
        $this->capaquadrinho = $capaquadrinho;
    }

    public function validarCapa() {
        if ($this->capaquadrinho['size'] > 2097152) { // 2MB
            die("Imagem muito grande!");
        } else {
            echo "Imagem enviada com sucesso!";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomequadrinho = $_POST['nome_do_quadrinho'];
    $numeropaginas = $_POST['numero_de_paginas'];
    $capaquadrinho = $_FILES['capa_do_quadrinho'];

    $quadrinho = new Quadrinho($nomequadrinho, $numeropaginas);
    $upload = new UploadCapa($capaquadrinho);
    $upload->validarCapa();

    
    $conn = new mysqli('localhost', 'root', '190304', 'batcadastro');
    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    
    $capaBinaria = file_get_contents($capaquadrinho['tmp_name']);

    
    $query = $conn->prepare("INSERT INTO quadrinhos (nomequadrinho, numerodepaginas, capaquadrinho) VALUES (?, ?, ?)");
    $query->bind_param("sis", $nomequadrinho, $numeropaginas, $capaBinaria);

    if ($query->execute()) {
        echo "Registro inserido com sucesso!";
    } else {
        echo "Erro ao inserir registro: " . $query->error;
    }

    $query->close();
    $conn->close();
}
?>
