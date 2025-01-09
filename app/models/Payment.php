<?php 

class Payment {
    use Model;

    protected $table = 'payments';
    protected $allowedColumns = ['id','user_id', 'event_id', 'payment'];

    
    public function getPaymentData($event_id) {
        $query = "SELECT 
                    p.event_id,
                    p.user_id,
                    u.name AS name,
                    SUM(p.payment) AS total_payment
            FROM 
                payments p
            JOIN 
                users u 
            ON 
                p.user_id = u.id
            WHERE 
                p.event_id = :event_id
            GROUP BY 
                p.event_id, p.user_id, u.name";
        $params = ['event_id' => $event_id];
        $result = $this->query($query, $params);
        return $result ? $result : [];
    }
}    
