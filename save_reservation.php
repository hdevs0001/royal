<?php
session_start();
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Security check: ensure user is authenticated
    if (!isset($_SESSION['user_id'])) {
        header("Location: auth/login.php");
        exit;
    }

    $user_id = $_SESSION['user_id'];
    $full_name = htmlspecialchars(trim($_POST['full_name']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $res_date = $_POST['reservation_date'];
    $res_time = htmlspecialchars(trim($_POST['reservation_time']));
    $party_size = (int)$_POST['party_size'];
    $payment_id = htmlspecialchars(trim($_POST['razorpay_payment_id'] ?? ''));

    // Validate that a payment was successfully processed
    if (empty($payment_id)) {
        $_SESSION['res_error'] = "Payment authentication failed. No payment ID was generated. Please try again.";
        header("Location: restaurant.php");
        exit;
    }

    // Insert Reservation
    $stmt = $conn->prepare("INSERT INTO reservations (user_id, full_name, phone, reservation_date, reservation_time, party_size, razorpay_payment_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssis", $user_id, $full_name, $phone, $res_date, $res_time, $party_size, $payment_id);

    if ($stmt->execute()) {
        $success = true;
    } else {
        $success = false;
        $error_msg = $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
} else {
    header("Location: restaurant.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Reservation Confirmed | Royal Restaurant</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body style="background: #1A120E; color: #FDFBF7;">
  <?php if (isset($success) && $success): ?>
  <div class="receipt-container" style="max-width: 600px; margin: 60px auto; background: #251B15; padding: 50px; border-radius: 12px; box-shadow: 0 15px 35px rgba(0,0,0,0.5); border: 1px solid rgba(234, 222, 203, 0.2); position: relative; overflow: hidden;">
    <!-- Decorative Header -->
    <div style="text-align: center; margin-bottom: 30px; padding-bottom: 20px; border-bottom: 1px dashed rgba(234, 222, 203, 0.2);">
        <h2 style="font-family: 'Playfair Display', serif; color: var(--accent); font-size: 2.2rem; margin-bottom: 5px;">Royal Restaurant</h2>
        <p style="font-size: 0.95rem; color: #FDFBF7; margin-bottom: 8px;">📍 #121, Sector 34 A, Chandigarh</p>
        <p style="text-transform: uppercase; font-size: 0.8rem; letter-spacing: 2px; color: rgba(253, 251, 247, 0.6);">Official Dining Receipt</p>
    </div>

    <!-- Receipt Info -->
    <div style="display: flex; justify-content: space-between; margin-bottom: 30px; font-size: 0.95rem;">
        <div>
            <p style="color: rgba(253, 251, 247, 0.6); margin-bottom: 5px;">Guest Profile</p>
            <h4 style="color: #FDFBF7; font-size: 1.1rem;"><?php echo htmlspecialchars($full_name); ?></h4>
            <p style="color: rgba(253, 251, 247, 0.6);"><?php echo htmlspecialchars($phone); ?></p>
        </div>
        <div style="text-align: right;">
            <p style="color: rgba(253, 251, 247, 0.6); margin-bottom: 5px;">Transaction ID</p>
            <h4 style="color: #FDFBF7; font-family: monospace; font-size: 1.1rem;"><?php echo htmlspecialchars($payment_id); ?></h4>
            <p style="color: rgba(253, 251, 247, 0.6);"><?php echo date('d M Y, h:i A'); ?></p>
        </div>
    </div>

    <!-- Order Details -->
    <div style="background: rgba(192, 133, 82, 0.05); padding: 25px; border-radius: 8px; margin-bottom: 30px; border: 1px solid rgba(192, 133, 82, 0.2);">
        <h3 style="font-family: 'Playfair Display', serif; font-size: 1.3rem; margin-bottom: 15px; color: var(--accent); border-bottom: 1px solid rgba(234, 222, 203, 0.1); padding-bottom: 10px;">Reservation Manifest</h3>
        
        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
            <span style="color: rgba(253, 251, 247, 0.8);">Party Size</span>
            <span style="font-weight: 600; text-align: right; color: #FDFBF7;"><?php echo htmlspecialchars($party_size); ?> Guests</span>
        </div>
        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
            <span style="color: rgba(253, 251, 247, 0.8);">Dining Date</span>
            <span style="font-weight: 500; text-align: right; color: #FDFBF7;"><?php echo htmlspecialchars(date('M j, Y', strtotime($res_date))); ?></span>
        </div>
        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
            <span style="color: rgba(253, 251, 247, 0.8);">Arrival Time</span>
            <span style="font-weight: 500; text-align: right; color: #FDFBF7;"><?php echo htmlspecialchars(date('h:i A', strtotime($res_time))); ?></span>
        </div>
    </div>

    <!-- Financials -->
    <div style="border-top: 1px solid rgba(234, 222, 203, 0.2); padding-top: 20px; font-size: 1.1rem;">
        <div style="display: flex; justify-content: space-between; font-weight: 700; color: #1A120E; font-size: 1.3rem; background: var(--accent); padding: 15px; border-radius: 8px;">
            <span>Secured Deposit (Paid)</span>
            <span>₹200</span>
        </div>
    </div>
    
    <div style="margin-top: 40px; text-align: center; display: flex; gap: 15px; justify-content: center;" class="no-print">
        <button onclick="window.print()" class="btn" style="background: transparent; color: var(--accent); border: 1px solid var(--accent); padding: 12px 25px;">Print Receipt</button>
        <a href="restaurant.php" class="btn" style="padding: 12px 25px;">Return to Restaurant</a>
    </div>

    <style>
      @media print {
        body { background: #fff !important; color: #000 !important; }
        .receipt-container { background: #fff !important; box-shadow: none !important; border: 1px solid #ccc !important; color: #000 !important; margin: 0 !important; padding: 20px !important; max-width: 100% !important; }
        .receipt-container * { color: #000 !important; border-color: #ccc !important; }
        .no-print { display: none !important; }
      }
    </style>
  </div>
  <?php else: ?>
  <div class="message-box" style="margin-top: 100px; text-align: center; padding: 40px; background: #251B15; max-width: 500px; margin-left: auto; margin-right: auto; border-radius: 8px;">
      <h1 style="color: #d32f2f;">Reservation Failed</h1>
      <p style="color: #FDFBF7; margin: 20px 0;">There was an error securing your table. <?php echo isset($error_msg) ? htmlspecialchars($error_msg) : 'Please try again.'; ?></p>
      <a href="restaurant.php" class="btn" style="margin-top: 20px;">Return to Restaurant</a>
  </div>
  <?php endif; ?>
</body>
</html>
