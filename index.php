<?php

include 'config.php';

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
                            <div class="col btn-create">
                                <a href="create_page.php" class="btn btn-primary btn-create">Criar Ticket</a>
                            </div>
                        </div>
                        <div class="row">
                                <?php
                                    $result = $conn->query("SELECT * FROM manutencoes");
                                    while($row = $result->fetch_assoc()){
                                        echo "<div class='col-3'>";
                                        echo "<div class='card'>";
                                        echo "<div class='card-body'>";
                                        echo "<h5 class='card-title'>{$row['equipamento']}</h5>";
                                        echo "<p class='card-text'>{$row['descricao_problema']}</p>";
                                        echo "<h6 class='card-subtitle mb-2 text-body-secondary'>Data Inicio: {$row['data_inicio']}</h6>";
                                        echo "<h6 class='card-subtitle mb-2 text-body-secondary'>Data Termino: {$row['data_termino']}</h6>";
                                        echo "<h6 class='card-subtitle mb-2 text-body-secondary'>Técnico Responsável: {$row['tecnico_responsavel']}</h6>";
                                        echo "<h6 class='card-subtitle mb-2 text-body-secondary'>Status: {$row['status']}</h6>";
                                        echo "<a href='editar.php?id={$row['manutencao_id']}' class='btn btn-primary btn-sm'>Editar</a>";
                                        echo "<a href='deletar.php?id={$row['manutencao_id']}' class='btn btn-danger btn-sm' onclick=''return confirm(\"Tem certeza que deseja excluir este item?\")>Excluir</a>";
                                        echo "</div>";
                                        echo "</div>";
                                        echo "</div>";
                                    }
                                ?>
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