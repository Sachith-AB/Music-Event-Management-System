<?php include ('../app/views/components/header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Details</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/eventCollaborators/eventDetails.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
    <?php include ('../app/views/components/loading.php'); ?>

    <div class="min-h-screen">
        <!-- Header -->
        <div class="gradient-header">
            <h1 class="title"><?php echo $data['event']->event_name ?></h1>
            <div class="eventplanner">
                <i class="fas fa-user"></i>
                <span>Created by: <?php echo $eventplanner->name ?></span>
            </div>
        </div>

        <!-- Event Details Container -->
        <div class="custom-container">
            <!-- Left Side - Image and Details -->
            <div>
                <!-- Cover Image -->
                <img 
                    src="<?=ROOT?>/assets/images/events/<?php echo $data['event']->cover_images ?>" 
                    alt="Summer Music Festival" 
                    class="image-style"
                />

                <!-- Event Details Card -->
                <div class="card-style">
                    <h2>Event Description</h2>
                    <p>
                    <?php echo $data['event']->description ?>
                    </p>

                    <div class="space-y-4">
                        <!-- Date -->
                        <div class="flex-center-space">
                            <i class="fas fa-calendar icon-blue"></i>
                            <div>
                                <h3 class="font-medium">Date</h3>
                                <p><?= htmlspecialchars(date("l, F d", strtotime($data['event']->eventDate))) ?></p>
                            </div>
                        </div>

                        <!-- Time -->
                        <div class="flex-center-space">
                            <i class="fas fa-clock icon-green"></i>
                            <div>
                                <h3 class="font-medium">Time</h3>
                                <p><?= htmlspecialchars(date("h:i A", strtotime($data['event']->start_time))) ?> - <?= htmlspecialchars(date("h:i A", strtotime($data['event']->end_time))) ?></p>
                            </div>
                        </div>

                        <!-- Venue -->
                        <div class="flex-center-space">
                            <i class="fas fa-map-marker-alt icon-red"></i>
                            <div>
                                <h3 class="font-medium">Venue</h3>
                                <p><?= htmlspecialchars($data['event']->address) ?></p>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Chat with Event Planner -->
            <div class="card-style">
                <div class="flex-center-space">
                    <i class="fas fa-comments icon-purple"></i>
                    <h2 class="text-large-semibold">Chat with Event Planner</h2>
                </div>

                <!-- Chat Messages Container -->
                <div id="chatContainer" class="chat-container">
                    <!-- Messages will be dynamically inserted here -->
                </div>

                <!-- Message Input -->
                <div class="flex-space-x">
                    <input 
                        type="text" 
                        id="messageInput"
                        placeholder="Type your message..."
                        class="custom-input"
                    />
                    <button 
                        id="sendMessage"
                        class="custom-button"
                    >
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Chat Functionality -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const chatContainer = document.getElementById('chatContainer');
        const messageInput = document.getElementById('messageInput');
        const sendMessageBtn = document.getElementById('sendMessage');

        // Event listeners for sending messages
        sendMessageBtn.addEventListener('click', sendMessage);
        messageInput.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });

        // Load messages initially
        loadMessages();

        // Fetch messages every 5 seconds
        setInterval(loadMessages, 5000);

        function sendMessage() {
    const messageText = messageInput.value.trim();
    if (messageText) {
        const eventId = <?= json_encode($data['event']->id) ?>;
        const eventPlanner = <?= json_encode($eventplanner->id) ?>;
        const sender = <?= json_encode($_SESSION['USER']->id) ?>;

        // Send message to the backend
        fetch('send-message', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                event_id: eventId,
                event_planner: eventPlanner,
                sender: sender,
                message: messageText
            })
        })
        .then(response => {
            return response.text(); // get the raw text first to check for any HTML errors
        })
        .then(text => {
            try {
                const data = JSON.parse(text); // Try to parse the response as JSON
                if (data.status === 'success') {
                    loadMessages(); // Reload messages from the server
                } else {
                    console.error(data.message);
                }
            } catch (e) {
                console.error("Failed to parse JSON:", text); // If not JSON, log the raw response
            }
        })
        .catch(error => console.error('Error sending message:', error));

        // Clear input
        messageInput.value = '';
    }
}


        function loadMessages() {
    const eventId = <?= $data['event']->id ?>; // Replace with PHP-generated event ID
    const sender_id = <?= $_SESSION['USER']->id ?>;

    // Fetch messages from the backend
    fetch(`get-messages?event_id=${eventId}&sender_id=${sender_id}`)
        .then(response => response.json())
        .then(messages => {
            chatContainer.innerHTML = ''; // Clear current messages

            // Ensure messages is an array before using forEach
            if (Array.isArray(messages)) {
                messages.forEach(message => {
                    const messageDiv = document.createElement('div');
                    messageDiv.classList.add('chat-message');
                    messageDiv.innerHTML = `
                        <p>${message.message}</p>
                        <small class="text-xs text-gray-500">${new Date(message.timestamp).toLocaleTimeString()}</small>
                    `;
                    chatContainer.appendChild(messageDiv);
                });
            } else {
                console.error('Expected an array of messages but got:', messages);
            }

            // Scroll to bottom
            chatContainer.scrollTop = chatContainer.scrollHeight;
        })
        .catch(error => console.error('Error loading messages:', error));
}
function loadMessages() {
    const eventId = <?= $data['event']->id ?>; // Replace with PHP-generated event ID
    const sender_id = <?= $_SESSION['USER']->id ?>;


    // Fetch messages from the backend
    fetch(`get-messages?event_id=${eventId}&sender_id=${sender_id}`)
        .then(response => response.json())
        .then(messages => {
            chatContainer.innerHTML = ''; // Clear current messages

            // Ensure messages is an array before using forEach
            if (Array.isArray(messages)) {
                messages.forEach(message => {
                    const messageDiv = document.createElement('div');
                    messageDiv.classList.add('chat-message');
                    messageDiv.innerHTML = `
                        <p>${message.message}</p>
                        <small class="text-xs text-gray-500">${new Date(message.timestamp).toLocaleTimeString()}</small>
                    `;
                    chatContainer.appendChild(messageDiv);
                });
            } else {
                console.error('Expected an array of messages but got:', messages);
            }

            // Scroll to bottom
            chatContainer.scrollTop = chatContainer.scrollHeight;
        })
        .catch(error => console.error('Error loading messages:', error));
}

    });
</script>

</body>
</html>