<?php
include('server.php');
require_once __DIR__ . '/lib/config.php';

global $CFG, $USER, $DB;

$token = $_SESSION['token'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <!-- Autorizacion   -->
    <?php
    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: start.php');
    } else echo "<meta authorization='$token'>";
    ?>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Title</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="lib.js"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Gugi|Bungee">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
</head>
<body>

<nav class="nav text-center my-2">
    <div id="pswd" class="col-1 position-absolute w-5" style="width: 10px; height: 10px;"></div>
    <div class="mx-auto">
        <h1>Contraseñas <span class="titulos">Guardadas</span></h1>
    </div>
</nav>

<div class="redes row col-12 p-0 m-0 text-center">

    <?php
    $result = $DB->get_records("SELECT u.id,p.name as platform, p.img, c.name as category, c.color as category_color FROM users u INNER JOIN users_platforms up ON up.userid = u.id INNER JOIN platforms p ON p.id = up.platformid INNER JOIN categories c ON c.id = p.categoryid WHERE u.id = 3 ORDER BY c.id");
    $category = '';
    foreach ($result as $info) {
        if ($category !== $info->category) {
            $category = $info->category;
            echo "<h1 class='col-12 $info->category_color'>$category</h1>";
        }
        echo "<div id='" . strtolower($info->platform) . "' class='col-md-3 col-sm-12 my-2 text-secondary btn-action'>
                     <img height='80px' src='$CFG->path$info->img'>
                     <h3 class='mt-2'>$info->platform</h3>
                  </div>";
    }
    ?>
</div>
<br>
<div class="col-12 mt-4">
    <div class="container">
        <ul>
            <li><a href="#" id='add_platform'><i class="fas fa-plus" aria-hidden="true"></i></a></li>
            <li><a href="#"><i class="fas fa-trash-alt" aria-hidden="true"></i></a></li>
            <li><a href="#"><i class="fas fa-sign-out-alt" aria-hidden="true"></i></a></li>
        </ul>
    </div>
</div>

<!-- you missed this line of code -->
<a href="#" class="close" data-dismiss="alert" aria-label="close"></a>


<div id="modal" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Añadir Plataforma</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form_platform">
                <div id="modal-body" class="modal-body row">
                    <div class="form-group col-12">
                        <label for="platforms">Plataformas</label>
                        <select class="form-control mt-2" name="platform" id="platforms">
                            <?php
                            $platforms = $DB->get_records('SELECT id, name FROM platforms WHERE id NOT IN(SELECT platformid FROM users_platforms)');
                            foreach ($platforms as $platform) {
                                echo "<option value='$platform->id'>$platform->name</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group mt-2 col-12">
                        <label for="password">Contraseña</label>
                        <input class="form-control" id="password" name="password" type="password">
                        <input class="form-control" id="user" name="user" type="hidden" value="<?php echo $USER->id ?>">
                    </div>
                </div>
                <div class="modal-footer justify-content-start row justify-content-around">
                    <div class="col-6 p-1">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Nueva Plataforma</button>
                    </div>
                    <div class="text-end col-5 p-1">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="modal_show" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="background: #363535;">
            <div class="modal-header" style="border-bottom: 1px solid #09CC96FF">
                <h5 class="modal-title mx-auto" id="show-title"></h5>
            </div>
            <div class="modal-body" style="border-bottom: 1px solid #09CC96FF">
                <div id="show-content" class="text-light mt-2">

                </div>
            </div>
            <div class="modal-footer justify-content-start row justify-content-around" style="border-top: none !important;">
<!--                <button type="submit" data-bs-dismiss="modal" class="btn btn-success">Cerrar</button>-->
                <div id="close_edit" class="col-6 p-1">
                    <button type="button" class="btn btn-warning" id="edit-pass">Editar</button>
                </div>
                <div class="text-end col-5 p-1" id="save_edit">
                    <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Cerrar</button>
                </div>
                <input class="form-control" id="user_edit" name="user" type="hidden" value="<?php echo $USER->id ?>">
            </div>
        </div>
    </div>
</div>

</body>
</html>

