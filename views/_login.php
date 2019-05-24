<!DOCTYPE html>
<html>
  <head>
  </head>
  <div class="login">
  <h1>Vänligen logga in</h1>
  <form class="login" name='form' onsubmit="return log_val();" action="loginprocess.php" method='POST'>
    <label for="email">Email:  </label><br>
    <input type="text" name="email" value=""><br>
    <label for="password">Lösenord: </label><br>
    <input type="password" name="password" value=""><br><br>
    <input type="submit" name="login" value="Logga in">
  </div>
  <p>Inte registrerad? <a href=register.php>Tryck här!</a></p>
  </form>
</html>
