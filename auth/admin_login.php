<?php
session_start();
require_once '../config.php';

if (isset($_SESSION['admin_logged_in'])) {
    header("Location: ../admin.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, name, password FROM admins WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['admin_name'] = $user['name'];
            header("Location: ../admin.php");
            exit();
        } else {
            $error = "Invalid Royal Rituals credentials.";
        }
    } else {
        $error = "Invalid Royal Rituals credentials.";
    }
    
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Royal Rituals Dashboard Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .auth-container { max-width: 400px; margin: 100px auto; padding: 40px; background: #fff; border-radius: 12px; box-shadow: 0 10px 40px rgba(0,0,0,0.08); border-top: 5px solid #1A120E; }
        .auth-container h2 { font-family: 'Playfair Display', serif; color: #1A120E; text-align: center; margin-bottom: 25px; }
        .form-group label { display: block; margin-bottom: 8px; color: var(--text-primary); font-weight: 500; }
        .form-group input { width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 8px; margin-bottom: 20px; transition: 0.3s; }
        .form-group input:focus { border-color: var(--accent); outline: none; box-shadow: 0 0 0 3px rgba(192, 133, 82, 0.2); }
        .btn-admin { width: 100%; padding: 14px; background: #1A120E; color: #FDFBF7; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; transition: 0.3s; }
        .btn-admin:hover { background: var(--accent); color: #1A120E; }
        .error { background: #fee2e2; color: #b91c1c; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 0.9rem; text-align: center; }
    </style>
</head>
<body style="background: #FAF8F5;">

<div class="auth-container">
    <h2>Secure Royal Rituals Gateway</h2>
    <?php if (isset($error)): ?>
        <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    
    <form action="admin_login.php" method="POST" autocomplete="off">
        <div class="form-group">
            <label for="email">Management Email ID</label>
            <input type="email" id="email" name="email" required>
        </div>
        
        <div class="form-group">
            <label for="password">Security Passcode</label>
            <input type="password" id="password" name="password" required>
        </div>
        
        <button type="submit" class="btn-admin">Authorize Access</button>
    </form>
    <div style="text-align: center; margin-top: 20px;">
        <a href="../index.php" style="color: var(--text-secondary); text-decoration: none; font-size: 0.85rem;">&larr; Return to Public Site</a>
    </div>
</div>

</body>
</html>
