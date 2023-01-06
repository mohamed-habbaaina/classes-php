<?php
class Userpdo
{
    public $login;
    private $password;
    public $email;
    public $firstname;
    public $lastname;

    // La BDD.
    private $servername = 'localhost';
    private $username_b = 'root';
    private $password_b = '';
    private $database = 'classes';

    private $bdd;

    public function __construct()
    {
        //  La connexion a la BDD.
        try {
            $this->bdd = new PDO("mysql:host=$this->servername;dbname=$this->database", "$this->username_b", "$this->password_b");
        }
       catch(PDOException $e){
            echo $e->getMessage();
       } 
    }


}