<?php include 'includes/conexao.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pingo Salgado</title>
    
    <link rel="icon" href="assets/images/logo.png" type="image/png"/>

    <!-- CSS -->
    <link rel="stylesheet" href="style.css">

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css"/>           

</head>
<body>

    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="assets/images/logo.png" width="20px"/> Pingo Salgado
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                <a class="topEnlacesEstilo" href="/pt/supermercados-portugal">Supermercados</a>
        </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="produtos.php">Produtos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="trabalhadores.php">Trabalhadores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="seccoes.php">Secções</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="fornecedores.php">Fornecedores</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</body>
</html>

