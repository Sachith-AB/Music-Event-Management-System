<?php 

class SingerPayments {

    use Controller;
    use Model;

    public function index()
    {
        $data = [];
        $payment = new Payment;

        $data = $this->getPaymentForUser($payment);
        // show($data);
        $this->view('eventCollaborator/singerPayments', $data);



    }

    public function getPaymentForUser($payment)
    {
        $user_id = $_SESSION['USER']->id;

        $res = $payment->getPaymentsForCollaborator($user_id);

        return $res;
    }

   
}