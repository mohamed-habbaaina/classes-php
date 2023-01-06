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


        //  methode pour verifier le Password haché et permettre la connextion.
        public function connect($login,$password){

            // Recherche de l'utilisateur dans la BD..

        $data = $this->verif_bdd($login);
        $coun = count($data);   // count le nombre  

            if($coun === 1):

            // recupérer le password de la DB.
            $password_db = $data[0]['password'];

                // verifier le password Haché.
                if (password_verify($password, $password_db)):
                    return true;
                else: return false;
                endif;
            endif;
    }

    // methode pour modifier le profil de user.
    public function update($login, $password, $email, $firstname, $lastname, $login_ancien){
        $requ_updt = $this->bdd->prepare("UPDATE `utilisateurs` SET login=?, password=?, email=?, firstname=?, lastname=? WHERE login='$login_ancien';");
        $requ_updt->execute(["$login", "$password", "$email", "$firstname", "$lastname" ]);
    }

        // methode pour se deconnecter.
    public function disconnect(){
        $_SESSION = array();//Ecraser le tableau de session 
        session_unset(); //Detruit toutes les variables de la session en cours
        session_destroy();//Destruit la session en cours
    }

        // methode pour suprimé un user.
    public function delete($login){

        $req_delet = $this->bdd->prepare("DELETE FROM `utilisateurs` WHERE login=?;");
        $req_delet->execute(["$login"]);

        $_SESSION = array();//Ecraser le tableau de session 
        session_unset(); //Detruit toutes les variables de la session en cours
        session_destroy();//Destruit la session en cours
    }

        // methode pour verifier que le User est bien connecté.
    public function isConnected(){
        if (isset($_SESSION['login'])):
            return true;
        else:
            return false;
        endif;
    }

}