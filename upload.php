<?php
//echo "<pre>";
//print_r($_FILES);
//echo "</pre>";

// Koneksi ke database
$conn = new mysqli("mysql_db_new", "root", "root", "log_insiden");

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Cek apakah ada file yang diunggah
if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == 0) {

$id = $_POST['id']; // Ambil ID insiden dari form
$target_dir = "uploads/";
$file_name = basename($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir . $file_name;

// Cek apakah format file gambar valid
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$valid_extensions = array("jpg", "jpeg", "png", "gif");

if (in_array($imageFileType, $valid_extensions)) {
        // Pindahkan file ke folder uploads/
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            // Update database untuk menyimpan nama file di kolom evidence
            $sql = "UPDATE insiden SET evidence='$file_name' WHERE no='$no'";
            if ($conn->query($sql) === TRUE) {
                echo "File berhasil diunggah dan diperbarui!";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        } else {
            echo "Gagal memindah file. Periksa izin folder uploads.";
        }
    } else {
        echo "Format file tidak didukung. Gunakan JPG, JPEG, PNG, atau GIF.";
    }
} else {
    echo "Tidak ada file yang diunggah atau terjadi kesalahan. Error: " . $_FILES["fileToUpload"]["error"];
}

// Tutup koneksi database
$conn->close();
?>
