<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form class='form' name='form' onsubmit="return reg_val();" method='POST' action='regprocess.php'>
      <label for="namn">Namn: </label>
      <br>
      <input type="text" name="namn" value="">
      <br>
      <label for="email">Email: </label>
      <br>
      <input type="text" name="email" value="">
      <br>
      <label for="pass">Lösenord, minst 8 tecken: </label>
      <br>
      <input type="password" name="password" value="">
      <br>
      <br>
      <input type="submit" name="subReg" value="Registrera">
    </form>
  </body>
</html>
