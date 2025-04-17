<?php

// Exibir erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'layout/header.php'; 

// Verificar conexão com o banco de dados
if (!$conn) {
    die("Erro ao conectar ao banco de dados.");
}

// Buscar fornecedores com produto associado
$stmt = $conn->query("SELECT fornecedor.*, produtos.nome_produto FROM fornecedor LEFT JOIN produtos ON fornecedor.id_produto = produtos.id_produto");
$fornecedores = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Buscar lista de produtos para o dropdown
$produtos_stmt = $conn->query("SELECT id_produto, nome_produto FROM produtos");
$produtos = $produtos_stmt->fetchAll(PDO::FETCH_ASSOC);

// Inicializar variáveis de edição
$edit_id = null;
$edit_nome = '';
$edit_produto = '';
$edit_local = '';

// Inserir Fornecedor
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['inserir'])) {
    $nome = $_POST['nome_fornecedor'];
    $local = $_POST['local_fornecedor'];
    $produto_id = !empty($_POST['novo_produto']) ? null : $_POST['id_produto'];

    if (!empty($_POST['novo_produto'])) {
        $novo_produto = trim($_POST['novo_produto']);
        $stmt = $conn->prepare("INSERT INTO produtos (nome_produto) VALUES (?)");
        if ($stmt->execute([$novo_produto])) {
            $produto_id = $conn->lastInsertId();
        }
    }

    $stmt = $conn->prepare("INSERT INTO fornecedor (nome_fornecedor, id_produto, local_fornecedor) VALUES (?, ?, ?)");
    if ($stmt->execute([$nome, $produto_id, $local])) {
        header("Location: fornecedor.php");
        exit;
    } else {
        echo "Erro ao inserir fornecedor.";
    }
}

// Editar Fornecedor
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar'])) {
    $edit_id = $_POST['id_fornecedor'];
    $edit_nome = $_POST['nome_fornecedor'];
    $edit_local = $_POST['local_fornecedor'];
    $edit_produto_id = !empty($_POST['novo_produto']) ? null : $_POST['id_produto'];

    if (!empty($_POST['novo_produto'])) {
        $novo_produto = trim($_POST['novo_produto']);
        $stmt = $conn->prepare("INSERT INTO produtos (nome_produto) VALUES (?)");
        if ($stmt->execute([$novo_produto])) {
            $edit_produto_id = $conn->lastInsertId();
        }
    }

    $stmt = $conn->prepare("UPDATE fornecedor SET nome_fornecedor = ?, id_produto = ?, local_fornecedor = ? WHERE id_fornecedor = ?");
    if ($stmt->execute([$edit_nome, $edit_produto_id, $edit_local, $edit_id])) {
        header("Location: fornecedor.php");
        exit;
    } else {
        echo "Erro ao editar fornecedor.";
    }
}

// Buscar fornecedor para edição
if (isset($_GET['editar'])) {
    $edit_id = $_GET['editar'];
    $stmt = $conn->prepare("SELECT * FROM fornecedor WHERE id_fornecedor = ?");
    if ($stmt->execute([$edit_id])) {
        $fornecedor_editar = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($fornecedor_editar) {
            $edit_nome = $fornecedor_editar['nome_fornecedor'];
            $edit_produto = $fornecedor_editar['id_produto'];
            $edit_local = $fornecedor_editar['local_fornecedor'];
        } else {
            echo "Fornecedor não encontrado.";
        }
    } else {
        echo "Erro ao consultar fornecedor para edição.";
    }
}

// REMOVER Linha Tabela Fornecedores
if (isset($_GET['remover'])) {
    $id = $_GET['remover'];
    $stmt = $conn->prepare("DELETE FROM fornecedor WHERE id_fornecedor = ?");
    $stmt->execute([$id]);
    
    header("Location: fornecedor.php");
    exit;
}
?>

<div class="container-fluid p-4">
    <div class="row">
        <div class="col-xl-4 col-12 mb-4">
            <div class="card">
                <div class="card-header bg-success">
                    <div class="card-title text-white fw-semibold">
                        <?= $edit_id ? 'Editar Fornecedor' : 'Adicionar Fornecedor' ?>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <input type="hidden" name="id_fornecedor" value="<?= $edit_id ?>">

                        <div class="mb-4">
                            <label class="mb-1">Nome do Fornecedor</label>
                            <input type="text" name="nome_fornecedor" class="form-control" value="<?= htmlspecialchars($edit_nome) ?>" required>
                        </div>
                        <div class="mb-4">
                            <label class="mb-1">Produto</label>
                            <select name="id_produto" class="form-control">
                                <option value="">Selecione um produto</option>
                                <?php foreach ($produtos as $p): ?>
                                    <option value="<?= $p['id_produto'] ?>" <?= ($p['id_produto'] == $edit_produto) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($p['nome_produto']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <input type="text" name="novo_produto" class="form-control mt-2" placeholder="Ou adicione um novo produto">
                        </div>
                        <div class="mb-4">
                            <label class="mb-1">Local do Fornecedor</label>
                            <input type="text" name="local_fornecedor" class="form-control" value="<?= htmlspecialchars($edit_local) ?>" required>
                        </div>
                        <div class="card-footer bg-white d-flex align-items-center justify-content-end">
                            <?php if ($edit_id): ?>
                                <button type="submit" class="btn btn-success" name="editar">Editar</button>
                                <a href="fornecedor.php" class="btn btn-secondary ms-2">Cancelar</a>
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
                        <th>Nome do Fornecedor</th>
                        <th>Produto</th>
                        <th>Local</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($fornecedores as $f): ?>
                        <tr>
                            <td><?= htmlspecialchars($f['nome_fornecedor']) ?></td>
                            <td><?= htmlspecialchars($f['nome_produto'] ?? 'Não especificado') ?></td>
                            <td><?= htmlspecialchars($f['local_fornecedor']) ?></td>
                            <td>
                                <a href="?editar=<?= $f['id_fornecedor'] ?>" class="btn btn-sm btn-light border">Editar</a>
                                <a href="?remover=<?= $f['id_fornecedor'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?');">Remover</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'layout/footer.php'; ?>
