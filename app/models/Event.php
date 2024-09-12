<?php

class Event {
    use Model;

    protected $table = 'events'; // Define the table name
    protected $allowedColumns = [
        'event_name',
        'description',
        'audience',
        'city',
        'province',
        'eventDate',
        'start_time',
        'end_time'
    ];

    public function validEvent($data) {

        $this->errors = [];

        //flage mean errors include

        if (empty($data['event_name'])) {
            $this->errors['event_name'] = "Event name is required";
        }

        if (empty($data['description'])) {
            $this->errors['description'] = "Event description is required";
        }


        if (empty($data['audience'])) {
            $this->errors['audience'] = "Audience is required";
        }


        if (empty($data['city'])) {
           $this->errors['city'] = "City is required";
        }

        if (empty($data['province'])) {
            $this->errors['province'] = "Province is required";
        }

        if (empty($data['eventDate'])) {
            $this->errors['eventDate'] = "Event date is required";
        }

        if (empty($data['start_time'])) {
        $this->errors['start_time'] = "Start time is required";
        }


        if (empty($this->errors)) {
            return true;
        }

        return false;
    }

}