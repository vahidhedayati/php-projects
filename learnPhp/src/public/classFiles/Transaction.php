<?php
class Transaction {
    public float $amount;
    //public string $name;
    public string $description;
    
    public function __construct(float $amount,string $description) {
       $this->amount=$amount;
       $this->description=$description;
    }
    
    public function addTax1(float $rate) {
        $this->amount +=  $this->amount * $rate / 100;
    }
    public function addTax(float $rate): Transaction {
        $this->amount +=  $this->amount * $rate / 100;
        return $this;
    }
    public function discount1(float $rate) {
        $this->amount -=  $this->amount * $rate / 100;
    }
    public function discount(float $rate):Transaction {
        $this->amount -=  $this->amount * $rate / 100;
        return $this;
    }
    public function discount2(float $rate):self {
        $this->amount -=  $this->amount * $rate / 100;
        return self::class;
    }
    public function getAmount():float {
        return $this->amount;
    }
    
    public function __destruct() {
        echo "Destruct ".$this->description."<br>";
    }
}
?>
