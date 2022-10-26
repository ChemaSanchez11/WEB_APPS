<?php include('server.php');

if (empty($_SESSION['infouser'])){
    $_SESSION['infouser'] = 'placeholder="Usuario"';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/login.css" />
</head>

<body translate="no" >
  <form autocomplete='off' class='form' method="post" action="login.php">
    <div class='control'>
        <?php include('errors.php'); ?>
      <h1>
      Iniciar | Registrar
      </h1>
    </div>
    <div class='control block-cube block-input'>
      <input name='username' <?php echo $_SESSION['infouser']?> type='text'>
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
    <div class='control block-cube block-input'>
      <input name='password' placeholder='Password' type='password'>
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
    <button href="" class='btn block-cube block-cube-hover' type="submit" name="login_user">
      <div class='bg-top'>
        <div class='bg-inner'></div>
      </div>
      <div class='bg-right'>
        <div class='bg-inner'></div>
      </div>
      <div class='bg'>
        <div class='bg-inner'></div>
      </div>
      <div class='text'>
        Consultar
      </div>
    </button>
  </form>
  <div class='credits'>
    <p href='#' target='_blank'>
      <a href="#" class="forgot">Olvide mi contraseña</a> o <a href="#" class="elegir">Registrarse</a>
    </p>
  </div>
  <div class="atras"><p> 
    <a class="perfil" href="start.php">
      <span>Volver Atras</span>
    </a> 

  </div>
</body>
</html>

  
  