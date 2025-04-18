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