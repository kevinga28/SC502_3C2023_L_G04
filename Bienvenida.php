<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Evolve - Bienvenida</title>

  <!-- Bootstrap core CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

  <!-- Estilos personalizados para el salón de belleza -->
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f9f9f9;
      /* Cambiar el fondo según el estilo del salón */
    }

    .welcome-container {
      text-align: center;
      padding-top: 100px;
    }

    h1 {
      font-size: 3rem;
      color: #333;
    }

    .btn-group {
      margin-top: 30px;
    }

    .btn {
      font-size: 1.2rem;
      margin: 0 10px;
    }

    .logo img {
      max-width: 200px;
      height: auto;
    }
  </style>
</head>

<body>

  <div class="container">
    <div class="row welcome-container">
      <div class="col-12">
        <div class="logo">
          <img src="Admin/Views/dist/img/logo.png" alt="Evolve Logo">
        </div>
        <h1>Bienvenido a Evolve</h1>
        <p>Elige tu modo:</p>
        <div class="btn-group">
          <a href="Cliente/views/index.php" class="btn btn-primary">Modo Cliente</a>
          <a href="Admin/Views/index.php" class="btn btn-secondary">Modo Admin</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>