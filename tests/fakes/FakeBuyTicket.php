// tests/fakes/FakeBuyticket.php
<?php
class Buyticket
{
    public $errors = [];

    public function validePurchase($data)
    {
        return true;
    }

    public function insert($data)
    {
        // Simulate successful insert
    }

    public function getLatestInsertedId()
    {
        return 123;
    }
}
