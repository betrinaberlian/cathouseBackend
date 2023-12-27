<?php
require_once('../db_connect.php');

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json_data = file_get_contents('php://input');
    $data = json_decode($json_data, true);

    if ($data !== null) {
        //$user_id = $data['user_id'];
        $name = $data['name'];
        $cat_breed = $data['cat_breed'];
        $genre = $data['genre'];
        $service = $data['service'];
        $delivery_date = $data['delivery_date'];
        $pickup_date = $data['pickup_date'];

        $query = "INSERT INTO orders (name, cat_breed, genre, service, delivery_date, pickup_date ) VALUES
            ('$name', '$cat_breed', '$genre', '$service', '$delivery_date', '$pickup_date')";

        if ($conn->query($query) === TRUE) {
            $response['success'] = true;
            $response['message'] = 'Pemesanan berhasil!';
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
