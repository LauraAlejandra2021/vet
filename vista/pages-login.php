<?php
session_start();

require_once '../assets/db/config.php';

if (isset($_POST['login'])) {

    $errMsg = '';

    // Get data from FORM
    $usuario = $_POST['usuario'];
    $contra = hash('sha256', $_POST['contra']);

    if ($usuario == '') {
        $errMsg = 'Digite su usuario';
    }
    if ($contra == '') {
        $errMsg = 'Digite su contraseña';
    }

    if ($errMsg == '') {
      $db = new Database();
        $mysqli = $db->getMysqli(); // Obtén la conexión mysqli desde common.php
        if ($mysqli) {
            try {
                $query = 'SELECT id, nombre, usuario, correo, cargo FROM usuarios WHERE usuario = ? and contra = ?';
                $stmt = $mysqli->prepare($query);
                $stmt->bind_param('ss', $usuario, $contra);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_assoc();

                if (!$data) {
                    $errMsg = "los datos estan incorrectos";
                } else {
                        $_SESSION['id'] = $data['id'];
                        $_SESSION['nombre'] = $data['nombre'];
                        $_SESSION['usuario'] = $data['usuario'];
                        $_SESSION['correo'] = $data['correo'];
                        $_SESSION['cargo'] = $data['cargo'];

                        if ($_SESSION['cargo'] == 1) {
                            header('Location: panel-admin/administrador');
                        }
                        if ($_SESSION['cargo'] == 2) {
                            header('Location: panel-admin/administrador');
                        }
                        if ($_SESSION['cargo'] == 3) {
                            header('Location: panel-admin/administrador');
                        }
                        // Otros casos de redirección
                        exit;
                    
                }
            } catch (Exception $e) {
                $errMsg = $e->getMessage();
            } finally {
                $stmt->close();
                $mysqli->close();
            }
        } else {
            $errMsg = 'Error de conexión a la base de datos.';
        }
    }
}
?>


<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login | Vetdog - Vetdog Admin Template</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../assets/css/tailwind.output.css" />
  <link rel="shortcut icon" type="image/x-icon" href="../assets/img/lll.png" />
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <script src="../assets/js/init-alpine.js"></script>
</head>

<body>
  <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
    <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
      <div class="flex flex-col overflow-y-auto md:flex-row">
        <div class="h-32 md:h-auto md:w-1/2">
          <img aria-hidden="true" class="object-cover w-full h-full dark:hidden" src="../assets/img/lll.png" alt="Office" />
          <img aria-hidden="true" class="hidden object-cover w-full h-full dark:block" src="../assets/img/lll.png" alt="Office" />
        </div>
        <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
          <div class="w-full">
            <form class="container" autocomplete="off" method="POST" role="form">
              <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">
                Iniciar Sesion
              </h1>
              <?php
              if (isset($errMsg)) {
                echo '<div style="color:#FF0000;text-align:center;font-size:20px;">' . $errMsg . '</div>';
              }
              ?>
              <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Usuario</span>
                <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Jane Doe" name="usuario" value="<?php if (isset($_POST['usuario'])) echo $_POST['usuario'] ?>" autocomplete="off" />
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Contraseña</span>
                <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="***************" type="password" required="true" name="contra" value="<?php if (isset($_POST['contra'])) echo MD5($_POST['contra']) ?>" />
              </label>
              <hr class="my-8" />
              <button class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray" name='login' type="submit">Acceder</button>
            </form>
            <div id="msg_error" class="alert alert-danger" role="alert" style="display: none"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>