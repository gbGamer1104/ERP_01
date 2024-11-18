<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    include 'config.php';

    $item = null;
    $funcionarios = [];

    if(isset($_GET['id'])){
        $id = intval($_GET['id']);
        $query = "SELECT * FROM manutencoes WHERE manutencao_id = $id";
        $result = $conn->query($query);

        if($result){
            $item = $result->fetch_assoc();
        } else{
            echo "Erro ao buscar item: " . $conn->error;
        }
    }

    $funcQuery = "SELECT funcionario_id, nome FROM funcionarios";
    $funcResult = $conn->query($funcQuery);

    if ($funcResult) {
        while ($funcRow = $funcResult->fetch_assoc()) {
            $funcionarios[] = $funcRow;
        }
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id = intval($_POST['id']);
        $nome_equip = $conn->real_escape_string($_POST['nome_equip']);
        $descricao = $conn->real_escape_string($_POST['descricao']);
        $data_inicio = $conn->real_escape_string($_POST['data_inicio']);
        $data_termino = $conn->real_escape_string($_POST['data_termino']);
        $id_funcionario = intval($_POST['id_func']);

        $status = $conn->real_escape_string($_POST['status']);
        $statusPermitidos = ['quebrado', 'funcional'];

        if(!in_array($status, $statusPermitidos)){
            echo "Erro: Status Inválido.";
            exit();
        }

        $query_nome = $conn->query("SELECT * FROM funcionarios WHERE funcionario_id = $id_funcionario");
        $nome_row = $query_nome->fetch_assoc();
        $nome_func = $nome_row['nome'];
        
        $updateQuery = "UPDATE manutencoes SET equipamento='$nome_equip', descricao_problema='$descricao', data_inicio='$data_inicio', data_termino='$data_termino', tecnico_responsavel='$nome_func', status='$status', responsavel_id='$id_funcionario' WHERE manutencao_id=$id";

        if($conn->query($updateQuery)){
            header('Location: index.php');
            exit();
        } else{
            echo "Erro ao atualizar item: " . $conn->error;
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!--NÃO ALTERAR-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="src/css/styles.css">
</head>

<body>
    <!--NÃO ALTERAR-->
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-purple sidebar">
                <div class="logo">
                    <i class="bi bi-0-circle-fill"></i>
                    <h2>HORIZON+</h2>
                </div>
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <i class="bi bi-1-circle-fill"></i>
                                <i class="bi bi-phone-fill icon-large"></i>
                                <span>Produtos</span>
                                <i id="indicator" class="bi bi-caret-left-fill indicator"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-basket2-fill icon-large"></i>
                                <span>Pedidos</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-people-fill icon-large"></i>
                                <span>Fornecedores</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-person-badge-fill icon-large"></i>
                                <span>Funcionários</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-box-fill icon-large"></i>
                                <span>Estoque</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-pc-display-horizontal icon-large"></i>
                                <span>Equipamentos</span>
                            </a>
                        </li>
                    </ul>
                    <div class="user">
                        <div class="nav-item">
                            <div class="d-flex align-items-center card-user">
                                <i class="bi bi-person-circle users"></i>
                                <div class="ml-2">
                                    <div>Funcionário</div>
                                    <div class="text-muted" style="font-size: 0.8em;">Função xyz</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <!--NÃO ALTERAR-->

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                    <div class="container">
                        <div class="row">
                                <div class="col-12">
                                    <h1>Editar Item</h1>
                                    <form method="POST" action="editar.php">
                                        <input type="hidden" name="id" value="<?php echo isset($item['manutencao_id']) ? $item['manutencao_id'] : ''; ?>">

                                        <div class="mb-3">
                                            <label class="form-label">Equipamento:</label>
                                            <textarea class="form-control" name="nome_equip" required><?php echo isset($item['equipamento']) ? htmlspecialchars($item['equipamento']) : ''; ?></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Descrição do Problema:</label>
                                            <input type="text" class="form-control" name="descricao" value="<?php echo isset($item['descricao_problema']) ? htmlspecialchars($item['descricao_problema']) : ''; ?>" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Data de Inicio:</label>
                                            <input type="datetime-local" class="form-control" name="data_inicio" value="<?php echo isset($item['data_inicio']) ? htmlspecialchars($item['data_inicio']) : ''; ?>" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Data de Termino:</label>
                                            <input type="datetime-local" class="form-control" name="data_termino" value="<?php echo isset($item['data_termino']) ? htmlspecialchars($item['data_termino']) : ''; ?>" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Tecnico Responsável:</label>
                                            <select class="form-select" aria-label="Default select example" name="id_func" required>
                                            <?php foreach ($funcionarios as $funcionario): ?>
                                                <option value="<?php echo $funcionario['funcionario_id']; ?>" <?php echo (isset($item['responsavel_id']) && $item['responsavel_id'] == $funcionario['funcionario_id']) ? 'selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($funcionario['nome']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Status:</label>
                                            <select class="form-control" name="status" required>
                                                <option value="quebrado" <?php echo (isset($item['status']) && $item['status'] === 'quebrado') ? 'selected' : ''; ?>>Quebrado</option>
                                                <option value="funcional" <?php echo (isset($item['status']) && $item['status'] === 'funcional') ? 'selected' : ''; ?>>Funcionando</option>
                                            </select>
                                        </div>



                                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!--NÃO ALTERAR-->

                <!--NÃO ALTERAR-->
            </main>
        </div>
    </div>
    <!--NÃO ALTERAR-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
    <script src="src/js/script.js"></script>
    <!--NÃO ALTERAR-->
</body>

</html>