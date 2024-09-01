<?php


class Event {
    use Model;

    protected $table = 'events'; // Define the table name
    protected $allowedColumns = [
        'event_name',
        'event_description',
        'category',
        'performances',
        'address',
        'city',
        'province',
        'time_zone',
        'event_date',
        'start_time',
        'end_time',
        'ticket_type',
        'quantity',
        'price',
        'sale_start_date',
        'sale_start_time',
        'sale_end_date',
        'sale_end_time',
        'cover_image'
    ];

    public function validEvent($data) {

        $this->errors = [];

        if (empty($data['event_name'])) {
            $this->errors['event_name'] = "Event name is required";
        }

        if (empty($data['event_description'])) {
            $this->errors['event_description'] = "Event description is required";
        }

        if (empty($data['category'])) {
            $this->errors['category'] = "Category is required";
        }

        if (empty($data['performances'])) {
            $this->errors['performances'] = "Please select at least one performance";
        }

        if (empty($data['address'])) {
            $this->errors['address'] = "Address is required";
        }

        if (empty($data['city'])) {
            $this->errors['city'] = "City is required";
        }

        if (empty($data['province'])) {
            $this->errors['province'] = "Province is required";
        }

        if (empty($data['time_zone'])) {
            $this->errors['time_zone'] = "Time zone is required";
        }

        if (empty($data['event_date'])) {
            $this->errors['event_date'] = "Event date is required";
        }

        if (empty($data['start_time'])) {
            $this->errors['start_time'] = "Start time is required";
        }

        if (empty($data['end_time'])) {
            $this->errors['end_time'] = "End time is required";
        }

        if (empty($data['ticket_type'])) {
            $this->errors['ticket_type'] = "Ticket type is required";
        }

        if ($data['ticket_type'] == 'paid' && (empty($data['quantity']) || empty($data['price']))) {
            $this->errors['quantity'] = "Quantity and price are required for paid tickets";
        }

        if (empty($data['sale_start_date']) || empty($data['sale_start_time'])) {
            $this->errors['sale_start'] = "Sale start date and time are required";
        }

        if (empty($data['sale_end_date']) || empty($data['sale_end_time'])) {
            $this->errors['sale_end'] = "Sale end date and time are required";
        }

        if (empty($this->errors)) {
            return true;
        }

        return false;
    }
}
?>