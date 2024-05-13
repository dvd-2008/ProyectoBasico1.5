<?php
session_start(); 

include 'conexion.php'; 

$usuario = $_POST['usuario'] ?? '';
$contrasena = $_POST['contrasena'] ?? '';
$email = $_POST['email'] ?? '';

if (isset($_POST['registrar'])) {
  
  $query = "INSERT INTO usuarios (nombre_usuario, contrasena) VALUES ('$usuario', '$contrasena')";
  $resultado = $pdo->query($query);

  header('Location: login.php');
  exit;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro de Usuario</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #343a40;
    }
  </style>
</head>
<body>
    
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow">
          <div class="card-body">
            <h2 class="card-title text-center">Registro de Usuario</h2>

            <form method="post">
              <div class="form-group">
                <label for="usuario"><i class="fas fa-user"></i> Usuario:</label>
                <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingrese su nombre de usuario" required>
              </div>

              <div class="form-group">
                <label for="contrasena"><i class="fas fa-lock"></i> Contraseña:</label>
                <div class="input-group">
                <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Ingrese su contraseña" required>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary reveal-password" type="button">
                      <i class="fas fa-eye"></i>
                    </button>
                </div>
                </div>
              </div>

              <button type="submit" class="btn btn-primary btn-block btn-sm" name="registrar">Registrarse</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.reveal-password').click(function() {
        var passwordInput = $('#contrasena');
        if (passwordInput.attr('type') === 'password') {
          passwordInput.attr('type', 'text');
          $(this).find('i').removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
          passwordInput.attr('type', 'password');
          $(this).find('i').removeClass('fa-eye-slash').addClass('fa-eye');
        }
      });
    });
  </script>
</body>
</html>

