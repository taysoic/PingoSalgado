<?php

include 'layout/header.php'; 

// Ativar erros do PDO
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Buscar trabalhadores para preencher o select e a tabela
$stmt = $conn->query("SELECT * FROM trabalhadores");
$trabalhadores = $stmt->fetchAll(PDO::FETCH_ASSOC);

// INSERIR Trabalhador
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['inserir'])) {
    $nome = $_POST['nome_trabalhador'];
    $genero = $_POST['genero'];
    $email = $_POST['email'];
    $nascimento = $_POST['data_nascimento'];

    $stmt = $conn->prepare("INSERT INTO trabalhadores (nome_trabalhador, genero, email, data_nascimento) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nome, $genero, $email, $nascimento]);

    header("Location: trabalhadores.php");
    exit;
}

// EDITAR Trabalhador
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar'])) {
    $id = $_POST['id_trabalhador'];
    $nome = $_POST['nome_trabalhador'];
    $genero = $_POST['genero'];
    $email = $_POST['email'];
    $nascimento = $_POST['data_nascimento'];

    $stmt = $conn->prepare("UPDATE trabalhadores SET nome_trabalhador = ?, genero = ?, email = ?, data_nascimento = ? WHERE id_trabalhador = ?");
    $stmt->execute([$nome, $genero, $email, $nascimento, $id]);

    header("Location: trabalhadores.php");
    exit;
}

// REMOVER Trabalhador
if (isset($_GET['remover'])) {
    $id = $_GET['remover'];
    $stmt = $conn->prepare("DELETE FROM trabalhadores WHERE id_trabalhador = ?");
    $stmt->execute([$id]);
    
    header("Location: trabalhadores.php");
    exit;
}

// Buscar dados do trabalhador para edição, se aplicável
$editando = false;
$trabalhador_editar = ['id_trabalhador' => '', 'nome_trabalhador' => '', 'genero' => '', 'email' => '', 'data_nascimento' => ''];
if (isset($_GET['editar'])) {
    $editando = true;
    $id = (int) $_GET['editar'];
    $stmt = $conn->prepare("SELECT * FROM trabalhadores WHERE id_trabalhador = ?");
    $stmt->execute([$id]);
    $trabalhador_editar = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>

<div class="container-fluid p-4">
    <div class="row">
        <div class="col-xl-4 col-12 mb-4">
            <div class="card">
                <div class="card-header bg-success">
                    <div class="card-title text-white fw-semibold">
                        <?= $editando ? 'Editar Trabalhador' : 'Adicionar Trabalhador' ?>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <input type="hidden" name="id_trabalhador" value="<?= $trabalhador_editar['id_trabalhador'] ?>">
                        
                        <div class="row">
                            <div class="col-12 mb-4">
                                <label class="mb-1">Nome</label>
                                <input type="text" name="nome_trabalhador" class="form-control" value="<?= htmlspecialchars($trabalhador_editar['nome_trabalhador']) ?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4 mb-4">
                                <label class="mb-1">Género</label>
                                <input type="text" name="genero" class="form-control" value="<?= htmlspecialchars($trabalhador_editar['genero']) ?>" required>
                            </div>
                            <div class="col-4 mb-4">
                                <label class="mb-1">Email</label>
                                <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($trabalhador_editar['email']) ?>" required>
                            </div>
                            <div class="col-4 mb-4">
                                <label class="mb-1">Nascimento</label>
                                <input type="date" name="data_nascimento" class="form-control" value="<?= htmlspecialchars($trabalhador_editar['data_nascimento']) ?>" required>
                            </div>
                        </div>
                        <div class="card-footer bg-white d-flex align-items-center justify-content-end">
                            <?php if ($editando): ?>
                                <button type="submit" class="btn btn-success" name="editar">Editar</button>
                                <a href="trabalhadores.php" class="btn btn-secondary ms-2">Cancelar</a>
                            <?php else: ?>
                                <button type="submit" class="btn btn-success" name="inserir">Adicionar</button>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-7 col-12 container-fluid">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Género</th>
                        <th>Email</th>
                        <th>Data de nascimento</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($trabalhadores as $t): ?>
                        <tr>
                            <td><?= htmlspecialchars($t['nome_trabalhador']) ?></td>
                            <td><?= htmlspecialchars($t['genero']) ?></td>
                            <td><?= htmlspecialchars($t['email']) ?></td>
                            <td><?= date('d/m/Y', strtotime($t['data_nascimento'])) ?></td>
                            <td class="d-flex align-items-center justify-content-center gap-2">
                                <a href="?editar=<?= $t['id_trabalhador'] ?>" class="btn btn-sm btn-light border">
                                    Editar
                                </a>
                                <a href="?remover=<?= $t['id_trabalhador'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja remover?');">
                                    Remover
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'layout/footer.php'; ?>
