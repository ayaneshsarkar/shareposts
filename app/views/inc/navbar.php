<nav class="navbar navbar-expand-sm navbar-dark bg-dark mb-3">
  <div class="container">
    <a href="<?php echo URLROOT; ?>" class="navbar-brand"><?php echo SITENAME; ?></a>
    <button class="navbar-toggler collapsed" data-toggle="collapse" data-target="#navbarNav" aria-expanded="false">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse collapse" id="navbarNav">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item"><a href="<?php echo URLROOT; ?>" class="nav-link">Home</a></li>
        <li class="nav-item"><a href="<?php echo URLROOT; ?>/pages/about" class="nav-link">About</a></li>
      </ul>

      <ul class="navbar-nav ml-auto">
        <?php if (!empty($_SESSION['user_id'])) : ?>
          <li class="nav-item">
            <a href="#" class="nav-link">Welcome <?php echo $_SESSION['user_name']; ?></a>
          </li>
          <li class="nav-item"><a href="<?php echo URLROOT; ?>/users/logout" class="nav-link">Logout</a></li>
        <?php else : ?>
          <li class="nav-item"><a href="<?php echo URLROOT; ?>/users/login" class="nav-link">Login</a></li>
          <li class="nav-item"><a href="<?php echo URLROOT; ?>/users/register" class="nav-link">Register</a></li>
        <?php endif; ?>

      </ul>
    </div>
  </div>
</nav>
