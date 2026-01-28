<?php
// Simple test file to check if the server is working
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

echo json_encode([
    'success' => true, 
    'message' => 'Server is working!',
    'method' => $_SERVER['REQUEST_METHOD'],
    'post_data' => $_POST
]);
?>
