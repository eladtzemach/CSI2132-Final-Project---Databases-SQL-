<?php require 'head.php'; ?>
<div class="row header">
  <div class="large-12 columns">
    <div class="nav-bar right">
      <ul class="button-group">
        <?php if (!isset($_SESSION['created'])): ?>
          <li><a href="create.php" class="button success small">Join</a></li>
          <li><a href="signin.php" class="button small">Sign In</a></li>
        <?php else: ?>
          <li><a href="raterProfile.php?userid=<?php echo $_SESSION['userid'] ?>" class="button small">Profile</a></li>
          <li><a href="logout.php" class="button alert small">Sign Out</a></li>
        <?php endif; ?>
      </ul>
      </div>
      <a href="index.php"><img src="img/logo.jpg" height="100" width="200"/></a>
    <hr/>
  </div>
</div>