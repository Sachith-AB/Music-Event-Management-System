<div id="notificationPopup" class="notification-popup hidden">
    <?php if (!empty($notifications["allnotifications"]) && is_array($notifications["allnotifications"])): ?>
        <ul>
            <?php foreach ($notifications["allnotifications"] as $note): ?>
                <li class="notification-item" onclick="window.location.href='<?= $note->link ?>&note_id=<?= $note->id ?>'">
                    <strong><?= htmlspecialchars($note->title) ?></strong><br>
                    <?php 
                        $messages = json_decode($note->message);
                        if (json_last_error() === JSON_ERROR_NONE && is_array($messages)) {
                            foreach ($messages as $msg) {
                                echo "<div>" . htmlspecialchars($msg) . "</div>";
                            }
                        } else {
                            echo "<div>" . htmlspecialchars($note->message) . "</div>";
                        }
                    ?>
                    <small><?= date('F j, Y, g:i a', strtotime($note->created_at)) ?></small>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No notifications found.</p>
    <?php endif; ?>
</div>