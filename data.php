<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "mysql_db_new"; // atau IP server database
$user = "root"; // Ganti jika ada user lain
$password = "root"; // Password database
$database = "log_insiden"; // Sesuaikan dengan database kamu

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

function getData() {
    global $conn;
    $sql = "SELECT * FROM insiden"; // Sesuaikan dengan tabel di database
    $result = $conn->query($sql);

if (!$result) {
        echo $sql;
        die("Error pada query: " . $conn->error); // Tambahkan debug ini
    }

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

    $rows = getData();
    $rowData = is_array($rows) && !empty($rows) ? $rows[0] : [];
?>
