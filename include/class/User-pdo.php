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

        //  methode pour verifier l'existance d'un login dans la BDD.
    public function verif_bdd($login){

        $data = $this->bdd->prepare("SELECT * FROM `utilisateurs` WHERE login=?");
        $data->execute(["$login"]);
        return $data->fetchAll(PDO::FETCH_ASSOC);   // la methode return un objet, si il est vide le login n'existe pas. 
        }

        // methode pour enregistrer un user dans la BDD
    public function register($login, $password, $email, $firstname, $lastname){

        $req = $this->bdd->prepare("INSERT INTO `utilisateurs`(`login`, `password`, `email`, `firstname`, `lastname`) VALUES (:login, :password, :email, :firstname, :lastname);");
        $req->execute([":login" => "$login", ":password" => "$password", ":email" => "$email", ":firstname" => "$firstname", ":lastname" => "$lastname"]);
    }


    
}