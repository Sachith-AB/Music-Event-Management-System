<?php 

class Message {
    use Model;

    protected $table = 'messages';
    protected $allowedColumns = [
        
        'event_id',
        'event_planner',
        'sender',
        'message',
        'status'
		
    ];


    public function getMessagesForEvent($event_id, $sender_id)
    {
        // Query to get messages related to the event and sender
        $query = "SELECT * FROM {$this->table} 
                  WHERE sender = :sender_id AND event_id = :event_id 
                  ORDER BY timestamp ASC";
    
        // Execute the query with parameter binding
        return $this->query($query, [
            'sender_id' => $sender_id,
            'event_id' => $event_id
        ]);
    }
    
    public function getEventMessages($planner_id)
{
    // Assume $planner_id is passed to fetch messages for the specific event planner
    $query = "SELECT m.event_id, m.sender AS collaborator_id, e.event_name, c.name AS collaborator_name, c.pro_pic AS collaborator_pic, 
                     MAX(m.timestamp) AS last_message_time, 
                     COUNT(m.id) AS total_messages 
              FROM messages m 
              JOIN events e ON m.event_id = e.id 
              JOIN users c ON m.sender = c.id 
              WHERE e.createdBy = :planner_id
              GROUP BY m.event_id, m.sender";

    return $this->query($query, ['planner_id' => $planner_id]);
}



    public function validateMessage($data)
    {
        return !empty($data['event_id']) && !empty($data['event_planner']) && !empty($data['sender']) && !empty($data['message']);
    }

}