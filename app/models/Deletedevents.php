<?php

class Deletedevents {

    use Model;

   protected $table = 'deletedevents';

   protected $allowedColumns = [
    'event_id',
    'event_name',
    'description',
    'audience',
    'city',
    'province',
    'eventDate',
    'start_time',
    'end_time',
    'cover_images',
    'pricing',
    'type',
    'createdBy',
    'address',
    'status'
];




}