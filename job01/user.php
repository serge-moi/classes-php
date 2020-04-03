<?php

class user{

    // Les attributs
    private $id;
    public $login;
    public $email;
    public $firstname;
    public $lastname;


    // Les méthodes
    public function register($login, $password, $email, $firstname, $lastname){
          
         $connexion = mysqli_connect("localhost", "root", "", "poo");
         $requete = "INSERT INTO utilisateurs (login, password, email, firstname, lastname) VALUES ('$login', '$password','$email','$firstname','$lastname')";
         $query = mysqli_query($connexion, $requete);

         $requete2 = "SELECT * FROM utilisateurs WHERE login = '$login'";
         $query2 = mysqli_query($connexion, $requete2);
         $resultat = mysqli_fetch_all($query2,MYSQLI_ASSOC);

         return $resultat;
      
    }

    public function connect($login, $password){

          $connexion = mysqli_connect("localhost", "root", "", "poo");
          $requete3 = "SELECT * FROM utilisateurs WHERE login = '$login'";
          $query3 = mysqli_query($connexion, $requete3);
          $resultat2 = mysqli_fetch_all($query3,MYSQLI_ASSOC);

          if($password == $resultat2[0]['password'])
          {
          	    $_SESSION['login'] = $login;
                $_SESSION['password'] = $password;
                $this->id = $resultat2[0]['id'];
                $this->login= $resultat2[0]['login'];
                $this->email = $resultat2[0]['email'];
                $this->firstname = $resultat2[0]['firstname'];
                $this->lastname = $resultat2[0]['lastname'];

          }

         $info = array($this->id , $this->login, $this->email, $this->firstname, $this->lastname);
         return $info;
    }

    public function disconnect(){
         session_unset();
         session_destroy();
         $this->id = null;
         $this->login= null;
         $this->email = null;
         $this->firstname = null;
         $this->lastname = null;
    }

     public function delete(){
         $connexion = mysqli_connect("localhost", "root", "", "poo");
         $requetedel = "DELETE FROM utilisateurs WHERE login = '$this->login'";
         $querydel = mysqli_query($connexion, $requetedel);
         $this->disconnect();

        
    }

    public function update($login, $password, $email, $firstname, $lastname){
         $connexion = mysqli_connect("localhost", "root", "", "poo");
         $requeteupdate = "UPDATE utilisateurs SET login = '$login', password='$password', email='$email', firstname='$firstname', lastname ='$lastname' WHERE login = '$this->login'";
         $queryupdate = mysqli_query($connexion, $requeteupdate);
    }

    public function isConnected(){
        if (isset($this->login)) {
        	return true;
        }
        else
        {
        	return false;
        }
    }

    public function getAllInfos(){
      $info = array($this->id ,$this->id, $this->login, $this->email, $this->firstname, $this->lastname);
      return $info;
    }

     public function getLogin(){
      return $this->login;
    }

    public function getEmail(){
      return $this->email;
    }

    public function getFirstname(){
      return $this->firstname;
    }

    public function getLastname(){
      return $this->lastname;
    }

    public function refresh(){
          $connexion = mysqli_connect("localhost", "root", "", "poo");
          $refresh = "SELECT * FROM utilisateurs WHERE login = '$this->login'";
          $queryrefresh = mysqli_query($connexion, $refresh);
          $resultatrefresh = mysqli_fetch_all($queryrefresh,MYSQLI_ASSOC);

          $this->id = $resultatrefresh[0]['id'];
          $this->login= $resultatrefresh[0]['login'];
          $this->email = $resultatrefresh[0]['email'];
          $this->firstname = $resultatrefresh[0]['firstname'];
          $this->lastname = $resultatrefresh[0]['lastname'];
    }

}

?>