<?php
include 'header.php';
?>
<div class="container">
  <h1>Home</h1>

  <?php if (isset($_SESSION['email'])): ?>
    <p class="welcome">Welcome <strong><?php echo htmlspecialchars($_SESSION['name']); ?></strong> — your email is <strong><?php echo htmlspecialchars($_SESSION['email']); ?></strong>.</p>
    <p class="actions"><a class="button secondary" href="logout.php">Logout</a></p>
  <?php else: ?>
    <p class="actions">Please <a class="button" href="login.php">Login</a> to continue.</p>
  <?php endif; ?>
</div>
</body>

</html>