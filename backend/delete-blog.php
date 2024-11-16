<?php
// Include database connection
include 'db.php';

header('Content-Type: application/json');

try {
    // Get the POST data
    $data = json_decode(file_get_contents('php://input'), true);
    $blogId = $data['id'] ?? null;

    if ($blogId) {
        // Prepare and execute the delete query
        $stmt = $pdo->prepare("DELETE FROM blogs WHERE id = :id");
        $stmt->bindParam(':id', $blogId, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete the blog.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid blog ID.']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
