<?php
session_start();
require_once 'config.php';

// If not logged in, bounce to auth
if(!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit();
}

$user_id = (int)$_SESSION['user_id'];

// Fetch the user's specific bookings
$stmt_b = $conn->prepare("SELECT * FROM bookings WHERE user_id = ? ORDER BY event_date ASC, created_at DESC");
$stmt_b->bind_param("i", $user_id);
$stmt_b->execute();
$client_bookings = $stmt_b->get_result();
$stmt_b->close();

// Fetch the user's specific diner reservations
$stmt_r = $conn->prepare("SELECT * FROM reservations WHERE user_id = ? ORDER BY reservation_date ASC, created_at DESC");
$stmt_r->bind_param("i", $user_id);
$stmt_r->execute();
$client_reservations = $stmt_r->get_result();
$stmt_r->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Orders | Royal Rituals</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
<style>
.dashboard-container { max-width: 1200px; margin: 80px auto; padding: 0 5%; min-height: 60vh; }
.portal-header { border-bottom: 2px solid var(--accent); padding-bottom: 20px; margin-bottom: 40px; display: flex; justify-content: space-between; align-items:flex-end; }
.portal-header h1 { font-size: 2.8rem; color: var(--primary); }

.list-section { margin-bottom: 60px; background: #fff; border-radius: 12px; padding: 30px; box-shadow: 0 8px 24px rgba(0,0,0,0.04); }
.list-section h2 { font-size: 1.8rem; margin-bottom: 20px; color: var(--accent); border-bottom: 1px dotted rgba(192, 133, 82, 0.3); padding-bottom: 10px; }

.order-card { 
    display: flex; justify-content: space-between; align-items: center; 
    padding: 20px; border: 1px solid var(--border-color); 
    border-radius: 8px; margin-bottom: 15px; background: var(--bg-color);
    transition: 0.3s;
}
.order-card:hover { border-color: var(--accent); transform: translateY(-3px); box-shadow: 0 5px 15px rgba(192,133,82,0.1); }
.order-info h3 { font-size: 1.3rem; margin-bottom: 5px; color: var(--text-primary); }
.order-info p { color: var(--text-secondary); font-size: 0.95rem; }
.order-status { text-align: right; }
.status-pill { background: rgba(192,133,82,0.15); color: var(--accent); padding: 5px 12px; border-radius: 20px; font-weight: 600; font-size: 0.85rem; letter-spacing: 0.5px; }
.date-highlight { font-weight: 600; color: var(--primary); display: block; margin-top: 10px; font-size: 1.1rem; }

.btn-book { background: var(--primary); color: #fff; text-decoration: none; padding: 10px 20px; border-radius: 4px; display: inline-block; transition: 0.3s; }
.btn-book:hover { background: #111; }
</style>
</head>
<body>

<?php include 'includes/header.php'; ?>

<div class="dashboard-container">
    <div class="portal-header">
        <h1>Welcome Back, <?= htmlspecialchars($_SESSION['user_name']); ?></h1>
    </div>

    <div class="list-section">
        <h2>Your Extravagant Events</h2>
        <?php if($client_bookings->num_rows > 0): ?>
            <?php while($b = $client_bookings->fetch_assoc()): ?>
                <div class="order-card">
                    <div class="order-info">
                        <h3><?= htmlspecialchars($b['event_type']); ?></h3>
                        <p>Theme: <?= htmlspecialchars($b['theme']); ?> | Banquet: <?= htmlspecialchars($b['meals']); ?></p>
                        <p>Guest List: <?= htmlspecialchars($b['guests']); ?> attendees secured.</p>
                    </div>
                    <div class="order-status" style="text-align: right;">
                        <span class="status-pill">CONFIRMED</span>
                        <span class="date-highlight"><?= date('F j, Y', strtotime($b['event_date'])); ?></span>
                        <p style="color:var(--text-secondary); margin-top:5px; font-size:0.85rem; margin-bottom: 10px;"><?= htmlspecialchars($b['event_time']); ?></p>
                        <a href="view_receipt.php?type=event&id=<?= $b['id'] ?>" style="font-size:0.85rem; color:var(--accent); text-decoration:none; border:1px solid var(--accent); padding:4px 10px; border-radius:4px; display:inline-block;">Download Receipt</a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="color:var(--text-secondary); font-style:italic;">You have not commissioned any royal events yet.</p>
            <br>
            <a href="booking.php" class="btn-book">Plan an Event</a>
        <?php endif; ?>
    </div>

    <div class="list-section">
        <h2>Your Royal Diner Tables</h2>
        <?php if($client_reservations->num_rows > 0): ?>
            <?php while($r = $client_reservations->fetch_assoc()): ?>
                <div class="order-card">
                    <div class="order-info">
                        <h3>Table for <?= htmlspecialchars($r['party_size']); ?></h3>
                        <p>Reserved under: <?= htmlspecialchars($r['full_name']); ?> (<?= htmlspecialchars($r['phone']); ?>)</p>
                    </div>
                    <div class="order-status" style="text-align: right;">
                        <span class="status-pill" style="background:#1A120E; color:#FDFBF7;">LOCKED IN</span>
                        <span class="date-highlight"><?= date('F j, Y', strtotime($r['reservation_date'])); ?></span>
                        <p style="color:var(--text-secondary); margin-top:5px; font-size:0.85rem; margin-bottom: 10px;"><?= htmlspecialchars($r['reservation_time']); ?></p>
                        <a href="view_receipt.php?type=reservation&id=<?= $r['id'] ?>" style="font-size:0.85rem; color:var(--accent); text-decoration:none; border:1px solid var(--accent); padding:4px 10px; border-radius:4px; display:inline-block;">Download Receipt</a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="color:var(--text-secondary); font-style:italic;">You have not secured any exclusive diner tables yet.</p>
            <br>
            <a href="restaurant.php" class="btn-book">Reserve a Table</a>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

</body>
</html>
<?php $conn->close(); ?>
