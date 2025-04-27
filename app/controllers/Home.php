<?php 
class Home {

    use Controller;
    use Model;
    public function index(){


        $event = new Event;
        $data = [];
        $data = $this->getEventDetails($event);
        $this->view('home',$data , false);

    }

    private function getEventDetails($event) {
        $res = $event->findAll();
        $today = date('Y-m-d'); // Current date and time

        // Assign rating and review data
        foreach ($res as $key => $evt) {
            $ratingData = $this->getEventRating(new Rating, $evt->id, new User);
            $ticketData = $this->getEventTicketPrice(new Ticket, $evt->id);
            $res[$key]->ticketPrice = $ticketData[0]->price ?? 0;
            $res[$key]->averageRating = $ratingData[0]['averageRating'] ?? 0;
            $res[$key]->totalReviews = $ratingData[0]['totalReviews'] ?? 0;
        }
    
        // Sort for trending events (by averageRating DESC)
        $trendingEvents = $res;
        usort($trendingEvents, function ($a, $b) {
            return $b->averageRating <=> $a->averageRating;
        });
        $trendingEvents = array_filter($trendingEvents, function ($event) use ($today) {
            return $event->eventDate > $today && $event->status == 'scheduled' && $event->is_delete == 0; // Filter out events with no ratings
        });
    
        // Sort for recent events (by eventDate DESC)
        $recentEvents = $res;
        usort($recentEvents, function ($a, $b) {
            return strtotime($b->eventDate) <=> strtotime($a->eventDate);
        });

        if(count($trendingEvents) < 3) {
            $trendingEvents = $recentEvents;
        }
        
        $trendingEvents = array_slice($trendingEvents, 0, 3);
        // Reverse the array so oldest events come first
        $recentEvents = array_reverse($recentEvents);
    
        // Final structured return
        return [
            'trendingEvents' => $trendingEvents,
            'recentEvents' => $recentEvents
        ];
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

    private function getEventTicketPrice($ticket, $id) {
        $res = $ticket->getTicketPriceFromEventId($id);
        return $res;
    }
}

