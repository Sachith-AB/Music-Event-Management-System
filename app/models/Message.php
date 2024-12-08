<?php 

class Message {
    use Model;

    protected $table = 'messages';
    protected $allowedColumns = [
        
        'event_id',
        'event_planner',
        'sender',
        'message',
		
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
    


    public function validateMessage($data)
    {
        return !empty($data['event_id']) && !empty($data['event_planner']) && !empty($data['sender']) && !empty($data['message']);
    }

}