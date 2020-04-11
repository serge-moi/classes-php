<?php

class lpdo{

    private $isConnected = false;
    private $connexion;
    private $lastQuery = "none";
    private $lastResultat = "none";

    public function constructeur($host, $username, $password, $db){
    $this->connexion = mysqli_connect("$host", "$username", "$password", "$db");

    if($this->connexion != false)
    {
        $this->isConnected = true;
    }
    else{
        $this->isConnected = false;
    }
    return $this->isConnected;
    }


    public function connect($host, $username, $password, $db){

        if(($this->isConnected) == true)
        {
        mysqli_close($this->connexion);
        $this->isConnected = false;
        }
        $this->connexion = mysqli_connect("$host", "$username", "$password", "$db");
        $this->isConnected = true;

    return $this->isConnected;
    }


    public function destructeur(){
        
        if(($this->isConnected) == true)
        {
            mysqli_close($this->connexion);
            $this->isConnected = false;
        }

    return $this->isConnected;
    }


    public function close(){
        
        if(($this->isConnected) == true)
        {
            mysqli_close($this->connexion);
            $this->isConnected = false;
        }

    return $this->isConnected;
    }


    public function execute($query){
        
        if(($this->isConnected) == true)
        {
            $requete = mysqli_query($this->connexion, $query);
            $resultat = mysqli_fetch_all($requete,MYSQLI_ASSOC);
            $this->lastQuery = "$query";
            $this->lastResultat = $resultat;
        }
    return $resultat;
    }


    public function getLastQuery(){
        
        if(($this->lastQuery) != "none")
        {
            return $this->lastQuery;
        }
        else{
            return false;
        }
    }


    public function getLastResultat(){
        
        if(($this->lastResultat) != "none")
        {
            return $this->lastResultat;
        }
        else{
            return false;
        }
    }


    public function getTables(){
        return $this->execute("Select TABLE_NAME FROM information_schema.tables WHERE table_type = 'base table' AND table_schema='poo'");
    }


    public function getFields($table){
        return $this->execute("Select COLUMN_NAME FROM information_schema.columns WHERE table_name='$table' AND table_schema='poo' ");
    }

}
?>