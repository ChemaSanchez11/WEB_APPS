<?php
session_start();

$username = "";
$email = "";

$errors = array(); 

$db = mysqli_connect('localhost', 'root', '', 'app_pass');

if (!$db){
    die("Connection failed!" . mysqli_connect_error());
}

// START

if (isset($_POST['start_user'])) {
  
  $username = mysqli_real_escape_string($db, $_POST['username']);
  if (empty($username)) {
      array_push($errors, "Username is required");
      
  }
  
  if (count($errors) == 0) {
      $query = "SELECT * FROM users WHERE username='$username' OR email='$username'";
      
      $results = mysqli_query($db, $query);
      
      if (mysqli_num_rows($results) == 1) {
        $datos = $results->fetch_assoc();

        var_dump($datos);

        $_SESSION['infouser'] = 'value="'.$username.'"';
        $_SESSION['success'] = "Inicio correcto";
        header('location: login.php');
      }else {
        $_SESSION['infouser'] = 'value="'.$username.'"';
        header('location: register.php');
      }
  }
}


// REGISTER USER
if (isset($_POST['reg_user'])) {
    // receive all input values from the form
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  
    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password_1)) { array_push($errors, "Password is required"); }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }
  
    // first check the database to make sure 
    // a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    
    if ($user) { // if user exists
      if ($user['username'] === $username) {
        array_push($errors, "Username already exists");
      }
  
      if ($user['email'] === $email) {
        array_push($errors, "email already exists");
      }
    }
  
    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
        $password = md5($password_1);//encrypt the password before saving in the database
        $date = date('d-m-y H:i:s');
        $token = "{MD5}".md5($username)."_#_".md5($password_1);

        $query = "INSERT INTO users (username, email, password, timecreated, token) 
                  VALUES('$username', '$email', '$password', '$date', '$token')";
        mysqli_query($db, $query);

        $id = $db->insert_id;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['iduser'] = $id;
        $_SESSION['token'] = $token;
        $_SESSION['success'] = "You are now logged in";

        file_put_contents("log.txt", date("[d/m/Y H:i:s]")." | Register |".$username."\n", FILE_APPEND);

        header('location: index.php');
    }
}

// LOGIN USER

if (isset($_POST['login_user'])) {
  
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM users WHERE password='$password' AND (username='$username' OR email='$username')";
        $results = mysqli_query($db, $query);

        if (mysqli_num_rows($results) == 1) {
          $datos = $results->fetch_assoc();

          $_SESSION['iduser'] = $datos['id'];
          $_SESSION['email'] = $datos['email'];
          $_SESSION['username'] = $username;
          $_SESSION['token'] = $datos['token'];;
          $_SESSION['success'] = "Login correcto";
          file_put_contents("log.txt", date("[d/m/Y H:i:s]")." | Login | $username | ".$datos['email']." | ".$_SERVER['REMOTE_ADDR']." \n", FILE_APPEND);
          header('location: index.php');
        }else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}
  
?>