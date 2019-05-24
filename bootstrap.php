<?php
session_start();
function salt(){
  return substr(sha1(mt_rand()),0,22);
}

function connect(){
  $servername = "dbtrain.im.uu.se";
  $dbusername = "dbtrain_1083";
  $dbpassword = "tbepnr";
  $dbname = "dbtrain_1083";
  $conn = new mysqli($servername,$dbusername,$dbpassword,$dbname);
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  else{
  return $conn;
  }
}

function db($sql, $conn){
  $conn = connect();
  if($conn->query($sql)===FALSE)
  {
    echo "Error: " . $sql . "<br>" . $conn->error;
    return false;
  }
  else{
    return true;
  }
}

function get_one($email, $column)
{
  $sql = "SELECT " . $column ." FROM users WHERE email = '$email'";
  $conn = connect();
  $result = mysqli_fetch_array(mysqli_query($conn,$sql));
  $salt = $result[0];
  mysqli_close($conn);
  return $salt;
}

function add_rec()
{
  $conn = connect();
  $a = mysqli_real_escape_string($conn ,$_POST['recipename']);
  $b = mysqli_real_escape_string($conn, $_POST['description']);
  $c = mysqli_real_escape_string($conn, $_POST['ingredients']);
  $d = mysqli_real_escape_string($conn, $_POST['instructions']);
  $e = mysqli_real_escape_string($conn, $_POST['time']);

  $email = $_SESSION['email'];

  $query_getuserid = "SELECT id FROM users WHERE email = '$email'";
  $userid = mysqli_fetch_array(mysqli_query($conn, $query_getuserid))[0];
  $query_getpostid = "SELECT MAX(rec_id) FROM recipe";
  $postid = mysqli_fetch_array(mysqli_query($conn, $query_getpostid))[0] + 1;
  $query1 = "INSERT INTO recipe (name, beskrivning, ingredients, instructions, tid, poster)
  VALUES('$a', '$b', '$c', '$d', '$e', '$userid')";

  if($check)
  {
    header("Location: index.php?msg=Recept tillagt!");
  }
  else {
    header("Location: postrecipe.php?msg=Försök att lägga till misslyckades, vänligen försök igen. ");
  }
}

function val_reg($_name, $_email, $_pword)
{
  $errors = array();
  if(0 === preg_match("/\S+/", $_name))
  {
    $errors["name"] = "Inget namn angivet.";
  }

  if(0 === preg_match("/.+@.+\..+/", $_email)){
      $errors["email"] = "Inkorrekt email";
  }

  if(0 === preg_match("/\S+/", $_pword) || strlen($_pword)<8)
  {
    $errors["password"] = "För kort lösenord.";
  }

  if(0 === count($errors))
  {
      return true;
  }
  else{
    return false;
  }
}

function val_log($_email, $_pword)
{
  $errors = array();
  if(0 === preg_match("/.+@.+\..+/", $_email)){
      $errors["email"] = "Inkorrekt email";
  }

  if(0 === preg_match("/\S+/", $_pword) || strlen($_pword)<8)
  {
    $errors["password"] = "För kort lösenord.";
  }

  if(0 === count($errors))
  {
      return true;
  }
  else{
    return false;
  }
}

function admin_btn()
{
  if(isset($_SESSION['admin']))
  {
    echo "<li><a href=removeposts.php class=" . "menu" . ">MANAGE<br>POSTS</a></li>";
  }
}

function is_log(){
  if(!isset($_SESSION['email']) || $_SESSION['loggedin'] !== true)
    {
      return false;
    }
  else {
    return true;
  }
}

function try_log(){
  if(!is_log())
  {
    header("Location: login.php?msg=Vänligen logga in för att kunna posta");
  }
}

function log_btn()
  {
    if(is_log() == true)
    {
      echo "<li><a href=logoutprocess.php class=" . "menu" . ">LOG<br>OUT</a></li>";
    }
    else {
      echo "<li><a href=login.php class=" . "menu" . ">LOG<br>IN</a></li>";
    }
}
?>
