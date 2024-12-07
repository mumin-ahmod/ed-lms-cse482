<?php
session_start();
require_once '../backend/db.php';

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Get all users for the recipient dropdown, excluding the logged-in user
$stmt = $pdo->prepare("SELECT id, email FROM users WHERE id != :user_id");
$stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php include  __DIR__ . '/header.php'; ?>

    <style>
        #chat-box {
            display: flex;
            flex-direction: column;
            height: 400px;
            /* Adjust as needed */
            overflow-y: auto;
            border: 1px solid #ccc;
            padding: 10px;
            background-color: #f9f9f9;
        }

        #chat-history {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding-right: 10px;
            overflow-y: auto;
        }

        .sent,
        .received {
            max-width: 70%;
            /* Set maximum width of messages */
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 10px;
            display: inline-block;
            clear: both;
            word-wrap: break-word;
        }

        .sent {
            background-color: #d1ffd1;
            align-self: flex-end;
            /* Align sent messages to the right */
            text-align: right;
        }

        .received {
            background-color: #f1f1f1;
            align-self: flex-start;
            /* Align received messages to the left */
            text-align: left;
        }

        #chat-box textarea {
            width: 100%;
            height: 50px;
            padding: 10px;
            margin-top: 10px;
            resize: none;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        #chat-box button {
            padding: 10px;
            margin-top: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #chat-box button:hover {
            background-color: #0056b3;
        }

        small {
            display: block;
            font-size: 0.8em;
            color: #666;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <h2>Chat</h2>
        <div>
            <label for="recipient">Select Recipient:</label>
            <select id="recipient" class="form-select">
                <option value="">--Select a user--</option>
                <?php foreach ($users as $user): ?>
                    <option value="<?php echo $user['id']; ?>"><?php echo htmlspecialchars($user['email']); ?></option>
                <?php endforeach; ?>
            </select>
            <!-- Show Chat History Button -->
            <button id="showChatHistory" onclick="showChatHistory()">Show Chat History</button>
        </div>
        <div id="chat-box">
            <div id="chat-history" style="height: 300px; overflow-y: auto; border: 1px solid #ccc; padding: 10px;">
                <!-- Chat messages will appear here -->
            </div>
        </div>
        <input type="text" id="message" class="form-control" placeholder="Type a message">
        <button class="btn btn-primary mt-2" onclick="sendMessage()">Send</button>
    </div>

    <script>
        const loggedInUserId = <?php echo $_SESSION['user_id']; ?>;

        // Initialize Pusher
        var pusher = new Pusher('bb168db3fb3adf7ea72d', {
            cluster: 'ap2'
        });

        const channel = pusher.subscribe('chat-channel');
        channel.bind('new-message', function(data) {
            if ((data.to_user == loggedInUserId && data.from_user == getRecipientId()) ||
                (data.from_user == loggedInUserId && data.to_user == getRecipientId())) {
                const chatBox = document.getElementById('chat-box');
                const messageClass = data.from_user == loggedInUserId ? 'from-user' : 'to-user';
                const messageDiv = document.createElement('div');
                messageDiv.className = `message ${messageClass}`;
                messageDiv.textContent = data.message;
                chatBox.appendChild(messageDiv);
                chatBox.scrollTop = chatBox.scrollHeight;
            }
        });

        function getRecipientId() {
            return document.getElementById('recipient').value;
        }

        function sendMessage() {
            const recipientId = getRecipientId();
            const message = document.getElementById('message').value;

            if (!recipientId) {
                alert("Please select a recipient!");
                return;
            }

            fetch('../backend/sendMessage.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `from_user=${loggedInUserId}&to_user=${recipientId}&message=${encodeURIComponent(message)}`
                }).then(response => response.text())
                .then(result => {
                    console.log(result);
                    document.getElementById('message').value = '';
                    loadChatHistory(); // Reload chat history to display the new message
                });
        }

        function loadChatHistory() {
            const chatHistoryElement = document.getElementById('chat-history');
            const recipientId = getRecipientId();

            if (!recipientId) {
                chatHistoryElement.innerHTML = '<p>Select a user to view chat history.</p>';
                return;
            }

            fetch(`../backend/getmessages.php?from_user=${loggedInUserId}&to_user=${recipientId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        const messages = data.messages;
                        chatHistoryElement.innerHTML = ''; // Clear existing messages

                        messages.forEach(message => {
                            const messageElement = document.createElement('div');
                            messageElement.classList.add(
                                message.from_user === loggedInUserId ? 'sent' : 'received'
                            );
                            messageElement.innerHTML = `
                        <p><strong>${message.from_user === loggedInUserId ? 'You' : message.from_user_name}:</strong></p>
                        <p>${message.message}</p>
                        <small>${new Date(message.created_at).toLocaleString()}</small>
                    `;
                            chatHistoryElement.appendChild(messageElement);
                        });

                        // Scroll to the bottom of the chat history
                        chatHistoryElement.scrollTop = chatHistoryElement.scrollHeight;
                    } else {
                        chatHistoryElement.innerHTML = `<p>Error: ${data.error}</p>`;
                    }
                })
                .catch(error => {
                    console.error('Error fetching chat history:', error);
                    chatHistoryElement.innerHTML = '<p>Failed to load chat history.</p>';
                });
        }

       // Show Chat History for the selected user
       function showChatHistory() {
            const recipientUserId = document.getElementById('recipient').value;

            // Check if a recipient is selected
            if (recipientUserId) {
                loadChatHistory(); // Use the existing loadChatHistory function
            } else {
                alert('Please select a user first!');
            }
        }

        // Call `loadChatHistory()` when the recipient changes or on page load
    </script>
</body>

</html>