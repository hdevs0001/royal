<?php
session_start();
$pre_selected_event = isset($_GET['event']) ? htmlspecialchars($_GET['event']) : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reserve Your Indian Event | Royal Rituals</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
<style>
/* Custom Radio Image Selectors */
.event-options { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 15px; margin-bottom: 25px; }
.event-option { position: relative; border: 1px solid var(--border-color); border-radius: 12px; overflow: hidden; cursor: pointer; transition: all 0.3s ease; }
.event-option input[type="radio"] { display: none; }
.event-option img { width: 100%; height: 120px; object-fit: cover; filter: sepia(0.2); transition: 0.3s; }
.event-option .label-text { padding: 12px; text-align: center; font-weight: 600; background: var(--card-bg); font-size: 14px;}
.event-option input[type="radio"]:checked + .option-content { border-color: var(--accent); box-shadow: 0 0 0 2px var(--accent); }
.event-option input[type="radio"]:checked + .option-content img { filter: sepia(0); transform: scale(1.05); }
.option-content { width: 100%; height: 100%; border: 2px solid transparent; border-radius: 12px; transition: 0.3s; overflow: hidden; }

/* Custom Chips for Selections */
.chip-group { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 5px; }
.chip-label { position: relative; cursor: pointer; user-select: none; }
.chip-label input { display: none; }
.chip-btn { display: inline-block; padding: 10px 18px; border: 1px solid var(--border-color); border-radius: 8px; background: var(--card-bg); color: var(--text-primary); transition: 0.3s; font-size: 0.95rem; font-weight: 500;}
.chip-label input:checked + .chip-btn { background: var(--accent); color: #1A120E; border-color: var(--accent); }
</style>
</head>

<body>

<?php include 'includes/header.php'; ?>

<div class="container">
  <h2 class="title" style="margin-bottom: 20px;">Secure Your Extravaganza</h2>
  <p style="text-align: center; color: var(--text-secondary); margin-bottom: 40px; font-size: 1.1rem;">Submit your foundational details so our master architects can begin planning your monumental Indian event.</p>

  <?php if(!isset($_SESSION['user_id'])): ?>
    <div class="auth-block">
      <p>Luxury events require a dedicated client profile. Please log in or establish a legacy with us to continue.</p>
      <div style="display: flex; gap: 20px; justify-content: center; margin-top: 20px;">
        <a href="auth/login.php" class="btn">Log In Here</a>
        <a href="auth/signup.php" class="btn" style="background:transparent; border:1px solid var(--text-primary); color:var(--text-primary);">Create Account</a>
      </div>
    </div>
  <?php else: ?>

  <form action="save_event.php" method="POST">
    
    <div class="form-group">
      <label>Select Ceremony Type</label>
      <div class="event-options">

        <label class="event-option">
          <input type="radio" name="event_type" value="The Grand Shaadi" required>
          <div class="option-content">
            <img src="assets/images/shaadi.png" alt="Grand Shaadi">
            <div class="label-text">The Grand Shaadi</div>
          </div>
        </label>

        <label class="event-option">
          <input type="radio" name="event_type" value="Birthday Celebrations">
          <div class="option-content">
            <img src="assets/images/birthday.png" alt="Birthday Celebration">
            <div class="label-text">Birthday Celebrations</div>
          </div>
        </label>

        <label class="event-option">
          <input type="radio" name="event_type" value="Live Concerts">
          <div class="option-content">
            <img src="assets/images/concert.png" alt="Live Concerts">
            <div class="label-text">Live Concerts</div>
          </div>
        </label>



      </div>
    </div>

    <input type="hidden" name="theme" id="theme_hidden" value="Standard Heritage">

    <div class="form-group hidden" id="theme_section_shaadi">
      <label>Shaadi Decor Focus</label>
      <select onchange="updateTheme(this)">
        <option value="">-- Choose Decor Tier --</option>
        <option value="Classic Elegance (Basic)">Classic Elegance (Basic)</option>
        <option value="Regal Splendor (Advanced)">Regal Splendor (Advanced)</option>
        <option value="Maharaja Extravaganza (Premium)">Maharaja Extravaganza (Premium)</option>
      </select>

      <div style="margin-top: 20px; background: rgba(192, 133, 82, 0.05); padding: 15px; border-radius: 8px; border: 1px dotted rgba(192, 133, 82, 0.4);">
        <label style="font-size: 0.95rem; margin-bottom: 12px; color: var(--accent);">Include Pre-Wedding Ceremonies?</label>
        <label style="display: flex; align-items: center; gap: 8px; font-weight: 500; font-size: 0.95rem; user-select: none; margin-bottom: 10px; cursor: pointer; color: var(--text-primary);">
          <input type="checkbox" name="addons[]" value="Haldi Ceremony" style="width: auto;"> Host Haldi Ceremony
        </label>
        <label style="display: flex; align-items: center; gap: 8px; font-weight: 500; font-size: 0.95rem; user-select: none; cursor: pointer; color: var(--text-primary);">
          <input type="checkbox" name="addons[]" value="Sangeet & Mehndi" style="width: auto;"> Host Sangeet & Mehndi Night
        </label>
      </div>
    </div>

    <div class="form-group hidden" id="theme_section_sangeet">
      <label>Sangeet Vibe</label>
      <select onchange="updateTheme(this)">
        <option value="">-- Choose Vibe --</option>
        <option value="Modern Bollywood">Modern Bollywood Glitter</option>
        <option value="Sufi Night">Sufi Qawwali Evening</option>
        <option value="Neon Desi">Neon Desi Fusion</option>
      </select>
    </div>

    <div class="form-group">
      <label>Culinary Package (Select One)</label>
      <div class="chip-group">
        <label class="chip-label">
          <input type="radio" name="meals[]" value="Bronze Buffet" required>
          <div class="chip-btn">Bronze Buffet</div>
        </label>
        <label class="chip-label">
          <input type="radio" name="meals[]" value="Silver Buffet">
          <div class="chip-btn">Silver Buffet</div>
        </label>
        <label class="chip-label">
          <input type="radio" name="meals[]" value="Golden Buffet">
          <div class="chip-btn">Golden Buffet</div>
        </label>
        <label class="chip-label">
          <input type="radio" name="meals[]" value="Diamond Buffet">
          <div class="chip-btn">Diamond Buffet</div>
        </label>
      </div>
    </div>

    <div class="form-group">
      <label for="guests">Estimated Guest Count</label>
      <input type="number" id="guests" name="guests" min="50" placeholder="e.g. 500" required>
    </div>

    <div class="row-2">
      <div class="form-group">
        <label for="date">Event Date</label>
        <input type="date" id="date" name="date" required>
      </div>

      <div class="form-group">
        <label for="time">Muhurat / Time</label>
        <select id="time" name="time" required>
          <option value="">-- Select --</option>
          <option value="Auspicious Morning">Auspicious Morning Dawn</option>
          <option value="Sunny Afternoon">Sunny Afternoon</option>
          <option value="Evening Dusk">Evening Dusk Launch</option>
          <option value="Late Night Phere">Late Night Phere Setup</option>
        </select>
      </div>
    </div>

    <hr style="border: 0; border-top: 1px dashed var(--border-color); margin: 10px 0;">

    <div class="row-2">
      <div class="form-group">
        <label for="name">Your Name</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($_SESSION['user_name']); ?>" required>
      </div>

      <div class="form-group">
        <label for="phone">Indian Phone Number</label>
        <input type="tel" id="phone" name="phone" placeholder="+91 XXXXX XXXXX" required>
      </div>
    </div>

    <div id="order_summary" style="display: none; background: rgba(192, 133, 82, 0.05); padding: 20px; border-radius: 8px; border: 1px solid rgba(192, 133, 82, 0.3); margin-top: 20px; margin-bottom: 25px;">
      <h3 style="color: var(--accent); margin-bottom: 15px; font-size: 1.2rem;">Extravaganza Pricing & Deposit</h3>
      <table style="width: 100%; text-align: left; font-size: 0.95rem; border-collapse: collapse;">
         <tr><td style="padding: 5px 0;">Base Ceremony Fee:</td><td style="text-align: right;" id="sum_base">₹ 0</td></tr>
         <tr><td style="padding: 5px 0;">Culinary Cost (<span id="sum_guests">0</span> Guests):</td><td style="text-align: right;" id="sum_meals">₹ 0</td></tr>
         <tr><td style="padding: 5px 0;">Decor & Theme Upgrade:</td><td style="text-align: right;" id="sum_theme">₹ 0</td></tr>
         <tr><td style="padding: 5px 0;">Included Add-ons:</td><td style="text-align: right;" id="sum_addons">₹ 0</td></tr>
         <tr style="border-top: 1px dashed var(--border-color); font-weight: bold; color: var(--accent);">
            <td style="padding: 10px 0;">Total Extravaganza Estimate:</td><td style="text-align: right; font-size: 1.1rem;" id="sum_total">₹ 0</td>
         </tr>
         <tr style="font-weight: 600; color: #1A120E; background: var(--accent);">
            <td style="padding: 10px;">Required 5% Downpayment:</td><td style="text-align: right; padding: 10px; font-size: 1.1rem;" id="sum_downpayment">₹ 0</td>
         </tr>
      </table>
    </div>

    <!-- Hidden Fields for Database & Verification -->
    <input type="hidden" name="total_amount" id="total_amount" value="0">
    <input type="hidden" name="downpayment" id="downpayment" value="0">
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" value="">

    <button type="button" id="pay-btn" class="btn" style="width:100%; background: var(--accent); color: #1A120E;">Pay 5% Deposit & Confirm Planning</button>
  </form>
  
  <?php endif; ?>

</div>

<!-- Razorpay Core -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
  const pricing = {
      base: {
          'The Grand Shaadi': 500000,
          'Birthday Celebrations': 150000,
          'Live Concerts': 300000
      },
      themes: {
          'Classic Elegance (Basic)': 50000,
          'Regal Splendor (Advanced)': 100000,
          'Maharaja Extravaganza (Premium)': 250000
      },
      meals: {
          'Bronze Buffet': 1500,
          'Silver Buffet': 2000,
          'Golden Buffet': 3000,
          'Diamond Buffet': 3700
      },
      addons: {
          'Haldi Ceremony': 75000,
          'Sangeet & Mehndi': 150000
      }
  };

  let finalDownpayment = 0;

  function calculateTotal() {
      let total = 0;
      let eventType = document.querySelector('input[name="event_type"]:checked')?.value;
      if (eventType && pricing.base[eventType]) {
          total += pricing.base[eventType];
          document.getElementById('sum_base').innerText = '₹ ' + pricing.base[eventType].toLocaleString();
      }

      let themeValue = document.getElementById("theme_hidden").value;
      let themeTotal = 0;
      if (themeValue && pricing.themes && pricing.themes[themeValue]) {
          themeTotal = pricing.themes[themeValue];
      }
      total += themeTotal;
      document.getElementById('sum_theme').innerText = '₹ ' + themeTotal.toLocaleString();

      let mealsBoxes = document.querySelectorAll('input[name="meals[]"]:checked');
      let guestsCount = parseInt(document.getElementById('guests').value) || 0;
      let mealTotal = 0;
      mealsBoxes.forEach(box => {
          if (pricing.meals[box.value]) {
              mealTotal += pricing.meals[box.value] * guestsCount;
          }
      });
      total += mealTotal;
      document.getElementById('sum_guests').innerText = guestsCount;
      document.getElementById('sum_meals').innerText = '₹ ' + mealTotal.toLocaleString();

      let addonTotal = 0;
      let addons = document.querySelectorAll('input[name="addons[]"]:checked');
      addons.forEach(box => {
          if(pricing.addons[box.value]) addonTotal += pricing.addons[box.value];
      });
      total += addonTotal;
      document.getElementById('sum_addons').innerText = '₹ ' + addonTotal.toLocaleString();

      document.getElementById('sum_total').innerText = '₹ ' + total.toLocaleString();

      finalDownpayment = Math.round(total * 0.05);
      document.getElementById('sum_downpayment').innerText = '₹ ' + finalDownpayment.toLocaleString();

      document.getElementById('total_amount').value = total;
      document.getElementById('downpayment').value = finalDownpayment;

      // Check if all primary required fields are filled out
      let formFilled = mealsBoxes.length > 0 && guestsCount > 0 && 
                       document.getElementById('date').value && 
                       document.getElementById('time').value && 
                       document.getElementById('name').value && 
                       document.getElementById('phone').value;

      let payBtn = document.getElementById('pay-btn');

      if(total > 0 && eventType && formFilled) {
          document.getElementById('order_summary').style.display = 'block';
          if(payBtn) {
              payBtn.innerText = 'Pay 5% Deposit (₹ ' + finalDownpayment.toLocaleString() + ') & Confirm Planning';
          }
      } else {
          document.getElementById('order_summary').style.display = 'none';
          if(payBtn) {
              payBtn.innerText = 'Complete Form to Unlock Pricing & Deposit';
          }
      }
  }

  function updateTimeOptions() {
    const eventType = document.querySelector('input[name="event_type"]:checked')?.value;
    const timeSelect = document.getElementById('time');
    const timeLabel = document.querySelector('label[for="time"]');
    
    let options = '<option value="">-- Select --</option>';
    let label = 'Event Time';
    
    if (eventType === 'The Grand Shaadi') {
      label = 'Muhurat / Time';
      options += '<option value="Auspicious Morning">Auspicious Morning Dawn</option>';
      options += '<option value="Sunny Afternoon">Sunny Afternoon</option>';
      options += '<option value="Evening Dusk">Evening Dusk Launch</option>';
      options += '<option value="Late Night Phere">Late Night Phere Setup</option>';
    } else if (eventType === 'Birthday Celebrations') {
      label = 'Party Time';
      options += '<option value="Morning Party">Morning Breakfast Party</option>';
      options += '<option value="Afternoon Brunch">Afternoon Brunch</option>';
      options += '<option value="Evening Bash">Evening Bash</option>';
      options += '<option value="Late Night Party">Late Night Party</option>';
    } else if (eventType === 'Live Concerts') {
      label = 'Show Time';
      options += '<option value="Afternoon Event">Afternoon Soundcheck / Event</option>';
      options += '<option value="Evening Show">Main Evening Show</option>';
      options += '<option value="Late Night Concert">Late Night Concert</option>';
    } else {
      label = 'Event Time';
      options += '<option value="Morning">Morning</option>';
      options += '<option value="Afternoon">Afternoon</option>';
      options += '<option value="Evening">Evening</option>';
      options += '<option value="Late Night">Late Night</option>';
    }
    
    timeLabel.innerText = label;
    timeSelect.innerHTML = options;
  }

  document.addEventListener('DOMContentLoaded', () => {
    // Attach Realtime Calculation Listeners
    const formInputs = document.querySelectorAll('input, select');
    formInputs.forEach(el => el.addEventListener('change', calculateTotal));
    formInputs.forEach(el => el.addEventListener('keyup', calculateTotal));

    const eventRadios = document.querySelectorAll('input[name="event_type"]');
    eventRadios.forEach(radio => {
      radio.addEventListener('change', () => {
        updateTimeOptions();
        
        if (radio.value === 'The Grand Shaadi') {
           showTheme('shaadi');
        } else {
           showTheme('other');
        }
      });
    });
    
    if(document.querySelector('input[name="event_type"]:checked')) {
       updateTimeOptions();
       if(document.querySelector('input[name="event_type"]:checked').value === 'The Grand Shaadi') {
           showTheme('shaadi');
       }
    }
  });

  function showTheme(eventType) {
    const keys = ['shaadi', 'sangeet', 'haldi', 'reception', 'other'];
    keys.forEach(k => {
      let el = document.getElementById("theme_section_" + k);
      if (el) {
        el.classList.add("hidden");
        let selectEl = el.querySelector('select');
        if(selectEl) selectEl.value = ""; 
      }
    });

    let activeEl = document.getElementById("theme_section_" + eventType);
    if(activeEl) {
       activeEl.classList.remove("hidden");
    }
    document.getElementById("theme_hidden").value = ""; 
    calculateTotal();
  }

  function updateTheme(selectObj) {
    document.getElementById("theme_hidden").value = selectObj.value;
    calculateTotal();
  }

  // Razorpay Checkout Injection
  let payBtn = document.getElementById('pay-btn');
  if(payBtn) {
    payBtn.onclick = function(e) {
        let form = document.querySelector('form');
        if(!form.checkValidity()){
            form.reportValidity();
            return;
        }

        if(finalDownpayment <= 0) {
            alert("Your calculated deposit is zero. Please fill out your preferences to compute the total.");
            return;
        }
        
        var options = {
            "key": "rzp_test_SVzhklc6PvHQFX", 
            "amount": finalDownpayment * 100, // paise converter
            "currency": "INR",
            "name": "Royal Rituals",
            "description": "5% Extravaganza Downpayment",
            "image": "assets/images/logo.png",
            "handler": function (response) {
                document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                form.submit();
            },
            "prefill": {
                "name": document.getElementById('name').value,
                "contact": document.getElementById('phone').value
            },
            "theme": {
                "color": "#C08552"
            }
        };
        var rzp = new Razorpay(options);
        
        rzp.on('payment.failed', function (response){
            alert("Payment Failed! " + response.error.description);
        });
        
        rzp.open();
        e.preventDefault();
    };
  }
</script>

<?php include 'includes/footer.php'; ?>

</body>
</html>