<?php
include_once("assets\bootstrap.php");
#Hämtar datan från formuläret
$email = $_POST['email'];
$pw = $_POST['password'];
#Validerar formdatan och kontrollerar lösenorder om validering går igenom
if(val_log($email, $pw)){
    if(md5(get_one($email, "salt") . $pw) === get_one($email, "pw"))
    {
      $_SESSION['email'] = $email;
      $_SESSION['loggedin'] = true;
      header("Location: index.php?msg=Log in successful");
    }
    else{
      header("Location: login.php?msg=Incorrect email or password.");
      break;
    }
  }
  else {
    header("Location: login.php?msg=Incorrect email or password");
    break;
  }
