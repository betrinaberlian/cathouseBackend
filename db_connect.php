
<?php
$servername = "tomohon";
$username = "nazz7425_berlin";   
$password = "kirisaki435";   
$dbname = "nazz7425_berlin";  

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
} 
echo "";

?>
