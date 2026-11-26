<?php
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
$current_page = basename($_SERVER['PHP_SELF']);
?>
<style>
  /* Global Header Fix for Button Hovers (Bypasses all cache) */
  .diner a:hover {
      background: var(--accent) !important;
      color: #ffffff !important;
      border-color: var(--accent) !important;
  }
</style>
<header>
  <div class="logo"><a href="index.php" style="text-decoration: none; color: inherit;">Royal Rituals</a></div>

  <nav>
    <ul>
      <li><a href="about.php" class="<?= ($current_page == 'about.php') ? 'active' : '' ?>">Our Legacy</a></li>
      <li><a href="offerings.php" class="<?= ($current_page == 'offerings.php') ? 'active' : '' ?>">Offerings</a></li>
      <li><a href="booking.php" class="<?= ($current_page == 'booking.php') ? 'active' : '' ?>">Bookings</a></li>
      <li><a href="contact.php" class="<?= ($current_page == 'contact.php') ? 'active' : '' ?>">Contact</a></li>
    </ul>
  </nav>

  <div class="diner" style="display: flex; align-items: center; gap: 15px;">
    <?php if(isset($_SESSION['user_id'])): ?>
      <a href="my_bookings.php" style="font-size: 0.9rem; text-decoration: none; color: var(--text-primary); border: 1px solid var(--border-color); padding: 5px 12px; border-radius: 4px; transition: 0.3s; background: <?= ($current_page == 'my_bookings.php') ? 'var(--border-color)' : 'transparent' ?>;">My Orders</a>
      <a href="auth/logout.php" style="font-size: 0.9rem; text-decoration: none; color: var(--text-secondary); padding: 5px 12px; transition: 0.3s;">Logout</a>
    <?php else: ?>
      <a href="auth/login.php" style="font-size: 0.9rem; text-decoration: none; color: var(--text-primary); border: 1px solid var(--border-color); padding: 5px 12px; border-radius: 4px; transition: 0.3s;">Login</a>
      <a href="auth/signup.php" style="font-size: 0.9rem; text-decoration: none; color: var(--text-secondary); padding: 5px 12px; transition: 0.3s;">Sign Up</a>
    <?php endif; ?>
    <a href="restaurant.php" style="font-size: 0.95rem; font-weight: 500; color: var(--accent); <?= ($current_page == 'restaurant.php') ? 'border-bottom: 1px solid var(--accent);' : '' ?>">Royal Restaurant</a>
  </div>
</header>
