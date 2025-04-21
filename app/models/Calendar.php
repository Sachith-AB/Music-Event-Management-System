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
        // Convert to integer to ensure proper value
        $is_available = (int)$is_available;
        
        $data = [
            'user_id' => $user_id,
            'date' => $date,
            'is_available' => $is_available
        ];
        return $this->insert($data);
    }

    // Update availability for a specific date
    public function updateAvailability($user_id, $date, $is_available) {
        // Convert to integer to ensure proper value
        $is_available = (int)$is_available;
        
        $data = [
            'is_available' => $is_available
        ];
        $where = [
            'user_id' => $user_id,
            'date' => $date
        ];
        return $this->update($where, $data);
    }

    // Get calendar entries for a specific user
    public function getUserCalendar($user_id) {
        $sql = "SELECT * FROM calendar WHERE user_id = ? ORDER BY date";
        return $this->query($sql, [$user_id]);
    }
}
