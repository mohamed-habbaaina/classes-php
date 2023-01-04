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

    // methode pour enregistrer un user dans la BDD
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
    
    // methode pour se deconnecter.
    public function disconnect(){
        $_SESSION = array();//Ecraser le tableau de session 
        session_unset(); //Detruit toutes les variables de la session en cours
        session_destroy();//Destruit la session en cours
    }

    // methode pour suprimé un user.
    public function delete($login){

        $this->bdd->query("DELETE FROM `utilisateurs` WHERE login='$login';");

        $_SESSION = array();//Ecraser le tableau de session 
        session_unset(); //Detruit toutes les variables de la session en cours
        session_destroy();//Destruit la session en cours
    }

        // methode pour modifier le profil de user.
    public function update($login, $password, $email, $firstname, $lastname){
    
        $this->bdd->query("INSERT INTO `utilisateurs`(`login`, `password`, `email`, `firstname`, `lastname`) VALUES ('$login', '$password', '$email', '$firstname', '$lastname');");
    }

        // methode pour verifier que le User est bien connecté.
    public function isConnected(){
        if (isset($_SESSION['login'])):
            return true;
        else:
            return false;
        endif;
    }

    //  Methode pour afficher les infos de user.
    public function getAllInfos($login){
        $req_login = $this->bdd->query("SELECT * FROM `utilisateurs` WHERE login='$login';");
        $requ_fetch = $req_login->fetch_assoc();
        $login = $requ_fetch['login'];
        $firstname = $requ_fetch['firstname'];
        $lastname = $requ_fetch['lastname'];
        $email = $requ_fetch['email'];
        return
            '<table>
                <thead>
                <tr>
                <th>login</th>
                <th>firstname</th>
                <th>lastname</th>
                <th>email</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>' . $login . '</td>
                    <td>' . $firstname . '</td>
                    <td>' . $lastname . '</td>
                    <td>' . $email . '</td>
                    </tr>
                </tbody>
            </table>';
    }

    //  Methode pour return le Login.
    public function getLogin($login){
        $req_login = $this->bdd->query("SELECT `login` FROM `utilisateurs` WHERE login='$login';");
        $requ_fetch = $req_login->fetch_assoc();
        return $requ_fetch['login'];
    }

    //  Methode pour return l'Email.
    public function getLogetEmail($login){
        $req_login = $this->bdd->query("SELECT `email` FROM `utilisateurs` WHERE login='$login';");
        $requ_fetch = $req_login->fetch_assoc();
        return $requ_fetch['email'];
    }

    //  Methode pour return le Firstname.
    public function getFirstname($login){
        $req_login = $this->bdd->query("SELECT `firstname` FROM `utilisateurs` WHERE login='$login';");
        $requ_fetch = $req_login->fetch_assoc();
        return $requ_fetch['firstname'];
    }

    //  Methode pour return le Lasttname.
    public function getLastname($login){
        $req_login = $this->bdd->query("SELECT `lastname` FROM `utilisateurs` WHERE login='$login';");
        $requ_fetch = $req_login->fetch_assoc();
        return $requ_fetch['lastname'];
    }
}