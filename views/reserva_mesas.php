<!DOCTYPE html>
<html>
<head>
  <title>Reserva de Mesas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <h1 class="mt-4">Reserva de Mesas</h1>
    
    <form action="" method="POST">
      <div class="mb-3">
        <label for="numero_mesa" class="form-label">Número da Mesa</label>
        <input type="number" class="form-control" id="numero_mesa" name="numero_mesa" required>
      </div>
      <div class="mb-3">
        <label for="nome_cliente" class="form-label">Nome do Cliente</label>
        <input type="text" class="form-control" id="nome_cliente" name="nome_cliente" required>
      </div>
      <div class="mb-3">
        <label for="data_reserva" class="form-label">Data da Reserva</label>
        <input type="date" class="form-control" id="data_reserva" name="data_reserva" required>
      </div>
      <div class="mb-3">
        <label for="hora_reserva" class="form-label">Hora da Reserva</label>
        <input type="time" class="form-control" id="hora_reserva" name="hora_reserva" required>
      </div>
      <div class="text-center">
        <button type="submit" class="btn btn-primary">Reservar</button>
      </div>
    </form>
    
    <table class="table table-striped mt-4">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Número da Mesa</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($mesas as $mesa) : ?>
        <tr>
          <th scope="row"><?php echo $mesa['id']; ?></th>
          <td><?php echo $mesa['numero_mesa']; ?></td>
          <td><?php echo $mesa['status']; ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>