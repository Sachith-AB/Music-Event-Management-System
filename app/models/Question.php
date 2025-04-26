<?php

class Question {
    use Model;

    protected $table = 'user_questions';
    protected $allowedColumns = [
        'id',
        'user_id',
        'email',
        'subject',
        'question',
        'created_at'
    ];

    public function getQuestions() {
        $query = "SELECT user_questions.*, users.name FROM user_questions
        JOIN users ON user_questions.user_id = users.id
        ORDER BY user_questions.created_at DESC";
        return $this->query($query);
    }
}
