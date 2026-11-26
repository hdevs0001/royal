<?php 
session_start(); 
$event = isset($_GET['event']) ? htmlspecialchars($_GET['event']) : 'Ceremony';

// Magnificent Indian Event Showcases mapped to 12 Local High-Octane Assets
$galleries = [
    'The Grand Shaadi' => [
        'assets/images/shaadi.png',
        'assets/images/shaadi_mehndi.png',
        'assets/images/shaadi_haldi.png',
        'assets/images/shaadi_reception.png',
        'assets/images/shaadi_details.png',
        'assets/images/diner.png'
    ],
    'Birthday Celebrations' => [
        'assets/images/birthday.png',
        'assets/images/birthday_cake.png',
        'assets/images/birthday_decor.png',
        'assets/images/birthday_kids.png',
        'assets/images/birthday_gifts.png',
        'assets/images/birthday_dance.png'
    ],
    'Live Concerts' => [
        'assets/images/concert.png',
        'assets/images/concert_dj.png',
        'assets/images/concert_crowd.png',
        'assets/images/concert_stage_wide.png',
        'assets/images/concert_singer.png',
        'assets/images/concert.png'
    ],
    'Destination Events' => [
        'assets/images/shaadi_reception.png', // Beautiful majestic palace fallback
        'assets/images/shaadi.png',
        'assets/images/shaadi_details.png',
        'assets/images/shaadi_mehndi.png',
        'assets/images/shaadi_haldi.png',
        'assets/images/diner.png'
    ]
];

$images = isset($galleries[$event]) ? $galleries[$event] : $galleries['The Grand Shaadi'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $event; ?> Showcase | Royal Rituals</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
<style>
.gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
    padding: 0 5%;
    max-width: 1400px;
    margin: 0 auto;
}
.gallery-item {
    overflow: hidden;
    border-radius: 12px;
    box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    height: 350px;
}
.gallery-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
}
.gallery-item:hover img {
    transform: scale(1.08);
}
.cta-box {
    text-align: center;
    margin: 80px 0;
}
</style>
</head>
<body>

<?php include 'includes/header.php'; ?>

<section class="hero" style="padding-bottom: 30px;">
  <div class="hero-content">
    <h1 style="font-size: 3.5rem;">Unforgettable <span style="font-style: italic; color: var(--accent);"><?php echo $event; ?>s</span></h1>
    <?php if ($event === 'The Grand Shaadi'): ?>
      <p>We honor the deep-rooted sanctity and majestic scale of Indian weddings. Explore the exquisite and vibrant details from some of our most celebrated shaadi moments crafted across the country.</p>
    <?php elseif ($event === 'Birthday Celebrations'): ?>
      <p>From intimate family gatherings to massive milestone blowouts, explore how we engineer unforgettable birthday spectacles tailored perfectly to you.</p>
    <?php elseif ($event === 'Live Concerts'): ?>
      <p>Experience the electrifying atmosphere of our live events. Magnificent staging, elite audio-visual lighting, and comprehensive crowd control for massive performances.</p>
    <?php else: ?>
      <p>Explore the exquisite and vibrant details from some of our most celebrated <?php echo strtolower($event); ?> moments crafted across the country.</p>
    <?php endif; ?>
  </div>
</section>

<div class="gallery-grid">
  <?php foreach($images as $img): ?>
    <div class="gallery-item">
      <img src="<?php echo $img; ?>" alt="<?php echo $event; ?> Moment">
    </div>
  <?php endforeach; ?>
</div>

<div class="cta-box">
  <h2 class="title" style="font-size: 2.2rem; margin-bottom: 20px;">Ready to create your own legacy?</h2>
  <a href="booking.php?event=<?php echo urlencode($event); ?>" class="btn">Secure Your <?php echo $event; ?></a>
</div>

<?php include 'includes/footer.php'; ?>

</body>
</html>
