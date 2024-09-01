<?php

require_once __DIR__ . '/../../models/Event.php';

class Create {


    public function index() {
        // Instantiate the Event model directly
        $event = new Event();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = [
                'event_name' => htmlspecialchars($_POST['event_name']),
                'event_description' => htmlspecialchars($_POST['event_description']),
                'category' => htmlspecialchars($_POST['category']),
                'performances' => htmlspecialchars($_POST['performances']),
                'address' => htmlspecialchars($_POST['address']),
                'city' => htmlspecialchars($_POST['city']),
                'province' => htmlspecialchars($_POST['province']),
                'time_zone' => htmlspecialchars($_POST['time_zone']),
                'event_date' => htmlspecialchars($_POST['event_date']),
                'start_time' => htmlspecialchars($_POST['start_time']),
                'end_time' => htmlspecialchars($_POST['end_time']),
                'ticket_type' => htmlspecialchars($_POST['ticket_type']),
                'quantity' => (int)$_POST['quantity'],
                'price' => (float)$_POST['price'],
                'sale_start_date' => htmlspecialchars($_POST['sale_start_date']),
                'sale_start_time' => htmlspecialchars($_POST['sale_start_time']),
                'sale_end_date' => htmlspecialchars($_POST['sale_end_date']),
                'sale_end_time' => htmlspecialchars($_POST['sale_end_time']),
                'cover_image' => ''
            ];

            // Handle file upload
            if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] == UPLOAD_ERR_OK) {
                $target_dir = __DIR__ . '/../../../public/uploads/';
                
                // Ensure directory exists
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0755, true);
                }

                $file_name = basename($_FILES['cover_image']['name']);
                $target_file = $target_dir . $file_name;

                // Move uploaded file to the target directory
                if (move_uploaded_file($_FILES['cover_image']['tmp_name'], $target_file)) {
                    $data['cover_image'] = $file_name;
                } else {
                    echo "Failed to upload cover image.";
                    return;
                }
            }

            // Create event using the model
            if ($event->create($data)) {
                // Redirect after successful creation
                header("Location: /success-page"); // Change this to the appropriate success page
                exit;
            } else {
                echo "Failed to create event.";
            }
        } else {
            $this->view('create_event');
        }
    }
}
