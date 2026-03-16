<?php
include 'header.php';
include 'dbconnect.php';

$email = $password = $err_msg = "";
$remember = "";

if (isset($_POST['submit'])) {
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);

  if (isset($_POST['remember'])) {
    $remember = $_POST['remember'];
  }

  $password = md5($password);

  $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);
    $_SESSION['name'] = $row['name'];
    $_SESSION['email'] = $email;

    if (isset($_POST['remember'])) {
      $remember = $_POST['remember'];
      setcookie("remember_email", $email, time() + 3600 * 24 * 365);
      setcookie("remember", $remember, time() + 3600 * 24 * 365);
    } else {
      setcookie("remember_email", "", time() - 36000);
      setcookie("remember", "", time() - 3600);
    }

    header("location:index.php");
    exit;
  } else {
    $err_msg = "Incorrect Email Id/Password";
  }
}
?>

<div class="container">
  <h1>Login</h1>

  <?php if ($err_msg !== ""): ?>
    <p class="err-msg"><?php echo htmlspecialchars($err_msg); ?></p>
  <?php endif; ?>

  <form action="login.php" method="post" autocomplete="off">
    <label for="email">Email</label>
    <input type="text" name="email" id="email" value="<?php echo htmlspecialchars(!empty($email) ? $email : (isset($_COOKIE['remember_email']) ? $_COOKIE['remember_email'] : '')); ?>" placeholder="Enter your email" required>

    <label for="password">Password</label>
    <input type="password" name="password" id="password" placeholder="Enter password" required>

    <label class="checkbox">
      <input type="checkbox" name="remember" <?php if (!empty($remember) || isset($_COOKIE['remember'])) echo 'checked'; ?>> Remember me
    </label>

    <button type="submit" class="button" name="submit">Login</button>
    <a class="button secondary" href="index.php">Cancel</a>
  </form>
</div>
</body>

</html>