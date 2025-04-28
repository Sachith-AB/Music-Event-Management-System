<?php

    class AskQuestionAdmin {

        use Controller;

        public function index()
        {
            $question = new Question();
            $data = $question->getQuestions();
            $this->view('footer/askQuestionAdmin', $data,false);
        }

        public function getQuestions() {
            $question = new Question();
            $data = $question->getQuestions();
            //show($data);
            return $data;
        }
    }



    ?>