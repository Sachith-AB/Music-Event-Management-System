<?php

class Calendar {
    use Model;

    protected $table = 'calendar'; // Define the table name
    protected $allowedColumns = [
        'user_id',
        'date',
        'is_available'
    ];

    // Set availability for a specific date
    public function setAvailability($user_id, $date, $is_available) {
        //show("Setting availability for user $user_id on date $date");
        
        // Check if entry exists
        $existing = $this->where(['user_id' => $user_id, 'date' => $date]);
        //show("Existing entries: ");
        //show($existing);
        
        if(!empty($existing)) {
            return $this->updateAvailability($user_id, $date, $is_available);
        }
        
        $data = [
            'user_id' => $user_id,
            'date' => $date,
            'is_available' => $is_available
        ];
        
        //show("Inserting new data: ");
        //show($data);
        
        return $this->insert($data);
    }

    // Update availability for a specific date
    public function updateAvailability($user_id, $date, $is_available) {
        $data = [
            'is_available' => $is_available
        ];
        
        $where = [
            'user_id' => $user_id,
            'date' => $date
        ];
        
        //show("Updating availability with data: ");
        //show($data);
        //show("Where conditions: ");
        //show($where);
        
        return $this->update($where, $data);
    }

    // Get calendar entries for a specific user
    public function getUserCalendar($user_id) {
        $sql = "SELECT * FROM {$this->table} WHERE user_id = :user_id ORDER BY date";
        $result = $this->query($sql, ['user_id' => $user_id]);
        
        //show("Calendar entries for user $user_id: ");
        //show($result);
        
        return $result;
    }

    private function validateDate($date) {
        if(empty($date)) return false;
        
        $d = DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') === $date;
    }

    public function addUnavailableDates($user_id, $date){
        $this->setAvailability($user_id, $date, 0);
    }

    private function where($conditions) {
        $sql = "SELECT * FROM {$this->table} WHERE ";
        $params = [];
        
        foreach($conditions as $key => $value) {
            $sql .= "{$key} = :{$key} AND ";
            $params[$key] = $value;
        }
        
        $sql = rtrim($sql, " AND ");
        //show("WHERE query: $sql");
        //show("Parameters: ");
        //show($params);
        
        return $this->query($sql, $params);
    }

    public function getAvailability($user_id, $date) {
        $sql = "SELECT * FROM {$this->table} WHERE user_id = :user_id AND date = :date";
        $params = [
            'user_id' => $user_id,
            'date' => $date
        ];
    
        $result = $this->query($sql, $params);
    
        // If any result exists, user is NOT available, so return false
        return empty($result) ? true : false;
    }
    
}

