<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: auth/admin_login.php");
    exit();
}

// Fetch Event Bookings
$bookings_query = "SELECT * FROM bookings ORDER BY event_date ASC, created_at DESC";
$bookings_result = $conn->query($bookings_query);

// Fetch Diner Reservations
$reservations_query = "SELECT * FROM reservations ORDER BY reservation_date ASC, created_at DESC";
$reservations_result = $conn->query($reservations_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Royal Admin Dashboard | Heritage Management</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
<style>
body { background: #FAF8F5; color: var(--text-primary); }
.admin-container { max-width: 1400px; margin: 60px auto 60px; padding: 0 5%; }
.admin-header { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid var(--accent); padding-bottom: 20px; margin-bottom: 40px; }
.admin-header h1 { font-size: 2.5rem; color: var(--text-primary); }

.dashboard-section { margin-bottom: 60px; background: #fff; padding: 40px; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
.dashboard-section h2 { font-family: 'Playfair Display', serif; font-size: 1.8rem; margin-bottom: 20px; color: var(--accent); border-bottom: 1px solid rgba(192, 133, 82, 0.2); padding-bottom: 15px; }

table { width: 100%; border-collapse: collapse; margin-top: 20px; }
th, td { text-align: left; padding: 15px 20px; font-family: 'Outfit', sans-serif; font-size: 0.95rem; }
th { background: var(--text-primary); color: #FDFBF7; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 1px; }
tr:nth-child(even) { background-color: #FDFBF7; }
tr:hover { background-color: rgba(192, 133, 82, 0.1); }
td { border-bottom: 1px solid #eee; color: var(--text-secondary); }

.badge-event { background: rgba(192, 133, 82, 0.15); color: var(--accent); padding: 5px 10px; border-radius: 6px; font-weight: 600; font-size: 0.85rem; }
.badge-diner { background: #1A120E; color: #FDFBF7; padding: 5px 10px; border-radius: 6px; font-weight: 500; font-size: 0.85rem; letter-spacing: 0.5px; }
</style>
</head>
<body>



<div class="admin-container">
  <div class="admin-header">
    <h1>Royal Rituals Dashboard</h1>
    <div style="display:flex; gap: 15px;">
      <a href="index.php" class="btn" style="background: transparent; border: 1px solid var(--text-primary); color: var(--text-primary);">Return to Site</a>
      <a href="auth/admin_logout.php" class="btn" style="background: #e74c3c; border: none;">Secure Logout</a>
    </div>
  </div>

  <div class="dashboard-section">
    <h2>Extravagant Indian Event Bookings</h2>
    <?php if($bookings_result->num_rows > 0): ?>
    <table>
      <thead>
        <tr>
          <th>Client Name</th>
          <th>Phone Contact</th>
          <th>Ceremony Type</th>
          <th>Decor Theme</th>
          <th>Culinary Preference</th>
          <th>Guest Count</th>
          <th>Muhurat Date & Time</th>
          <th>Total Cost Est.</th>
          <th>Deposit & Receipt</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = $bookings_result->fetch_assoc()): ?>
        <tr>
          <td style="font-weight:600; color:var(--text-primary);"><?= htmlspecialchars($row['full_name']); ?></td>
          <td><?= htmlspecialchars($row['phone']); ?></td>
          <td><span class="badge-event"><?= htmlspecialchars($row['event_type']); ?></span></td>
          <td><?= htmlspecialchars($row['theme']); ?></td>
          <td><?= htmlspecialchars($row['meals']); ?></td>
          <td><?= htmlspecialchars($row['guests']); ?> Guests</td>
          <td style="font-weight:500; font-size: 0.9rem;"><?= date('M j, Y', strtotime($row['event_date'])); ?><br><span style="color:var(--accent);"><?= htmlspecialchars($row['event_time']); ?></span></td>
          <td style="color:var(--text-primary); font-weight:600;">₹<?= number_format($row['total_amount'] ?? 0); ?></td>
          <td>
            <span style="font-weight:600; color:#2e7d32; display:block;">₹<?= number_format($row['downpayment'] ?? 0); ?></span>
            <span style="font-size:0.75rem; color:#666; font-family:monospace;">ID: <?= htmlspecialchars($row['razorpay_payment_id'] ?? '-'); ?></span>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
    <?php else: ?>
      <p style="color:var(--text-secondary); font-style:italic;">No majestic events have been booked yet.</p>
    <?php endif; ?>
  </div>

  <div class="dashboard-section">
    <h2>Royal Diner Exclusives (Table Reservations)</h2>
    <?php if($reservations_result && $reservations_result->num_rows > 0): ?>
    <table>
      <thead>
        <tr>
          <th>Guest Name</th>
          <th>Phone Contact</th>
          <th>Reservation Date</th>
          <th>Evening Time</th>
          <th>Party Size</th>
          <th>Requested On</th>
        </tr>
      </thead>
      <tbody>
        <?php while($r_row = $reservations_result->fetch_assoc()): ?>
        <tr>
          <td style="font-weight:600; color:var(--text-primary);"><?= htmlspecialchars($r_row['full_name']); ?></td>
          <td><?= htmlspecialchars($r_row['phone']); ?></td>
          <td style="font-weight:500;"><?= date('M j, Y', strtotime($r_row['reservation_date'])); ?></td>
          <td><span class="badge-diner"><?= htmlspecialchars($r_row['reservation_time']); ?></span></td>
          <td><?= htmlspecialchars($r_row['party_size']); ?> Guests</td>
          <td style="font-size: 0.85rem;"><?= date('M j, Y (g:i A)', strtotime($r_row['created_at'])); ?></td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
    <?php else: ?>
      <p style="color:var(--text-secondary); font-style:italic;">No intimate dining tables have been secured yet.</p>
    <?php endif; ?>
  </div>

</div>

</body>
</html>
<?php 
$conn->close(); 
?>
