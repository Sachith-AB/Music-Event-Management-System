<?php

class EventPlannerComments {

        use Controller;

        public function index () {

            $comment = new Comment;

            //fetch comments for the logged-in-planner 

            $eventplannerid = $_SESSION['USER']->id;

            $plannerComments = $comment->getCommnet($eventplannerid);
            // show($plannerComments);

            //pass data to the view 
            $this->view('eventPlanner/comments', ['plannerComments' => $plannerComments] );

        }

}