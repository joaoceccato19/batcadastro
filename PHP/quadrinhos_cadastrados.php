<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quadrinhos Cadastrados</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="quadrinhoscadastrados.css">
</head>
<body>
    <div class="container">
        <div class="navbar">
            <img src="batman.jpg-removebg-preview.png" alt="Batman Logo">
            <div class="right">
                <a href="registro.html" class="button">Cadastrar</a>
                <a href="loginquadrinhos.html" class="button">Login</a>
            </div>
        </div>
        <h1>Quadrinhos Cadastrados</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome do Quadrinho</th>
                    <th>Número de Páginas</th>
                    <th>Capa</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'conexao.php';
                
                $sql = "SELECT id, nomequadrinho, numerodepaginas, capaquadrinho FROM quadrinhos";
                $result = $conn->query($sql);
                
                if ($result !== false && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["nomequadrinho"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["numerodepaginas"]) . "</td>";
                        echo "<td><img src='data:image/jpeg;base64," . base64_encode($row["capaquadrinho"]) . "' alt='Capa do Quadrinho' width='100'></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Nenhum quadrinho cadastrado</td></tr>";
                }
                
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
