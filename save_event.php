<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: booking.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id    = $_SESSION['user_id'];
    $event_type = $_POST['event_type'] ?? '';
    $theme      = $_POST['theme'] ?? ''; 
    
    // Capture included ceremonies if Grand Shaadi was selected
    if(isset($_POST['addons']) && is_array($_POST['addons'])) {
        $addon_str = implode(" & ", $_POST['addons']);
        $theme .= " (Includes: $addon_str)";
    }
    
    $meals = '';
    if(isset($_POST['meals']) && is_array($_POST['meals'])) {
        $meals = implode(" & ", $_POST['meals']);
    } else {
        $meals = $_POST['meals'] ?? '';
    }
    $full_name  = $_POST['name'] ?? '';
    $phone      = $_POST['phone'] ?? '';
    $event_date = $_POST['date'] ?? '';
    $event_time = $_POST['time'] ?? '';
    $guests     = $_POST['guests'] ?? 0;
    
    $total_amount = (int)($_POST['total_amount'] ?? 0);
    $downpayment  = (int)($_POST['downpayment'] ?? 0);
    $payment_id   = htmlspecialchars(trim($_POST['razorpay_payment_id'] ?? ''));

    if (empty($payment_id)) {
        echo "<script>alert('Error: Downpayment authentication failed.'); window.location.href='booking.php';</script>";
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO bookings (user_id, event_type, theme, meals, full_name, phone, event_date, event_time, guests, total_amount, downpayment, razorpay_payment_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssssssiiis", $user_id, $event_type, $theme, $meals, $full_name, $phone, $event_date, $event_time, $guests, $total_amount, $downpayment, $payment_id);

    if ($stmt->execute()) {
        $success = true;
    } else {
        $success = false;
        $error_msg = $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
} else {
    header("Location: booking.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Booking Confirmed | Royal Rituals</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body style="background: #FAF8F5;">
  <?php if (isset($success) && $success): ?>
  <div class="receipt-container" style="max-width: 600px; margin: 60px auto; background: #fff; padding: 50px; border-radius: 12px; box-shadow: 0 15px 35px rgba(0,0,0,0.05); border: 1px solid var(--border-color); position: relative; overflow: hidden;">
    <!-- Decorative Header -->
    <div style="text-align: center; margin-bottom: 30px; padding-bottom: 20px; border-bottom: 2px dashed var(--border-color);">
        <h2 style="font-family: 'Playfair Display', serif; color: var(--accent); font-size: 2.2rem; margin-bottom: 5px;">Royal Rituals</h2>
        <p style="text-transform: uppercase; font-size: 0.9rem; letter-spacing: 2px; color: var(--text-secondary);">Official Royal Rituals Receipt</p>
    </div>

    <!-- Receipt Info -->
    <div style="display: flex; justify-content: space-between; margin-bottom: 30px; font-size: 0.95rem;">
        <div>
            <p style="color: var(--text-secondary); margin-bottom: 5px;">Client Profile</p>
            <h4 style="color: var(--text-primary); font-size: 1.1rem;"><?php echo htmlspecialchars($full_name); ?></h4>
            <p style="color: var(--text-secondary);"><?php echo htmlspecialchars($phone); ?></p>
        </div>
        <div style="text-align: right;">
            <p style="color: var(--text-secondary); margin-bottom: 5px;">Transaction ID</p>
            <h4 style="color: var(--text-primary); font-family: monospace; font-size: 1.1rem;"><?php echo htmlspecialchars($payment_id); ?></h4>
            <p style="color: var(--text-secondary);"><?php echo date('d M Y, h:i A'); ?></p>
        </div>
    </div>

    <!-- Order Details -->
    <div style="background: #FDFBF7; padding: 25px; border-radius: 8px; margin-bottom: 30px; border: 1px solid rgba(192, 133, 82, 0.15);">
        <h3 style="font-family: 'Playfair Display', serif; font-size: 1.3rem; margin-bottom: 15px; color: var(--text-primary); border-bottom: 1px solid var(--border-color); padding-bottom: 10px;">Event Manifest</h3>
        
        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
            <span style="color: var(--text-secondary);">Ceremony Type</span>
            <span style="font-weight: 600; text-align: right;"><?php echo htmlspecialchars($event_type); ?></span>
        </div>
        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
            <span style="color: var(--text-secondary);">Decor / Theme</span>
            <span style="font-weight: 500; text-align: right; max-width: 60%;"><?php echo htmlspecialchars($theme ?: 'Standard Heritage'); ?></span>
        </div>
        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
            <span style="color: var(--text-secondary);">Culinary Setup</span>
            <span style="font-weight: 500; text-align: right; max-width: 60%;"><?php echo htmlspecialchars($meals); ?> <br><span style="font-size: 0.85rem; color: var(--accent);">(<?php echo htmlspecialchars($guests); ?> Guests)</span></span>
        </div>
        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
            <span style="color: var(--text-secondary);">Muhurat Timeline</span>
            <span style="font-weight: 600; text-align: right;"><?php echo htmlspecialchars(date('M j, Y', strtotime($event_date))); ?> <br><span style="font-size: 0.85rem; color: var(--accent);"><?php echo htmlspecialchars($event_time); ?></span></span>
        </div>
    </div>

    <!-- Financials -->
    <div style="border-top: 2px solid var(--border-color); padding-top: 20px; font-size: 1.1rem;">
        <div style="display: flex; justify-content: space-between; margin-bottom: 15px; color: var(--text-secondary);">
            <span>Extravaganza Base Estimate</span>
            <span style="font-weight: 600; color: var(--text-primary);">₹<?php echo number_format($total_amount); ?></span>
        </div>
        <div style="display: flex; justify-content: space-between; font-weight: 700; color: #1A120E; font-size: 1.3rem; background: var(--accent); padding: 15px; border-radius: 8px;">
            <span>Secure Deposit Processed (5%)</span>
            <span>₹<?php echo number_format($downpayment); ?></span>
        </div>
    </div>
    
    <div style="margin-top: 40px; text-align: center; display: flex; gap: 15px; justify-content: center;" class="no-print">
        <button onclick="window.print()" class="btn" style="background: transparent; color: var(--text-primary); border: 1px solid var(--text-primary); padding: 12px 25px;">Print Receipt</button>
        <a href="index.php" class="btn" style="padding: 12px 25px;">Return to Manor</a>
    </div>

    <style>
      @media print {
        body { background: #fff !important; }
        .receipt-container { box-shadow: none !important; border: none !important; margin: 0 !important; padding: 0 !important; max-width: 100% !important; }
        .no-print { display: none !important; }
      }
    </style>
  </div>
  <?php else: ?>
  <div class="message-box" style="margin-top: 100px;">
      <h1 style="color: #d32f2f;">Booking Failed</h1>
      <p>There was an error processing your booking. <?php echo isset($error_msg) ? htmlspecialchars($error_msg) : 'Please try again.'; ?></p>
      <a href="booking.php" class="btn" style="margin-top: 20px;">Return to Planning</a>
  </div>
  <?php endif; ?>
</body>
</html>
