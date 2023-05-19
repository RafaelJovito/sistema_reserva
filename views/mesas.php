<?php
require_once '../config/conexao.php';

// Estabelece a conexão com o banco de dados
$conexao = conectar();

// Consulta SQL para obter as mesas disponíveis
$sql = "SELECT * FROM mesas WHERE status = 'disponivel'";
$resultado = mysqli_query($conexao, $sql);

// Verifica se ocorreu algum erro na consulta
if (!$resultado) {
    die("Erro na consulta: " . mysqli_error($conexao));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reserva de Mesas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Reserva de Mesas</h1>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Número da Mesa</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($mesa = mysqli_fetch_assoc($resultado)) : ?>
                    <tr>
                        <th scope="row"><?php echo $mesa['id']; ?></th>
                        <td><?php echo $mesa['numero']; ?></td>
                        <td><?php echo $mesa['status']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>