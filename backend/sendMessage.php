<?php
// Include the database connection
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize POST data
    $from_user = filter_input(INPUT_POST, 'from_user', FILTER_VALIDATE_INT);
    $to_user = filter_input(INPUT_POST, 'to_user', FILTER_VALIDATE_INT);
    $message = filter_input(INPUT_POST, 'message');

    // Validate the inputs
    if (!$from_user || !$to_user || empty($message)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid input.']);
        exit();
    }

    // Insert the message into the database
    $sql = "INSERT INTO messages (from_user, to_user, message) VALUES (:from_user, :to_user, :message)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':from_user', $from_user, PDO::PARAM_INT);
    $stmt->bindParam(':to_user', $to_user, PDO::PARAM_INT);
    $stmt->bindParam(':message', $message, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Message sent successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to send message.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
