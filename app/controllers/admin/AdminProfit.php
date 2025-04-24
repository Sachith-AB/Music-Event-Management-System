<?php

class AdminProfit{
    use Controller;

    public function index(){
        $data = $this->getProfitInfo();
        //show($data);
        $this->view('admin/adminProfit', $data);

    }

    private function getProfitInfo()
    {
        $admin = new Admin();
        $data['administrative_fee'] = $admin->getAdministrativeFee();
        return $data;
    }
}