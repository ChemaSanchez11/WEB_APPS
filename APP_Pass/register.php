<?php include('server.php');

if (empty($_SESSION['infouser'])) {
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
    <link rel="stylesheet" href="css/login.css"/>
</head>

<body translate="no">
<form autocomplete='off' class='form' method="post" action="register.php">
    <div class='control'>
        <h1>
            Iniciar | Registrar
        </h1>
    </div>
    <div class='control block-cube block-input'>
        <input name='username'
            <?php
                if(!strpos($_SESSION['infouser'], '@')){
                    echo $_SESSION['infouser'];
                }else echo "placeholder='Usuario'";
            ?> type='text'>
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
        <input name='email'
            <?php

            if(strpos($_SESSION['infouser'], '@') !== false){
                echo $_SESSION['infouser'];
            }
            else echo "placeholder='Correo Electronico'";
            ?> type='email'>
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
        <input name='password_1' placeholder='Contraseña' type='password'>
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
        <input name='password_2' placeholder='Confirma Contraseña' type='password'>
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
    <button href="" class='btn block-cube block-cube-hover' type="submit" name="reg_user">
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
        <a href="login.php" class="elegir">Iniciar Sesion</a>
    </p>
</div>
<div class="atras"><p>
        <a class="perfil" href="start.php">
            <span>Volver Atras</span>
        </a>

</div>
</body>
</html>

  
  