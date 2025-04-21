<?php

class Search {

    use Controller;
    use Model;
    
    public function index(){

        $event = new Event;
        $data = [];

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['searchEvents'])){

            $data = $this->searchEventByName($event);
            // show($data);
        }else if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['apply'])){
            $data = $this->filterEvents($event);
        }else{
            $data = $this->getEvents($event);
        }
        $this->view('search',$data);
    }

    private function getEvents($event){
        $res = $event->findAll();
        foreach ($res as $key => $evt) {
            $ratingData = $this->getEventRating(new Rating, $evt->id, new User);
            $res[$key]->averageRating = $ratingData[0]['averageRating'] ?? 0;
            $res[$key]->totalReviews = $ratingData[0]['totalReviews'] ?? 0;
        }
        return $res;
    }
    

    private function searchEventByName($event){
        $res = $event->searchEventByName($_POST);
        unset($_POST['name']);
        unset($_POST['location']);
        unset($_POST['search']);
        
        foreach ($res as $key => $evt) {
            $ratingData = $this->getEventRating(new Rating, $evt->id, new User);
            $res[$key]->averageRating = $ratingData[0]['averageRating'] ?? 0;
            $res[$key]->totalReviews = $ratingData[0]['totalReviews'] ?? 0;
        }
        
        return $res;
    }
    

    private function filterEvents($event){
        $res = $event->filterEvents($_POST);
        
        foreach ($res as $key => $evt) {
            $ratingData = $this->getEventRating(new Rating, $evt->id, new User);
            $res[$key]->averageRating = $ratingData[0]['averageRating'] ?? 0;
            $res[$key]->totalReviews = $ratingData[0]['totalReviews'] ?? 0;
        }
    
        return $res;
    }
    

    private function getEventRating($rating, $id, $user) {
        $ratings = $rating->getRatingFromEventId($id);
        $res = [];
    
        $averageRating = 0;
        $totalReviews = 0;
    
        if (is_array($ratings)) {
            $totalReviews = count($ratings);
            if ($totalReviews > 0) {
                $sumRatings = 0;
                foreach ($ratings as $rate) {
                    $sumRatings += $rate->rating;  // Assuming $rate->rating is numeric
                }
                $averageRating = $sumRatings / $totalReviews;
    
                foreach ($ratings as $rate) {
                    $userData = $user->firstById($rate->user_id);
                    $res[] = [
                        'rating' => $rate,
                        'user'   => $userData,
                        'averageRating' => $averageRating,
                        'totalReviews' => $totalReviews,
                    ];
                }
            }
        }
    
        return $res;
    }
}