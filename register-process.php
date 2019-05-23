<?php
include_once("bootstrap.php");
  //Kontrollerar att ett formulär faktiskt är skickat, blir annars error
  //om man refereras hit.
  if (isset($_POST['subReg']))
  {
    $conn = connect();
    //tilldelar variabler och säkrar för SQL.
    $name = mysqli_real_escape_string($conn, $_POST['namn']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $pw = mysqli_real_escape_string($conn, $_POST['password']);
    //Kör valideringsfunktionen
    if(!val_reg($name,$email,$pw))
    {
      header("Location: register.php?msg=Något gick fel, vänligen försök igen");
      die();
    }
    else
    {
      //Saltar lösenordet samt gör query för att lägga till användaren i DB.
      $salt = salt();
      $encpw = md5($salt . $pw);
      $query = "INSERT INTO users(name, email, pw, salt, admin)
            VALUES('$name', '$email', '$encpw', '$salt', 'FALSE');";
      //Genomför och kontrollerar att registreringen gick.
      if(db($query, $conn))
        {
          $conn->close();
          header("Location: login.php?msg=Registered! Please log in below.");
        }else
          header("Location: register.php?msg=Email already in use");
        die();
        }
    }
 ?>
