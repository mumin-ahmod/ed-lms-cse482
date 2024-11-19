<?php
require 'db.php'; // Include database configuration

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Retrieve user IDs from the request
    $from_user = filter_input(INPUT_GET, 'from_user', FILTER_VALIDATE_INT);
    $to_user = filter_input(INPUT_GET, 'to_user', FILTER_VALIDATE_INT);

    // Validate inputs
    if (!$from_user || !$to_user) {
        echo json_encode(['error' => 'Invalid user IDs.']);
        exit();
    }

    try {
        // Retrieve messages between the two users
        $stmt = $pdo->prepare("
            SELECT 
                m.id, 
                m.from_user, 
                m.to_user, 
                m.message, 
                m.created_at,
                u_from.name AS from_user_name,
                u_to.name AS to_user_name
            FROM messages m
            LEFT JOIN users u_from ON m.from_user = u_from.id
            LEFT JOIN users u_to ON m.to_user = u_to.id
            WHERE 
                (m.from_user = :from_user AND m.to_user = :to_user)
                OR 
                (m.from_user = :to_user AND m.to_user = :from_user)
            ORDER BY m.id ASC
        ");
        $stmt->bindParam(':from_user', $from_user, PDO::PARAM_INT);
        $stmt->bindParam(':to_user', $to_user, PDO::PARAM_INT);
        $stmt->execute();
        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Return messages as JSON
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'success',
            'messages' => $messages
        ]);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Invalid request method.']);
}
?>
