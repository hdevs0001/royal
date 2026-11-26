<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Royal Rituals | Indian Wedding & Cultural Events</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<?php include 'includes/header.php'; ?>

<section class="hero">
  <div class="hero-content">
    <h1>The Grandeur of <br><span>Indian Traditions</span></h1>
    <p>We curate magnificent Big Fat Indian Weddings infused with timeless heritage, vibrant colors, and unparalleled warmth. Experience the pinnacle of Desi celebration.<br><br><span style="color: var(--accent); font-weight: 500; font-family: 'Playfair Display', serif; font-size: 1.4rem; font-style: italic;">Proudly providing our luxury services across the Tricity (Chandigarh, Mohali & Panchkula)</span></p>
    <a href="booking.php" class="btn-primary">Begin Your Journey</a>
  </div>
</section>

<section class="services-section">
  <h2 class="section-title">Our Exquisite Ceremonies</h2>
  <div class="grid">

    <a href="gallery.php?event=The Grand Shaadi" class="card-link">
      <div class="card">
        <div class="card-img-wrapper">
          <img src="assets/images/shaadi.png" alt="The Grand Shaadi">
        </div>
        <div class="card-content">
          <h3>The Grand Shaadi</h3>
          <p>The ultimate royal package seamlessly encompassing your vibrant Haldi, electrifying Sangeet & Mehndi, up to the majestic Saat Phere.</p>
        </div>
      </div>
    </a>

    <a href="gallery.php?event=Birthday Celebrations" class="card-link">
      <div class="card">
        <div class="card-img-wrapper">
          <img src="assets/images/birthday.png" alt="Birthday Celebrations">
        </div>
        <div class="card-content">
          <h3>Birthday Celebrations</h3>
          <p>From intimate family gatherings to massive milestone blowouts, we engineer unforgettable birthday spectacles tailored to you.</p>
        </div>
      </div>
    </a>

    <a href="gallery.php?event=Live Concerts" class="card-link">
      <div class="card">
        <div class="card-img-wrapper">
          <img src="assets/images/concert.png" alt="Live Concerts">
        </div>
        <div class="card-content">
          <h3>Live Concerts</h3>
          <p>Magnificent staging, elite audio-visual lighting, and comprehensive crowd control for massive, electrifying live performances.</p>
        </div>
      </div>
    </a>

  </div>
</section>

<!-- MASTER PHOTOGRAPHY PORTFOLIO -->
<section style="padding: 80px 5%; background: var(--bg-color);">
  <div style="text-align: center; margin-bottom: 50px;">
    <h2 style="font-family: 'Playfair Display', serif; font-size: 2.8rem; color: var(--primary);">Our Masterpiece Portfolio</h2>
    <p style="color: var(--text-secondary); max-width: 600px; margin: 15px auto 0;">Explore snapshots of our most extravagant ceremonies, breathtaking decor, and unforgettable live staging.</p>
  </div>
  
  <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); grid-auto-rows: 250px; gap: 15px; max-width: 1400px; margin: 0 auto;">
    
    <div style="grid-row: span 2; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 20px rgba(0,0,0,0.05);">
        <img src="assets/images/shaadi_reception.png" style="width: 100%; height: 100%; object-fit: cover;" alt="Gallery Image">
    </div>
    <div style="border-radius: 12px; overflow: hidden; box-shadow: 0 10px 20px rgba(0,0,0,0.05);">
        <img src="assets/images/birthday_decor.png" style="width: 100%; height: 100%; object-fit: cover;" alt="Gallery Image">
    </div>
    <div style="grid-row: span 2; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 20px rgba(0,0,0,0.05);">
        <img src="assets/images/concert_dj.png" style="width: 100%; height: 100%; object-fit: cover;" alt="Gallery Image">
    </div>
    <div style="grid-row: span 2; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 20px rgba(0,0,0,0.05);">
        <img src="assets/images/birthday_cake.png" style="width: 100%; height: 100%; object-fit: cover;" alt="Gallery Image">
    </div>
    <div style="border-radius: 12px; overflow: hidden; box-shadow: 0 10px 20px rgba(0,0,0,0.05);">
        <img src="assets/images/shaadi_haldi.png" style="width: 100%; height: 100%; object-fit: cover;" alt="Gallery Image">
    </div>
    <div style="border-radius: 12px; overflow: hidden; box-shadow: 0 10px 20px rgba(0,0,0,0.05);">
        <img src="assets/images/concert_stage_wide.png" style="width: 100%; height: 100%; object-fit: cover;" alt="Gallery Image">
    </div>

  </div>
</section>

<?php include 'includes/footer.php'; ?>

</body>
</html>