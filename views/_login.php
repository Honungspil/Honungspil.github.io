<!DOCTYPE html>
<html>
  <head>
  </head>
  <div class="login">
  <h1>Please enter your email and password</h1>
  <form class="login" name='form' onsubmit="return log_val();" action="login-process.php" method='POST'>
    <label for="email">Email:  </label><br>
    <input type="text" name="email" value=""><br>
    <label for="password">Password: </label><br>
    <input type="password" name="password" value=""><br><br>
    <input type="submit" name="login" value="Login">
  </div>
  <p>Not registered? <a href=register.php>Register</a></p>
  </form>
</html>
