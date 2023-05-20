<!DOCTYPE html>
<html>
<head>
    <title>Phone Numbers</title>
</head>
<body>
    <h1>Phone Numbers</h1>
    <?php
    // Connect to the MySQL database
    $servername = "localhost";
    $username = "yourusername";
    $password = "yourpassword";
    $dbname = "phone_numbers_db";
    $conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the quantity of phone numbers to generate
$quantity = $_POST['quantity'];

// Generate the phone numbers
$prefixes = array("+234806", "+234805", "+234807", "+234809", "+234803", "+234810", "+234904", "+234815", "+234815", "+234817", "+234811", "+234703", "+234706", "+234808", "+234802", "+234818", "+234708", "+234704", "+234814", "+234903", "+234906", "+234915", "+234905", "+234901", "+234909", "+234912");
$phone_numbers = array();

for ($i = 0; $i < $quantity; $i++) {
    $prefix = $prefixes[array_rand($prefixes)];
    $random_number = rand(1000000, 99999999);
    $phone_number = $prefix . $random_number;
    array_push($phone_numbers, $phone_number);
}

// Insert the phone numbers into the database
$sql = "INSERT INTO phone_numbers (number) VALUES (?)";
$stmt = $conn->prepare($sql);

foreach ($phone_numbers as $phone_number) {
    $stmt->bind_param("s", $phone_number);
    $stmt->execute();
}

// Close the database connection
$conn->close();

// Display the generated phone numbers
echo "<h2>Generated Phone Numbers</h2>";
echo "<ul>";
foreach ($phone_numbers as $phone_number) {
    echo "<li>" . $phone_number . "</li>";
}
echo "</ul>";
?>





