<?php
$file = 'Key.json';

if (!file_exists($file)) {
    file_put_contents($file, json_encode(["keys" => []]));
}

if (isset($_GET['get_data'])) {
    header('Content-Type: application/json');
    echo file_get_contents($file);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);

if (isset($input['key'])) {
    $current_data = json_decode(file_get_contents($file), true);
    $current_data['keys'][] = $input['key'];
    
    file_put_contents($file, json_encode($current_data, JSON_PRETTY_PRINT));
    header('Content-Type: application/json');
    echo json_encode($current_data);
}
?>
