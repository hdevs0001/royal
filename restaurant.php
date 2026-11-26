<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Royal Diner | Awadhi & Mughlai Cuisine</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css?v=<?= time(); ?>">
<style>
/* Local Overrides for Diner Atmosphere */
.diner a:hover { background: var(--accent) !important; color: #ffffff !important; border-color: var(--accent) !important; }
body {
    background-color: #1A120E; 
    color: #FDFBF7;
}
header {
    background: rgba(26, 18, 14, 0.9);
    border-bottom: 1px solid rgba(234, 222, 203, 0.1);
    --text-primary: #FDFBF7;
    --text-secondary: rgba(253, 251, 247, 0.7);
    --border-color: rgba(234, 222, 203, 0.3);
    --bg-color: #1A120E;
}
.logo, h1, h2, h3, nav a:hover, nav a.active { color: #FDFBF7; }
nav a { color: rgba(253, 251, 247, 0.7); }
.hero { padding: 180px 5% 80px; }
.hero h1 { color: #FDFBF7; font-size: 4rem; }
.hero p { color: rgba(253, 251, 247, 0.8); }

.gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 30px;
    padding: 0 5% 80px;
    max-width: 1400px;
    margin: 0 auto;
}
.dish-card {
    border-radius: 12px;
    overflow: hidden;
    position: relative;
    height: 450px;
}
.dish-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.8s ease;
    filter: brightness(0.85);
}
.dish-card:hover img {
    transform: scale(1.05);
    filter: brightness(1);
}
.dish-info {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    padding: 40px 30px 30px;
    background: linear-gradient(to top, rgba(26,18,14,0.95), transparent);
}
.dish-info h3 {
    font-size: 1.8rem;
    margin-bottom: 8px;
    color: var(--accent);
}
.dish-info p {
    font-family: 'Outfit', sans-serif;
    color: rgba(253, 251, 247, 0.9);
    font-size: 1.05rem;
    font-weight: 300;
}

.reservation-box {
    background: #251B15;
    padding: 80px 5%;
    text-align: center;
    border-top: 1px solid rgba(234, 222, 203, 0.1);
}
.reservation-box .btn {
    background: var(--accent);
    color: #fff;
    border: none;
    margin-top: 30px;
}
.reservation-box .btn:hover {
    background: #A66E40; /* darker gold */
    color: #fff;
}
footer {
    background: #110C09;
    margin-top: 0;
    border-top: 1px solid rgba(234, 222, 203, 0.05);
}
</style>
</head>
<body>

<?php include 'includes/header.php'; ?>

<section class="hero">
  <div class="hero-content">
    <h1>Flavors of <br><span style="font-style: italic; color: var(--accent);">The Native Maharajas</span></h1>
    <p style="margin-bottom: 15px;">Welcome to the Royal Restaurant. Immerse yourself in an unparalleled Royal Awadhi and Mughlai dining experience where world-class Indian gastronomy meets atmospheric intimacy.</p>
    <div style="display: inline-block; padding: 10px 25px; border: 1px solid var(--accent); border-radius: 30px; font-weight: 500; font-size: 0.95rem; color: #FDFBF7; background: rgba(192, 133, 82, 0.1); margin-top: 10px;">
      📍 #121, Sector 34 A, Chandigarh
    </div>
  </div>
</section>

<div class="gallery-grid">
  
  <div class="dish-card">
    <img src="assets/images/royal_thali.png" alt="Royal Thali">
    <div class="dish-info">
      <h3>The Royal Thali</h3>
      <p>A majestic brass platter serving 24 distinct, rich curries and artisan breads from across the subcontinent.</p>
    </div>
  </div>

  <div class="dish-card">
    <img src="assets/images/mughlai_kebabs.png" alt="Mughlai Kebabs">
    <div class="dish-info">
      <h3>Mughlai Kebabs</h3>
      <p>Masterfully charred and spiced artisan meats crafted in traditional clay tandoors by our Ustad Chefs.</p>
    </div>
  </div>

  <div class="dish-card">
    <img src="assets/images/awadhi_biryani.png" alt="Awadhi Biryani">
    <div class="dish-info">
      <h3>Awadhi Biryani</h3>
      <p>Dum-cooked fragrant basmati rice layered with rich saffron, caramelized onions, and slow-cooked tender meat.</p>
    </div>
  </div>

  <div class="dish-card">
    <img src="assets/images/paneer_tikka.png" alt="Paneer Tikka">
    <div class="dish-info">
      <h3>Classic Paneer Tikka</h3>
      <p>Succulent chunks of cottage cheese and bell peppers, marinated in robust native spices and slow-roasted in our traditional tandoor.</p>
    </div>
  </div>

  <div class="dish-card">
    <img src="assets/images/mithai_finales.png" alt="Desserts">
    <div class="dish-info">
      <h3>Mithai Finales</h3>
      <p>Decadent Rabri, golden Jalebis, and rich saffron infused sweets meant to leave a lingering memory.</p>
    </div>
  </div>

  <div class="dish-card">
    <img src="assets/images/artisan_spices.png" alt="Spices">
    <div class="dish-info">
      <h3>Artisan Spices</h3>
      <p>Every dish is constructed from native, hand-ground spices sourced directly from rich Indian soils.</p>
    </div>
  </div>

</div>

<div class="reservation-box">
  <h2 class="title" style="color: #FDFBF7; margin-bottom: 15px;">Secure Your Table</h2>
  <p style="color: rgba(253, 251, 247, 0.7); max-width: 600px; margin: 0 auto 40px; font-size: 1.1rem;">
    The Royal Diner features highly limited seating to ensure total privacy and immaculate service. Reserving in advance is strictly required. Let us exceed your expectations.
  </p>

  <?php if(isset($_SESSION['res_success'])): ?>
    <div style="background:var(--accent); color:#1A120E; padding:15px; border-radius:8px; display:inline-block; font-weight:600; margin-bottom:30px;">
        <?= $_SESSION['res_success']; unset($_SESSION['res_success']); ?>
    </div>
  <?php endif; ?>

  <?php if(isset($_SESSION['res_error'])): ?>
    <div style="background:#d32f2f; color:#fff; padding:15px; border-radius:8px; display:inline-block; font-weight:600; margin-bottom:30px;">
        <?= $_SESSION['res_error']; unset($_SESSION['res_error']); ?>
    </div>
  <?php endif; ?>

  <?php if(!isset($_SESSION['user_id'])): ?>
    <div class="auth-block" style="background:#110C09; border-color:var(--accent); max-width:500px; margin: 0 auto 30px;">
      <p style="color:rgba(253,251,247,0.8);">Exclusive dining requires an established profile. Please log in to secure your reservation.</p>
      <a href="auth/login.php" class="btn">Log In Profile</a>
    </div>
  <?php else: ?>
    <form id="reservation-form" action="save_reservation.php" method="POST" style="max-width: 700px; margin: 0 auto; text-align: left; background:#110C09; padding:40px; border-radius:12px; border:1px solid rgba(234,222,203,0.1);">
      
      <!-- Hidden Input to Store Razorpay Payment ID -->
      <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">

      <div class="row-2">
        <div class="form-group">
          <label style="color:#FDFBF7;">Full Name</label>
          <input type="text" id="full_name" name="full_name" value="<?= htmlspecialchars($_SESSION['user_name'] ?? ''); ?>" required style="background:#1A120E; color:#FDFBF7; border-color:rgba(234,222,203,0.2);">
        </div>
        <div class="form-group">
          <label style="color:#FDFBF7;">Phone Contact</label>
          <input type="tel" id="phone" name="phone" placeholder="Enter Phone Number" required style="background:#1A120E; color:#FDFBF7; border-color:rgba(234,222,203,0.2);">
        </div>
      </div>

      <div class="row-2">
        <div class="form-group">
          <label style="color:#FDFBF7;">Reservation Date</label>
          <input type="date" name="reservation_date" min="<?= date('Y-m-d'); ?>" required style="background:#1A120E; color:#FDFBF7; border-color:rgba(234,222,203,0.2);">
        </div>
        <div class="form-group">
          <label style="color:#FDFBF7;">Time Selection</label>
          <select name="reservation_time" required style="background:#1A120E; color:#FDFBF7; border-color:rgba(234,222,203,0.2);">
            <option value="">Select a Booking Time</option>
            <option value="12:00 PM">12:00 PM (Lunch Service)</option>
            <option value="1:00 PM">1:00 PM (Lunch Service)</option>
            <option value="2:00 PM">2:00 PM (Lunch Service)</option>
            <option value="3:00 PM">3:00 PM (Late Lunch)</option>
            <option value="6:00 PM">6:00 PM (Dinner Service)</option>
            <option value="7:00 PM">7:00 PM (Dinner Service)</option>
            <option value="8:00 PM">8:00 PM (Dinner Service)</option>
            <option value="9:00 PM">9:00 PM (Dinner Service)</option>
            <option value="10:00 PM">10:00 PM (Late Dinner)</option>
            <option value="11:00 PM">11:00 PM (Midnight Menu)</option>
          </select>
        </div>
      </div>

      <div class="form-group">
        <label style="color:#FDFBF7;">Party Size (Max 6)</label>
        <select name="party_size" required style="background:#1A120E; color:#FDFBF7; border-color:rgba(234,222,203,0.2);">
          <option value="1">1 Guest</option>
          <option value="2" selected>2 Guests</option>
          <option value="3">3 Guests</option>
          <option value="4">4 Guests</option>
          <option value="5">5 Guests</option>
          <option value="6">6 Guests</option>
        </select>
      </div>

      <div style="background: rgba(234, 222, 203, 0.05); padding: 15px; border-radius: 8px; margin-top: 20px; margin-bottom: 20px; text-align: center; border: 1px dashed rgba(234, 222, 203, 0.3);">
        <p style="color: var(--accent); font-size: 1.05rem; margin: 0; font-weight: 600;">Reservation Retainer: Rs. 200</p>
        <p style="color: rgba(253, 251, 247, 0.7); font-size: 0.85rem; margin: 5px 0 0;">A compulsory payment of Rs. 200 is required to secure your exclusive booking today.</p>
      </div>

      <button type="button" id="pay-btn" class="btn" style="width:100%; background:var(--accent); color:#1A120E;">Pay Rs. 200 & Secure Reservation</button>
    </form>
    
    <!-- Razorpay Scripts -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
      document.getElementById('pay-btn').onclick = function(e) {
          // Perform basic frontend validation before popping payment
          var form = document.getElementById('reservation-form');
          if(!form.checkValidity()){
              form.reportValidity();
              return;
          }
          
          var options = {
              "key": "rzp_test_SVzhklc6PvHQFX", // Replace with your LIVE Razorpay Key
              "amount": "20000", // 20000 paise = Rs 200
              "currency": "INR",
              "name": "Royal Rituals Diner",
              "description": "Compulsory Reservation Fee",
              "image": "assets/images/logo.png",
              "handler": function (response) {
                  // This function hits when payment succeeds
                  document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                  form.submit();
              },
              "prefill": {
                  "name": document.getElementById('full_name').value,
                  "email": "customer@example.com",
                  "contact": document.getElementById('phone').value
              },
              "theme": {
                  "color": "#C08552"
              }
          };
          var rzp = new Razorpay(options);
          
          rzp.on('payment.failed', function (response){
              alert("Payment Failed! Reason: " + response.error.description);
          });
          
          rzp.open();
          e.preventDefault();
      };
    </script>
  <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>

</body>
</html>
