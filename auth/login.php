<?php
session_start();
require_once '../config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $error = "Please fill in all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format. Please provide a valid email.";
    } else {
        $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $name, $hashed_password);
            $stmt->fetch();
            
            if (password_verify($password, $hashed_password)) {
                // Securely log in the user
                $_SESSION['user_id'] = $id;
                $_SESSION['user_name'] = $name;
                header("Location: ../booking.php");
                exit();
            } else {
                $error = "Invalid password.";
            }
        } else {
            $error = "No user found with that email address.";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Log In | Royal Rituals</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body style="display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; background: var(--bg-color);">

<div class="auth-box" style="margin: 0; position: relative;">
  <div class="logo">Royal Rituals</div>
  <p>Welcome back. Log in to manage your bookings.</p>

  <?php if ($error): ?><div class="error"><?php echo htmlspecialchars($error); ?></div><?php endif; ?>

  <form action="login.php" method="POST" novalidate>
    <div>
      <label>Email Address</label>
      <input type="email" name="email" required placeholder="you@example.com">
    </div>
    <div>
      <label>Password</label>
      <input type="password" name="password" required placeholder="••••••••">
    </div>
    <button type="submit" class="btn">Log In</button>
  </form>

  <div class="auth-links">
    Don't have an account? <a href="signup.php">Sign Up</a><br><br>
    <a href="../index.php">Return to Home</a>
  </div>
</div>

</body>
</html>
