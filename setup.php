<?php
// === Database Credentials ===
$servername = "localhost";
$username = "admin";       // Dedicated database user to bypass root restrictions
$password = "admin";       // Dedicated database password


// 1. Establish initial connection to MySQL Server
$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 2. Create the Database if it doesn't exist
$sql_db = "CREATE DATABASE IF NOT EXISTS royal_rituals";
if ($conn->query($sql_db) === TRUE) {
    echo "✅ Database 'royal_rituals' is ready.<br>";
} else {
    echo "❌ Error creating database: " . $conn->error . "<br>";
}

// 3. Connect to the new database
$conn->select_db("royal_rituals");

// 4. Create the USERS table
$sql_users = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql_users) === TRUE) {
    echo "✅ Table 'users' successfully created.<br>";
} else {
    echo "❌ Error creating users table: " . $conn->error . "<br>";
}

// 5. Create the ADMINS table
$sql_admins = "CREATE TABLE IF NOT EXISTS admins (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql_admins) === TRUE) {
    echo "✅ Table 'admins' successfully created.<br>";
    // Insert a default admin if not exists
    $admin_email = 'admin@royalrituals.com';
    $admin_pass = password_hash('admin123', PASSWORD_DEFAULT);
    $conn->query("INSERT IGNORE INTO admins (name, email, password) VALUES ('Super Admin', '$admin_email', '$admin_pass')");
} else {
    echo "❌ Error creating admins table: " . $conn->error . "<br>";
}

// 6. Create the BOOKINGS table
$sql_bookings = "CREATE TABLE IF NOT EXISTS bookings (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT(6) NOT NULL,
    event_type VARCHAR(100),
    theme VARCHAR(255),
    meals TEXT,
    full_name VARCHAR(100),
    phone VARCHAR(20),
    event_date DATE,
    event_time VARCHAR(50),
    guests INT,
    total_amount DECIMAL(10,2),
    downpayment DECIMAL(10,2),
    razorpay_payment_id VARCHAR(100),
    status VARCHAR(50) DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql_bookings) === TRUE) {
    echo "✅ Table 'bookings' successfully created.<br>";
} else {
    echo "❌ Error creating bookings table: " . $conn->error . "<br>";
}

// 7. Create the RESERVATIONS table
$sql_reservations = "CREATE TABLE IF NOT EXISTS reservations (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT(6) NOT NULL,
    full_name VARCHAR(100),
    phone VARCHAR(20),
    reservation_date DATE,
    reservation_time VARCHAR(50),
    party_size INT,
    razorpay_payment_id VARCHAR(100),
    status VARCHAR(50) DEFAULT 'Confirmed',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql_reservations) === TRUE) {
    echo "✅ Table 'reservations' successfully created.<br>";
} else {
    echo "❌ Error creating reservations table: " . $conn->error . "<br>";
}

echo "<br><h3>🎉 All tables successfully created! Database is fully setup.</h3>";
echo "<p><strong>Default Admin Login:</strong> admin@royalrituals.com / admin123</p>";
echo "<p>You should DELETE this file (setup.php) after running it once for security purposes.</p>";

$conn->close();
?>
