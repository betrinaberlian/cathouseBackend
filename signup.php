<?php
require_once('../db_connect.php');

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json_data = file_get_contents('php://input');
    $data = json_decode($json_data, true);

    if ($data !== null) {
        $name = $data['name'];
        $email = $data['email'];
        $password = $data['password'];
        $address = $data['address'];
        $phone = $data['phone'];
        $sex = $data['sex'];

        $hash = password_hash($password, PASSWORD_BCRYPT);

        $query = "INSERT INTO users (email, password, name, address, phone, sex) VALUES ('$email', '$hash', '$name', '$address', '$phone', '$sex')";

        if ($conn->query($query) === TRUE) {
            $response['success'] = true;
            $response['message'] = 'Pendaftaran berhasil!';
        } else {
            $response['success'] = false;
            $response['message'] = "Error: " . $query . "<br>" . $conn->error;
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
