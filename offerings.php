<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Royal Offerings | Indian Wedding Services</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
<style>
.offerings-section { padding: 80px 5%; max-width: 1200px; margin: 0 auto; }
.offering-block { display: flex; align-items: center; gap: 40px; margin-bottom: 80px; }
.offering-block:nth-child(even) { flex-direction: row-reverse; }
.offering-img { flex: 1; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(44, 30, 22, 0.1); }
.offering-img img { width: 100%; height: 400px; object-fit: cover; }
.offering-content { flex: 1; }
.offering-content h3 { font-size: 2.2rem; margin-bottom: 15px; color: var(--text-primary); }
.offering-content p { color: var(--text-secondary); font-size: 1.1rem; margin-bottom: 25px; }

@media(max-width: 768px) {
  .offering-block, .offering-block:nth-child(even) { flex-direction: column; }
  .offering-img img { height: 250px; }
}
</style>
</head>
<body>

<?php include 'includes/header.php'; ?>

<section class="hero" style="padding-bottom: 40px;">
  <div class="hero-content">
    <h1>Our <span style="font-style: italic; color: var(--accent);">Heritage Offerings</span></h1>
    <p>A comprehensive gateway into the majestic ceremonies we engineer. From vibrant morning rituals to palatial evening receptions, we honor every sacred step of the Indian wedding sequence.</p>
  </div>
</section>

<div class="offerings-section">

  <div class="offering-block">
    <div class="offering-img">
      <img src="assets/images/shaadi.png" alt="The Grand Shaadi">
    </div>
    <div class="offering-content">
      <h3>The Grand Shaadi</h3>
      <p>Our flagship offering encompassing every vibrant tradition from the intimate Haldi and electrifying Sangeet & Mehndi, to the breathtaking bespoke Mandap and the flawless Baraat procession. We engineer a divine and comprehensive wedding experience.</p>
      <a href="booking.php?event=The%20Grand%20Shaadi" class="btn">Book the Shaadi</a>
    </div>
  </div>

  <div class="offering-block">
    <div class="offering-img">
      <img src="assets/images/birthday.png" alt="Birthday Celebrations">
    </div>
    <div class="offering-content">
      <h3>Birthday Celebrations</h3>
      <p>Transform your special day into a majestic milestone. From intricate themed setups to lavish catering and premium entertainment, we ensure your birthday is a spectacular celebration curated just for you.</p>
      <a href="booking.php?event=Birthday%20Celebrations" class="btn">Plan a Birthday</a>
    </div>
  </div>

  <div class="offering-block">
    <div class="offering-img">
      <img src="assets/images/concert.png" alt="Live Concerts">
    </div>
    <div class="offering-content">
      <h3>Live Concerts</h3>
      <p>Experience the thrill of a live musical extravaganza. We provide world-class stage setups, acoustic engineering, and stunning visual effects to host top-tier artists and create unforgettable concert nights.</p>
      <a href="booking.php?event=Live%20Concerts" class="btn">Book a Concert</a>
    </div>
  </div>

  <div class="offering-block">
    <div class="offering-img">
      <img src="assets/images/diner.png" alt="Royal Restaurant">
    </div>
    <div class="offering-content">
      <h3>Royal Restaurant</h3>
      <p>Indulge in an exclusive, regal dining experience. Complete with Maharaja table settings, bespoke menu curation, and atmospheric ambience to transport you and your guests to an era of royal splendor.</p>
      <a href="restaurant.php" class="btn">Reserve Royal Restaurant</a>
    </div>
  </div>

</div>

<div class="offerings-section" style="padding-top: 0;">
  <h3 style="font-family: 'Playfair Display', serif; font-size: 2.2rem; margin-bottom: 20px; text-align: center; color: var(--text-primary);">Exclusive Culinary Packages</h3>
  <p style="text-align: center; color: var(--text-secondary); margin-bottom: 60px;">Our masterfully crafted native and global buffets. Priced transparently per individual Thali/Plate to ensure elite dining standards for your extravaganza.</p>
  
  <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; text-align: center;">
    
    <div style="background: var(--card-bg); padding: 30px 20px; border-radius: 12px; border: 1px solid var(--border-color); box-shadow: 0 10px 20px rgba(0,0,0,0.05);">
      <h4 style="font-family: 'Playfair Display', serif; font-size: 1.6rem; color: var(--accent); margin-bottom: 10px;">Bronze Buffet</h4>
      <h3 style="font-size: 2rem; color: var(--text-primary); margin-bottom: 15px;">₹1,500 <span style="font-size: 1rem; font-weight: normal; color: var(--text-secondary);">/ plate</span></h3>
      <p style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.5;">A robust selection of classic local delicacies and fundamental heritage dishes.</p>
    </div>
    
    <div style="background: var(--card-bg); padding: 30px 20px; border-radius: 12px; border: 1px solid var(--accent); box-shadow: 0 10px 20px rgba(192, 133, 82, 0.1);">
      <h4 style="font-family: 'Playfair Display', serif; font-size: 1.6rem; color: var(--accent); margin-bottom: 10px;">Silver Buffet</h4>
      <h3 style="font-size: 2rem; color: var(--text-primary); margin-bottom: 15px;">₹2,000 <span style="font-size: 1rem; font-weight: normal; color: var(--text-secondary);">/ plate</span></h3>
      <p style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.5;">Expanded luxury mains, interactive live food stations, and elevated royal desserts.</p>
    </div>

    <div style="background: var(--card-bg); padding: 30px 20px; border-radius: 12px; border: 1px solid var(--accent); box-shadow: 0 10px 20px rgba(192, 133, 82, 0.1);">
      <h4 style="font-family: 'Playfair Display', serif; font-size: 1.6rem; color: var(--accent); margin-bottom: 10px;">Golden Buffet</h4>
      <h3 style="font-size: 2rem; color: var(--text-primary); margin-bottom: 15px;">₹3,000 <span style="font-size: 1rem; font-weight: normal; color: var(--text-secondary);">/ plate</span></h3>
      <p style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.5;">Extravagant global multi-cuisine layouts featuring true Maharaja Thali plating.</p>
    </div>

    <div style="background: var(--card-bg); padding: 30px 20px; border-radius: 12px; border: 1px solid var(--border-color); box-shadow: 0 10px 20px rgba(0,0,0,0.05);">
      <h4 style="font-family: 'Playfair Display', serif; font-size: 1.6rem; color: var(--accent); margin-bottom: 10px;">Diamond Buffet</h4>
      <h3 style="font-size: 2rem; color: var(--text-primary); margin-bottom: 15px;">₹3,700 <span style="font-size: 1rem; font-weight: normal; color: var(--text-secondary);">/ plate</span></h3>
      <p style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.5;">The pinnacle of gastronomy. Bespoke, imported ingredients and absolute exclusivity.</p>
    </div>

  </div>
