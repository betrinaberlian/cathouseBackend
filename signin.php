<?php
require_once '../db_connect.php';
$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json_data = file_get_contents('php://input');

    $data = json_decode($json_data, true);
    if ($data !== null) {
        $email = $data['email'];
        $password = $data['password'];

        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashedPassword = $row['password'];

            if (password_verify($password, $hashedPassword)) {
                $response['success'] = true;
                $response['message'] = 'Login berhasil!';
            } else {
                $response['success'] = false;
                $response['message'] = 'Email atau password salah.';
            }
        } else {
            $response['success'] = false;
            $response['message'] = 'Email atau password salah.';
        }
    } else {
        $response['success'] = false;
        $response['message'] = 'Gagal mendekode JSON.';
    }
} else {
    $response['success'] = false;
    $response['message'] = 'Metode request tidak valid';
}

$conn->close();
header('Content-Type: application/json');
echo json_encode($response);
?>
