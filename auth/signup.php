<?php
session_start();
require_once '../config.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($name) || empty($email) || empty($password)) {
        $error = "Please fill in all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format. Please provide a valid email.";
    } else {
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $error = "An account with this email already exists.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $insert = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $insert->bind_param("sss", $name, $email, $hashed_password);
            
            if ($insert->execute()) {
                $success = "Account created successfully! You can now <a href='login.php' style='color:var(--accent)'>Login</a>.";
            } else {
                $error = "Something went wrong. Please try again.";
            }
            $insert->close();
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
<title>Create Account | Royal Rituals</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body style="display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; background: var(--bg-color);">

<div class="auth-box" style="margin: 0; position: relative;">
  <div class="logo">Royal Rituals</div>
  <p>Create an account to track your prestigious events.</p>

  <?php if ($error): ?><div class="error"><?php echo htmlspecialchars($error); ?></div><?php endif; ?>
  <?php if ($success): ?><div class="success"><?php echo $success; ?></div><?php endif; ?>

  <form action="signup.php" method="POST" novalidate>
    <div>
      <label>Full Name</label>
      <input type="text" name="name" required placeholder="John Doe">
    </div>
    <div>
      <label>Email Address</label>
      <input type="email" name="email" required placeholder="you@example.com">
    </div>
    <div>
      <label>Password</label>
      <input type="password" name="password" required placeholder="••••••••">
    </div>
    <button type="submit" class="btn">Sign Up</button>
  </form>

  <div class="auth-links">
    Already have an account? <a href="login.php">Log In</a><br><br>
    <a href="../index.php">Return to Home</a>
  </div>
</div>

</body>
</html>
