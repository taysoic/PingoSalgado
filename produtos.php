<?php include 'layout/header.php'; 
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->query("SELECT * FROM produtos");
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Inicializar variáveis de edição
    $edit_id = null;
    $edit_nome = '';
    $edit_preco = '';
    $edit_marca = '';
    $edit_validade = '';

    // Inserir Produto
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['inserir'])) {
        $nome = $_POST['nome_produto'];
        $preco = $_POST['preco'];
        $marca = $_POST['marca'];
        $validade = $_POST['data_validade'];

        $stmt = $conn->prepare("INSERT INTO produtos (nome_produto, preco, marca, data_validade) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$nome, $preco, $marca, $validade])) {
            header("Location: produtos.php");
            exit;
        } else {
            echo "Erro ao inserir produto.";
        }
    }

    // Editar Produto
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar'])) {
        $edit_id = $_POST['id_produto'];
        $edit_nome = $_POST['nome_produto'];
        $edit_preco = $_POST['preco'];
        $edit_marca = $_POST['marca'];
        $edit_validade = $_POST['data_validade'];

        $stmt = $conn->prepare("UPDATE produtos SET nome_produto = ?, preco = ?, marca = ?, data_validade = ? WHERE id_produto = ?");
        if ($stmt->execute([$edit_nome, $edit_preco, $edit_marca, $edit_validade, $edit_id])) {
            header("Location: produtos.php");
            exit;
        } else {
            echo "Erro ao editar produto.";
        }
    }

    // Buscar Produto para Edição
    if (isset($_GET['editar'])) {
        $edit_id = (int) $_GET['editar'];
        $stmt = $conn->prepare("SELECT * FROM produtos WHERE id_produto = ?");
        if ($stmt->execute([$edit_id])) {
            $produto_editar = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($produto_editar) {
                $edit_nome = $produto_editar['nome_produto'];
                $edit_preco = $produto_editar['preco'];
                $edit_marca = $produto_editar['marca'];
                $edit_validade = $produto_editar['data_validade'];
            } else {
                echo "Produto não encontrado.";
            }
        } else {
            echo "Erro ao consultar produto para edição.";
        }
    }

    // Remover Produto
    if (isset($_GET['remover'])) {
        $id = (int) $_GET['remover']; 
        $stmt = $conn->prepare("DELETE FROM produtos WHERE id_produto = ?");
        if ($stmt->execute([$id])) {
            header("Location: produtos.php");
            exit;
        } else {
            echo "Erro ao remover produto.";
        }
    }
?>

<div class="container-fluid p-4">
    <div class="row">
        <div class="col-xl-4 col-12 mb-4">
            <div class="card">
                <div class="card-header bg-success">
                    <div class="card-title text-white fw-semibold">
                        <?= $edit_id ? 'Editar Produto' : 'Adicionar Produto' ?>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <input type="hidden" name="id_produto" value="<?= $edit_id ?>">
                        <div class="row">
                            <div class="col-12 mb-4">
                                <label class="mb-1">Nome</label>
                                <input type="text" class="form-control" name="nome_produto" value="<?= htmlspecialchars($edit_nome) ?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4 mb-4">
                                <label class="mb-1">Preço</label>
                                <input type="number" step="0.01" class="form-control" name="preco" value="<?= htmlspecialchars($edit_preco) ?>" required>
                            </div>
                            <div class="col-4 mb-4">
                                <label class="mb-1">Marca</label>
                                <input type="text" class="form-control" name="marca" value="<?= htmlspecialchars($edit_marca) ?>" required>
                            </div>
                            <div class="col-4 mb-4">
                                <label class="mb-1">Validade</label>
                                <input type="date" class="form-control" name="data_validade" value="<?= htmlspecialchars($edit_validade) ?>" required>
                            </div>
                        </div>
                        <div class="card-footer bg-white d-flex align-items-center justify-content-end">
                            <?php if ($edit_id): ?>
                                <button type="submit" class="btn btn-success" name="editar">
                                    Editar
                                </button>
                                <a href="produtos.php" class="btn btn-secondary ms-2">
                                    Cancelar
                                </a>
                            <?php else: ?>
                                <button type="submit" class="btn btn-success" name="inserir">
                                    Adicionar
                                </button>
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
                        <th>Preço</th>
                        <th>Marca</th>
                        <th>Data de Validade</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produtos as $p): ?>
                        <tr>
                            <td><?= htmlspecialchars($p['nome_produto']) ?></td>
                            <td>€ <?= number_format($p['preco'], 2, ',', '.') ?></td>
                            <td><?= htmlspecialchars($p['marca']) ?></td>
                            <td><?= date('d/m/Y', strtotime($p['data_validade'])) ?></td>
                            <td>
                                <a href="?editar=<?= $p['id_produto'] ?>" class="btn btn-sm btn-light border">
                                    Editar
                                </a>
                                <a href="?remover=<?= $p['id_produto'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja remover este produto?');">
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


