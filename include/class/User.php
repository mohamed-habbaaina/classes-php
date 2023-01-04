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
        //  methode pour se connecter.
    public function connct(){
        //  La connexion a la BDD.
        return $this->bdd;        // $this->bdd = new mysqli('localhost', 'root', '', 'classes');
    }

        //  methode pour verifier l'existance d'un login dans la BDD.
    public function verif_bdd($login){
        $req_login = $this->bdd->query("SELECT * FROM `utilisateurs` WHERE login='$login';");
        return mysqli_num_rows($req_login);
    }

    // $req_login = $user->connct()->query("SELECT * FROM `utilisateurs` WHERE login='$login';");
    // $login_verif = mysqli_num_rows($req_login);
// 
    // if ($user->verif_bdd($login) === 1):
// 
        //  verification du passwprd.
        // $requ_fetch = $req_login->fetch_assoc();
        // $password_db = $requ_fetch['password'];
        // var_dump(password_verify($password, $password_db));
        // die;
        // if (password_verify($password, $password_db)):
            
            
            


    public function register($login, $password, $email, $firstname, $lastname){
    
        $this->bdd->query("INSERT INTO `utilisateurs`(`login`, `password`, `email`, `firstname`, `lastname`) VALUES ('$login', '$password', '$email', '$firstname', '$lastname');");
    }

        //  methode pour verifier le Password haché et permettre la connextion.
        public function connect($login, $password){
            $req_login = $this->bdd->query("SELECT password FROM `utilisateurs` WHERE login='$login';");
            $requ_fetch = $req_login->fetch_assoc();
            $password_db = $requ_fetch['password'];
    
            if (password_verify($password, $password_db)):
                return true;
            else: return false;
            endif;
    
        }
    

    public function disconnect(){
        $_SESSION = array();//Ecraser le tableau de session 
        session_unset(); //Detruit toutes les variables de la session en cours
        session_destroy();//Destruit la session en cours
    }

    public function delete($login){

        $this->bdd->query("DELETE FROM `utilisateurs` WHERE login='$login';");

        $_SESSION = array();//Ecraser le tableau de session 
        session_unset(); //Detruit toutes les variables de la session en cours
        session_destroy();//Destruit la session en cours
    }

    public function update(){

    }

    public function isConnected(){

    }



}