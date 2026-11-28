<?php
header('Content-Type: application/json; charset=utf-8');

$host = '172.20.0.1';
$port = 3307;
$db   = 'db_site';
$user = 'siteuser';
$pass = 'sitepass';

$conn = @new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => $conn->connect_error
    ]);
    exit;
}

// Fetch basic database information
$dbName = $conn->query("SELECT DATABASE()")->fetch_row()[0];
$charset = $conn->character_set_name();

// Fetch the list of tables in db_site
$tables = [];
$res = $conn->query("SHOW TABLE STATUS");
if ($res) {
    while ($row = $res->fetch_assoc()) {
        $tables[] = [
            'name'   => $row['Name'],
            'engine' => $row['Engine'],
            'rows'   => $row['Rows'] ?? 0
        ];
    }
}

echo json_encode([
    'status'         => 'success',
    'host'           => $host . ':' . $port,
    'database'       => $dbName,
    'user'           => $user,
    'mysql_version'  => $conn->server_info,
    'php_version'    => phpversion(),
    'charset'        => $charset,
    'tables'         => $tables
]);

$conn->close();
?>
