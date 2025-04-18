<?php 
class ViewEvent{

    use Controller;
    use Model;

    public function index(){

        $data =[];
        $event = new Event;
        $rating = new Rating;
        $user = new User;
        $id = htmlspecialchars($_GET['id']);

        $data = $this->getEventData($event,$id);
        $data['ratings']  = $this->getEventRating($rating,$id,$user);
        
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['review'])){
            $this->reivewEvent($rating,$id);
        }

        $this->view('event/viewEvent',$data);
    }

    public function getEventData($event,$id){
        
        $res = $event->getAllEventData($id);
        return $res;
    }

    private function reivewEvent($rating,$id){
        $_POST['event_id'] = $id;
        $_POST['user_id'] = $_SESSION['USER']->id;
        $rating->insert($_POST);

    }

    private function getEventRating($rating, $id, $user) {
        $ratings = $rating->getRatingFromEventId($id);
        $res = [];
    
        $averageRating = 0;
        $totalReviews = count($ratings);
    
        if ($totalReviews > 0) {
            $sumRatings = 0;
            foreach ($ratings as $rate) {
                $sumRatings += $rate->rating;  // Assuming $rate->rating holds the numeric value.
            }
            $averageRating = $sumRatings / $totalReviews;
        }
    
        if ($ratings) {
            foreach ($ratings as $rate) {
                $userData = $user->firstById($rate->user_id);
                $res[] = [
                    'rating' => $rate,
                    'user'   => $userData,
                    'averageRating' => $averageRating,  // Include the correct average.
                    'totalReviews' => $totalReviews,  // Include the total reviews count.
                ];
            }
        }
    
        return $res;
    }
    
    
}