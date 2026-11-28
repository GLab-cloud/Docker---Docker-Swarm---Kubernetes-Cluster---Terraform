<?php
// Credentials matching the my-mysql environment configuration in docker-compose.yaml
$host = '172.20.0.1';
$port = 3307; // If it times out on Codespaces, change this to the Gateway IP: '172.20.0.1' // If using the Gateway IP and 3306 is occupied, use the newly mapped port (e.g., 3307)
$db   = 'db_site';
$user = 'siteuser';
$pass = 'sitepass';

// Check if the mysqli extension is installed in the PHP container
if (!function_exists('mysqli_connect')) {
    die("❌ Error: The 'mysqli' extension is not installed in the PHP container!");
}

// Attempt database connection
$conn = @new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    die("❌ MySQL connection failed: " . $conn->connect_error);
}

echo "✅ Successfully connected from PHP to MySQL (" . $conn->server_info . ")!";
$conn->close();
?>
