<?php
//var_dump($_POST);
//exit();
include "data.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pastikan mode tidak kosong
    if (!isset($_POST["mode"])) {
        die("Error: Mode tidak ditemukan!");
    }
    
    $mode = $_POST["mode"];
    $no = $_POST["no"] ?? null; // Primary key untuk edit
    $columns = array_keys(getData()[0]); // Ambil nama kolom dari database

    // Ambil data dari form
    $data = [];
    foreach ($columns as $col) {
        if (isset($_POST[$col]) && is_string($_POST[$col])) {
            $data[$col] = $conn->real_escape_string(str_replace("\r\n", "\n", $_POST[$col])); // Hindari SQL Injection
        }
    }

// Cek apakah ada file yang diunggah
if (!empty($_FILES['evidence']['name'])) {
    $target_dir = "uploads/"; // Folder penyimpanan file
    $filename = basename($_FILES['evidence']['name']);
    $target_file = $target_dir . $filename;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validasi jenis file (hanya gambar)
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($fileType, $allowedTypes)) {
        die("Error: Hanya file gambar yang diperbolehkan.");
    }

    // Pindahkan file ke folder uploads
    if (move_uploaded_file($_FILES['evidence']['tmp_name'], $target_file)) {
        // Simpan nama file di database
        $data['evidence'] = $filename;
    } else {
        die("Error: Gagal mengunggah file.");
    }
}

    if ($mode === "add") {
        // Query INSERT

	unset($data['no']);

        $keys = implode(", ", array_keys($data));
        $values = "'" . implode("', '", array_values($data)) . "'";
        $sql = "INSERT INTO insiden ($keys) VALUES ($values)";
    } elseif ($mode === "edit" && $no) {
        // Query UPDATE
        $update_fields = [];
        foreach ($data as $key => $value) {
            $update_fields[] = "$key = '$value'";
        }
        $update_fields = implode(", ", $update_fields);
        $sql = "UPDATE insiden SET $update_fields WHERE no = '$no'";
    } else {
        die("Error: Mode tidak valid atau No tidak ditemukan.");
    }

    // Jalankan query
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php"); // Redirect ke halaman utama
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
