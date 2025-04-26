<?php

    class AskQuestion {

        use Controller;

        public function index()
        {
            $data = [];
            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
                $data = $this->askQuestion($_POST);
                if($data['success']) {
                    $_SESSION['success'] = "Your question has been submitted successfully!";
                } else {
                    $_SESSION['error'] = "There was an error submitting your question. Please try again.";
                }
                //redirect('askQuestion');
            }

            $this->view('footer/askQuestion', $data);
        }

        private function askQuestion($POST){
            $question = new Question();
            //show($POST);
            
            $data = [
                'user_id' => $POST['user_id'],
                'email' => $POST['email'],
                'subject' => $POST['subject'],
                'question' => $POST['question']
            ];

            // Check if user is logged in and get their ID
            if(isset($_SESSION['user'])) {
                $user = $_SESSION['user'];
                if(isset($user['id'])) {
                    $data['user_id'] = $user['id'];
                }
            }

            if($question->insert($data)) {
                return ['success' => true];
            }
            
            return ['success' => false];
        }
    }