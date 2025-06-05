<?php
include "data.php"; // Pastikan koneksi database sudah ada

if (isset($_GET['no'])) {
    $no = $conn->real_escape_string($_GET['no']);

    // Query DELETE
    $sql = "DELETE FROM insiden WHERE no = '$no'";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php"); // Redirect setelah sukses
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Error: No tidak ditemukan!";
}
?>
