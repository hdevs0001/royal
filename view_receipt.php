<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit();
}

$user_id = (int)$_SESSION['user_id'];
$type = $_GET['type'] ?? '';
$id = (int)($_GET['id'] ?? 0);

if ($type !== 'event' && $type !== 'reservation') {
    die("Invalid receipt type.");
}

$success = false;

if ($type === 'event') {
    $stmt = $conn->prepare("SELECT * FROM bookings WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $success = true;
        // Map vars for HTML
        $full_name = $row['full_name'];
        $phone = $row['phone'];
        $payment_id = $row['razorpay_payment_id'];
        $event_type = $row['event_type'];
        $theme = $row['theme'];
        $meals = $row['meals'];
        $guests = $row['guests'];
        $event_date = $row['event_date'];
        $event_time = $row['event_time'];
        $total_amount = $row['total_amount'];
        $downpayment = $row['downpayment'];
        $created_at = $row['created_at'];
    }
    $stmt->close();
} else if ($type === 'reservation') {
    $stmt = $conn->prepare("SELECT * FROM reservations WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $success = true;
        // Map vars for HTML
        $full_name = $row['full_name'];
        $phone = $row['phone'];
        $payment_id = $row['razorpay_payment_id'];
        $party_size = $row['party_size'];
        $res_date = $row['reservation_date'];
        $res_time = $row['reservation_time'];
        $created_at = $row['created_at'];
    }
    $stmt->close();
}
$conn->close();

if (!$success) {
    die("Receipt not found or unauthorized.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Official Receipt | Royal Rituals</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    @media print {
      body { background: #fff !important; color: #000 !important; }
      .receipt-container { background: #fff !important; box-shadow: none !important; border: 1px solid #ccc !important; color: #000 !important; margin: 0 !important; padding: 20px !important; max-width: 100% !important; }
      .receipt-container * { color: #000 !important; border-color: #ccc !important; text-shadow: none !important; }
      .no-print { display: none !important; }
    }
  </style>
</head>
<?php if ($type === 'event'): ?>
<body style="background: #FAF8F5;">
  <div class="receipt-container" style="max-width: 600px; margin: 60px auto; background: #fff; padding: 50px; border-radius: 12px; box-shadow: 0 15px 35px rgba(0,0,0,0.05); border: 1px solid var(--border-color); position: relative; overflow: hidden;">
    <div style="text-align: center; margin-bottom: 30px; padding-bottom: 20px; border-bottom: 2px dashed var(--border-color);">
        <h2 style="font-family: 'Playfair Display', serif; color: var(--accent); font-size: 2.2rem; margin-bottom: 5px;">Royal Rituals</h2>
        <p style="text-transform: uppercase; font-size: 0.9rem; letter-spacing: 2px; color: var(--text-secondary);">Official Royal Rituals Receipt</p>
    </div>

    <div style="display: flex; justify-content: space-between; margin-bottom: 30px; font-size: 0.95rem;">
        <div>
            <p style="color: var(--text-secondary); margin-bottom: 5px;">Client Profile</p>
            <h4 style="color: var(--text-primary); font-size: 1.1rem;"><?php echo htmlspecialchars($full_name); ?></h4>
            <p style="color: var(--text-secondary);"><?php echo htmlspecialchars($phone); ?></p>
        </div>
        <div style="text-align: right;">
            <p style="color: var(--text-secondary); margin-bottom: 5px;">Transaction ID</p>
            <h4 style="color: var(--text-primary); font-family: monospace; font-size: 1.1rem;"><?php echo htmlspecialchars($payment_id); ?></h4>
            <p style="color: var(--text-secondary);"><?php echo date('d M Y, h:i A', strtotime($created_at)); ?></p>
        </div>
    </div>

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
        <button onclick="window.print()" class="btn" style="background: transparent; color: var(--text-primary); border: 1px solid var(--text-primary); padding: 12px 25px;">Download / Print Receipt</button>
        <a href="my_bookings.php" class="btn" style="padding: 12px 25px;">Return to Portal</a>
    </div>
  </div>
</body>

<?php elseif ($type === 'reservation'): ?>
<body style="background: #1A120E; color: #FDFBF7;">
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
            <p style="color: rgba(253, 251, 247, 0.6);"><?php echo date('d M Y, h:i A', strtotime($created_at)); ?></p>
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
            <span style="font-weight: 500; text-align: right; color: #FDFBF7;"><?php echo htmlspecialchars($res_time); ?></span>
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
        <button onclick="window.print()" class="btn" style="background: transparent; color: var(--accent); border: 1px solid var(--accent); padding: 12px 25px;">Download / Print Receipt</button>
        <a href="my_bookings.php" class="btn" style="padding: 12px 25px;">Return to Portal</a>
    </div>
  </div>
</body>
<?php endif; ?>
</html>
