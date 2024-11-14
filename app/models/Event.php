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
        'end_time',
        'pricing',
        'type'
    ];

    public function validEvent($data) {
        $this->errors = [];


        //Event name validation
        if (empty($data['event_name'])) {
            $this->errors['event_name'] = "Event name is required";
        }

        //Description validation
        if (empty($data['description'])) {
            $this->errors['description'] = "Event description is required";
        }

        //Audience validation 
        if (empty($data['audience'])) {
            $this->errors['audience'] = "Audience is required";
        }
            elseif (!is_numeric($data['audience']) || $data['audience'] <= 0) {
                $this->errors['audience'] = "Audience must be a positive number.";
            }

        //City validation
        if (empty($data['city'])) {
           $this->errors['city'] = "City is required";
        }

        //Province validation
        if (empty($data['province'])) {
            $this->errors['province'] = "Province is required";
        }

        //Event date validation
        if (empty($data['eventDate'])) {
            $this->errors['eventDate'] = "Event date is required";
        } elseif (!$this->isValidDate($data['eventDate'])){
            $this->errors['eventDate'] = "Event date is not in the correct format(Y-m-d)";
        } elseif (strtotime($data['eventDate']) < strtotime(date('Y-m-d'))) {
            $this->errors['eventDate'] = "Event date must be after today.";
        }

        //Start time validation
        if (empty($data['start_time'])) {
        $this->errors['start_time'] = "Start time is required";
        } elseif (!$this->isValidTime($data['start_time'])){
            $this->errors['start_time'] = "Start time is not in the correct format(H:i)";
        }

        //End time validation
        if (empty($data['end_time'])){
            $this->error['end_time'] = "End time is required";
        } elseif (!$this->isValidTime($data['end_time'])){
            $this->errors['end_time'] = "End time is not in the correct format(H:i)";
        } elseif (strtotime($data['end_time']) <= strtotime($data['start_time'])){
            $this->errors['end_time'] = "End time must be after start time";
        }

        // Pricing validation
        if (empty($data['pricing'])) {
            $this->errors['pricing'] = "Pricing is required";
        } 

        // Type validation
        if (empty($data['type'])) {
            $this->errors['type'] = "Event type is required";
        }
        
        if (empty($this->errors)) {
            return true;
        }


        return false;
    }


        //Helper function to validate date format
        private function isValidDate($date) {
            $d = DateTime::createFromFormat('Y-m-d', $date);
            return $d && $d->format('Y-m-d') === $date;
        }
        

        //Helper function to validate time format
        private function isValidTime($time){
            $t = DateTime::createFromFormat('H:i', $time);
            return $t && $t->format('H:i') === $time;
        }


    }
