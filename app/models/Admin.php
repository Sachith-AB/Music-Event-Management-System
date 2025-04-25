<?php

class Admin {
    use Model;

    protected $table = 'financial_summary';
    protected $allowedColumns = [
        'id',
        'event_id',
        'total_revenue',
        'administrative_fee',
        'net_income',
        'total_income',
        'total_cost',
        'created_at',
        'updated_at'
    ];

    public function getAdministrativeFee()
    {
        $query = "SELECT  e.id AS event_id,
                     e.event_name,
                    f.administrative_fee,
                    f.updated_at
                    FROM financial_summary f
                    JOIN events e ON e.id = f.event_id
                    GROUP BY e.id, e.event_name, f.administrative_fee, f.updated_at";

        $result=$this->query($query);
        return $result;
    }
}

