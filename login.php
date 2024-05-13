<?php
session_start(); // Iniciar sesión

include 'conexion.php'; 

// Variables para almacenar los datos del formulario
$usuario = $_POST['usuario'] ?? '';
$contrasena = $_POST['contrasena'] ?? '';

// Validar si se ha enviado el formulario de inicio de sesión
if (isset($_POST['iniciarSesion'])) {
  // Consultar en la base de datos el usuario con el nombre de usuario y contraseña proporcionados
  $query = "SELECT * FROM usuarios WHERE nombre_usuario = :usuario AND contrasena = :contrasena";
  $statement = $pdo->prepare($query);
  $statement->bindParam(':usuario', $usuario);
  $statement->bindParam(':contrasena', $contrasena);
  $statement->execute();

  // Obtener el usuario de la consulta
  $usuarioEncontrado = $statement->fetch(PDO::FETCH_ASSOC);

  // Verificar si se encontró el usuario
  if ($usuarioEncontrado) {
    // Almacenar la información del usuario en la sesión
    $_SESSION['usuario'] = $usuarioEncontrado;

    // Redirigir a la página de usuarios
    header('Location: index.php');
    exit;
  } else {
    // Mostrar mensaje de error si no se encontró el usuario
    $mensajeError = "No se encontró usuario, inicie sesión nuevamente.";
  }
}

// Validar si se ha enviado el formulario de registro
if (isset($_POST['registrar'])) {
  // Redirigir al archivo de registro
  header('Location: registrar.php');
  exit;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio de sesión</title>
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
            <h2 class="text-center mb-4">Iniciar sesión</h2>
            <?php if (isset($mensajeError)): ?>
              <div class="alert alert-danger" role="alert">
                <?php echo $mensajeError; ?>
              </div>
            <?php endif; ?>
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
              <button type="submit" class="btn btn-primary btn-block btn-sm" name="iniciarSesion"  id="sign-in">Iniciar sesión</button>
            </form>
            <hr>
            <form method="post">
              <button type="submit" class="btn btn-secondary btn-block btn-sm" name="registrar">Registrarse</button>
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
