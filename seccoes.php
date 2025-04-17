<?php

include 'layout/header.php'; 

// Ativar erros do PDO
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Buscar trabalhadores para preencher o select
$stmt = $conn->query("SELECT * FROM trabalhadores");
$trabalhadores = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Buscar seções para preencher o select
$stmt = $conn->query("SELECT * FROM seccao");
$seccoes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Buscar seções com o nome do trabalhador
$stmt = $conn->query("SELECT seccao.*, trabalhadores.nome_trabalhador 
                      FROM seccao 
                      JOIN trabalhadores ON seccao.id_trabalhador = trabalhadores.id_trabalhador");
$seccao = $stmt->fetchAll(PDO::FETCH_ASSOC);

// INSERIR Seção
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['inserir'])) {
    $nome_seccao = $_POST['nome_seccao'];
    $nome_trabalhador = $_POST['nome_trabalhador'];

    // Obter ID do trabalhador pelo nome
    $stmt = $conn->prepare("SELECT id_trabalhador FROM trabalhadores WHERE nome_trabalhador = ?");
    $stmt->execute([$nome_trabalhador]);
    $trabalhador = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($trabalhador) {
        $id_trabalhador = $trabalhador['id_trabalhador'];
        $stmt = $conn->prepare("INSERT INTO seccao (nome_seccao, id_trabalhador) VALUES (?, ?)");
        $stmt->execute([$nome_seccao, $id_trabalhador]);

        header("Location: seccoes.php");
        exit;
    } else {
        echo "Erro: Trabalhador não encontrado.";
    }
}

// EDITAR Seção
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar'])) {
    $id = $_POST['id_seccao'];
    $nome_seccao = $_POST['nome_seccao'];
    $nome_trabalhador = $_POST['nome_trabalhador'];

    // Obter ID do trabalhador pelo nome
    $stmt = $conn->prepare("SELECT id_trabalhador FROM trabalhadores WHERE nome_trabalhador = ?");
    $stmt->execute([$nome_trabalhador]);
    $trabalhador = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($trabalhador) {
        $id_trabalhador = $trabalhador['id_trabalhador'];
        $stmt = $conn->prepare("UPDATE seccao SET nome_seccao = ?, id_trabalhador = ? WHERE id_seccao = ?");
        $stmt->execute([$nome_seccao, $id_trabalhador, $id]);

        header("Location: seccoes.php");
        exit;
    } else {
        echo "Erro: Trabalhador não encontrado.";
    }
}

// REMOVER Seção
if (isset($_GET['remover'])) {
    $id = (int) $_GET['remover'];
    $stmt = $conn->prepare("DELETE FROM seccao WHERE id_seccao = ?");
    $stmt->execute([$id]);

    header("Location: seccoes.php");
    exit;
}

// Buscar dados da seção para edição, se aplicável
$editando = false;
$secao_editar = ['id_seccao' => '', 'nome_seccao' => '', 'nome_trabalhador' => ''];
if (isset($_GET['editar'])) {
    $editando = true;
    $id = (int) $_GET['editar'];
    $stmt = $conn->prepare("SELECT seccao.*, trabalhadores.nome_trabalhador 
                            FROM seccao 
                            JOIN trabalhadores ON seccao.id_trabalhador = trabalhadores.id_trabalhador
                            WHERE seccao.id_seccao = ?");
    $stmt->execute([$id]);
    $secao_editar = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>

<div class="container-fluid p-4">
    <div class="row">
        <div class="col-xl-4 col-12 mb-4">
            <div class="card">
                <div class="card-header bg-success">
                    <div class="card-title text-white fw-semibold">
                        <?= $editando ? 'Editar Secção' : 'Adicionar Secção' ?>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <input type="hidden" name="id_seccao" value="<?= $secao_editar['id_seccao'] ?>">
                        
                        <div class="row">
                            <div class="col-12 mb-4">
                                <label class="mb-1">Nome Secção</label>
                                <select class="form-control" name="nome_seccao" required>
                                    <option value="">Selecione uma secção</option>
                                    <?php foreach ($seccoes as $sec): ?>
                                        <option value="<?= htmlspecialchars($sec['nome_seccao']) ?>" <?= ($sec['nome_seccao'] == $secao_editar['nome_seccao']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($sec['nome_seccao']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 mb-4">
                                <label class="mb-1">Trabalhador Responsável</label>
                                <select class="form-control" name="nome_trabalhador" required>
                                    <option value="">Selecione um trabalhador</option>
                                    <?php foreach ($trabalhadores as $trab): ?>
                                        <option value="<?= htmlspecialchars($trab['nome_trabalhador']) ?>" <?= ($trab['nome_trabalhador'] == $secao_editar['nome_trabalhador']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($trab['nome_trabalhador']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="card-footer bg-white d-flex align-items-center justify-content-end">
                            <?php if ($editando): ?>
                                <button type="submit" class="btn btn-success" name="editar">Editar</button>
                                <a href="seccoes.php" class="btn btn-secondary ms-2">Cancelar</a>
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
                        <th>Nome Secção</th>
                        <th>Nome Trabalhador</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($seccao as $s): ?>
                        <tr>
                            <td><?= htmlspecialchars($s['nome_seccao']) ?></td>
                            <td><?= htmlspecialchars($s['nome_trabalhador']) ?></td> 
                            <td>
                                <a href="seccoes.php?editar=<?= $s['id_seccao'] ?>" class="btn btn-sm btn-light border">
                                    Editar
                                </a>
                                <a href="seccoes.php?remover=<?= $s['id_seccao'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja remover esta seção?');">
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
