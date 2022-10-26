
<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/login.css" />
</head>

<body translate="no">

<form class='form' method="post" action="start.php">
    <div class='control'>
        <?php include('errors.php'); ?>
      <h1>
        Iniciar | Registrar
      </h1>
    </div>
    <div class='control block-cube block-input'>
      <input name='username' placeholder='user | email' type='text'>
      <div class='bg-top'>
        <div class='bg-inner'></div>
      </div>
      <div class='bg-right'>
        <div class='bg-inner'></div>
      </div>
      <div class='bg'>
        <div class='bg-inner'></div>
      </div>
    </div>
    <button href="" class='btn block-cube block-cube-hover' type="submit" name="start_user">
      <div class='bg-top'>
        <div class='bg-inner'></div>
      </div>
      <div class='bg-right'>
        <div class='bg-inner'></div>
      </div>
      <div class='bg'>
        <div class='bg-inner'></div>
      </div>
      <div class='text'>Enviar
      </div>
    </button>
  </form>

  <div class='credits'>
    <p href='#' target='_blank'>
      Obtener <a href="register.php" class="elegir">Registro</a> o <a href="login.php" class="elegir">Inicio de sesion</a>
  </p>
  </div>
</body>

</html>