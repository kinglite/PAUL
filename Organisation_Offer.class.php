<?php

class Organisation_Offer{
    
    //Constants of the table
    const TABLENAME = 'organisation_offer';
    
    //columns of this table:
    const cOrga = 'organisation';
    const cStartC = 'startCountry';
    const cstartV = 'startVillage';
    const cdestC = 'destinationCountry';
    const cdestV = 'destinationVillage';
    const cdate = 'startDate';
    const cproduct = 'product';
    const crespAcc = 'responsibleAcc';
    
    //variables for datainput
    /*private $ID;
    private $organisation;
    private $startCountry;
    private $startVillage;
    private $destCountry;
    private $destVillage;
    private $startDate;
    private $product;
    private $responsibleAcc;*/
    
    public function __construct(){
        
    }
    
    /*public function __construct($orga_name, $startCountry, $startVillage,
                        $destinationCountry, $destinationVillage, $date, $product, $account) {
        
        $this->organisation = $orga_name;
        $this->startCountry = $startCountry;
        $this->startVillage = $startVillage;
        $this->destCountry = $destinationCountry;
        $this->destVillage = $destinationVillage;
        $this->startDate = $date;
        $this->product = $product;
        $this->responsibleAcc = $account;
        
    }*/
    
    function create_Orga_Offer( $orga_name, $startCountry, $startVillage,
                        $destCountry, $destVillage, $date, $product)
    {

        $username = 'guest';
        $password = '';
        $db = new PDO('mysql:host=localhost;
                        dbname=PAUL;
                        charset=utf8', $username , $password, 
                        array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        $statement = $db->prepare("INSERT INTO " . $this::TABLENAME 
                . "                 ($this->cOrga, "
                . "                  $this->cStartC, "
                . "                  $this->cstartV, "
                . "                  $this->cdestC, "
                . "                  $this->cdestV, "
                . "                  $this->cdate, "
                . "                  $this->cproduct, "
                . "                  $this->crespAcc) VALUES(?,?,?,?,?,?,?,?)");
        
        $statement->execute(array(  $orga_name, 
                                    $startCountry, 
                                    $startVillage,
                                    $destCountry, 
                                    $destVillage, 
                                    $date, 
                                    $product, 
                                    $username ));
        /*$statement->execute(array(  $this->orga_name, 
                                    $this->startCountry, 
                                    $this->startVillage,
                                    $this->destinationCountry, 
                                    $this->destinationVillage, 
                                    $this->date, 
                                    $this->product, 
                                    $this->username ));*/
    }
    
}