</div>

<div class="offerings-section" style="padding-top: 20px; border-top: 1px solid var(--border-color); margin-top: 40px;">
  <h3 style="font-family: 'Playfair Display', serif; font-size: 2.2rem; margin-bottom: 20px; text-align: center; color: var(--text-primary);">Decor & Theme Tiers</h3>
  
  <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; text-align: center;">
    <div style="background: var(--card-bg); padding: 30px 20px; border-radius: 12px; border: 1px solid var(--border-color);">
      <h4 style="font-family: 'Playfair Display', serif; font-size: 1.6rem; color: var(--text-primary); margin-bottom: 10px;">Classic Elegance</h4>
      <h3 style="font-size: 2rem; color: var(--accent); margin-bottom: 15px;">+ ₹50,000</h3>
      <p style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.5;">Our standard yet beautiful heritage decor setup, utilizing synthetic florals and elegant structural draping.</p>
    </div>
    
    <div style="background: var(--card-bg); padding: 30px 20px; border-radius: 12px; border: 1px solid var(--accent);">
      <h4 style="font-family: 'Playfair Display', serif; font-size: 1.6rem; color: var(--text-primary); margin-bottom: 10px;">Regal Splendor</h4>
      <h3 style="font-size: 2rem; color: var(--accent); margin-bottom: 15px;">+ ₹1,00,000</h3>
      <p style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.5;">Upgraded aesthetic featuring premium natural florals, velvet accents, and advanced lighting architecture.</p>
    </div>

    <div style="background: var(--card-bg); padding: 30px 20px; border-radius: 12px; border: 1px solid var(--accent); box-shadow: 0 10px 20px rgba(192, 133, 82, 0.1);">
      <h4 style="font-family: 'Playfair Display', serif; font-size: 1.6rem; color: var(--text-primary); margin-bottom: 10px;">Maharaja Extravaganza</h4>
      <h3 style="font-size: 2rem; color: var(--accent); margin-bottom: 15px;">+ ₹2,50,000</h3>
      <p style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.5;">The ultimate royal treatment. Imported exotic florals, architectural mandaps, and bespoke crystal chandeliers.</p>
    </div>
  </div>
</div>

<div class="offerings-section" style="padding-top: 20px; border-top: 1px solid var(--border-color); margin-top: 20px;">
  <h3 style="font-family: 'Playfair Display', serif; font-size: 2.2rem; margin-bottom: 20px; text-align: center; color: var(--text-primary);">Pre-Wedding Ceremonies</h3>
  
  <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; text-align: center; max-width: 800px; margin: 0 auto;">
    <div style="background: var(--card-bg); padding: 30px 20px; border-radius: 12px; border: 1px solid var(--border-color);">
      <h4 style="font-family: 'Playfair Display', serif; font-size: 1.6rem; color: var(--text-primary); margin-bottom: 10px;">The Haldi Ceremony</h4>
      <h3 style="font-size: 2rem; color: var(--accent); margin-bottom: 15px;">₹75,000</h3>
      <p style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.5;">A deeply traditional daytime event featuring yellow marigold setups, brass urns, and native folk entertainment.</p>
    </div>
    
    <div style="background: var(--card-bg); padding: 30px 20px; border-radius: 12px; border: 1px solid var(--border-color);">
      <h4 style="font-family: 'Playfair Display', serif; font-size: 1.6rem; color: var(--text-primary); margin-bottom: 10px;">Sangeet & Mehndi</h4>
      <h3 style="font-size: 2rem; color: var(--accent); margin-bottom: 15px;">₹1,50,000</h3>
      <p style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.5;">A grand vibrant evening with a dedicated dance floor, acoustic engineering, and elite Mehndi artists.</p>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>

</body>
</html>
