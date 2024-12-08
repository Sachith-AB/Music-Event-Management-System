<?php

class Chat {

    use Controller;
    use Model;

    public function sendMessage()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $messageModel = new Message;
            // Read the JSON input
            $input = json_decode(file_get_contents('php://input'), true);

            // Check if input is valid JSON
            if (!$input) {
                echo json_encode(['status' => 'error', 'message' => 'Invalid JSON data']);
                return;
            }

            // var_dump($input); 

            // Collect data
            $data = [
                'event_id' => htmlspecialchars($input['event_id'] ?? ''),
                'event_planner' => htmlspecialchars($input['event_planner'] ?? ''),
                'sender' => htmlspecialchars($input['sender'] ?? ''),
                'message' => htmlspecialchars($input['message'] ?? ''),
                'status' => htmlspecialchars($input['status'] ?? ''),
            ];

            // Validate and save message
            if ($messageModel->validateMessage($data)) {
                
                $messageModel->insert($data);
                echo json_encode(['status' => 'success', 'message' => 'Message sent']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Validation failed']);
            }
        }
    }

    public function getMessages()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $messageModel = new Message;
            $event_id = htmlspecialchars($_GET['event_id']);
            $sender_id = htmlspecialchars($_GET['sender_id']);

            // Validate the input
            if (empty($event_id) || empty($sender_id)) {
                echo json_encode(['status' => 'error', 'message' => 'Invalid event_id or sender_id']);
                return;
            }

            // Fetch messages for the event and sender
            $messages = $messageModel->getMessagesForEvent($event_id, $sender_id);

            // Ensure JSON response is clean
            header('Content-Type: application/json');
            echo json_encode($messages);
        }
    }


    
}
