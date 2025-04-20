<?php
if (!isset($notifications)) {
    $notifications = ['newnotifications' => [], 'allnotifications' => []];

    if (isset($_SESSION['USER'])) {
        require_once '../app/models/Notification.php';
        $notification = new Notification;
        $userId = $_SESSION['USER']->id;

        // Mark as read if POST triggered
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['changeread'])) {
            $notification->markasread($userId);
        }

        $notifications = [
            'newnotifications' => $notification->getNewnotifications($userId),
            'allnotifications' => $notification->getNotifications($userId)
        ];
    }
}
