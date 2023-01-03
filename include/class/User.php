<?php
class User{
    private $id;
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

    public function __construct(){
        //  La connexion a la BDD.
        $this->bdd = new mysqli($this->servername, $this->username_b, $this->password_b, $this->database);

        // $this->bdd = new mysqli('localhost', 'root', '', 'classes');
    }
        //  method pour se connecter.
    public function connct(){
        //  La connexion a la BDD.
        return $this->bdd;        // $this->bdd = new mysqli('localhost', 'root', '', 'classes');
    }

    public function register($login, $password, $email, $firstname, $lastname){
    
        $this->bdd->query("INSERT INTO `utilisateurs`(`login`, `password`, `email`, `firstname`, `lastname`) VALUES ('$login', '$password', '$email', '$firstname', '$lastname');");
    }

    public function connect(){

    }

    public function disconnect(){

    }

    public function delete(){

    }

    public function update(){

    }

    public function isConnected(){

    }



}