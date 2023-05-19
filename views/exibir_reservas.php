<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Exibir Reservas</title>
</head>
<body>
    <h1>Reservas</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Data</th>
                <th>Hora</th>
                <th>Nome</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservas as $reserva): ?>
                <tr>
                    <td><?php echo $reserva['id']; ?></td>
                    <td><?php echo $reserva['data']; ?></td>
                    <td><?php echo $reserva['hora']; ?></td>
                    <td><?php echo $reserva['nome']; ?></td>
                    <td><?php echo $reserva['status']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>