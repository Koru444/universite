<?php

ini_set('display_errors','1');
ini_set('display_startup_errors','1');
error_reporting(E_ALL);

require_once "db/database.php";
//use config\database;

class LoginModel extends Database
{
   
    private $firstname;
    private $lastname;
    private $email;
    private $password;
         
    public function __construct() {
        // Initialise la connexion à la base de données 
        // $this->pdo = Core::getDatabase();
        // $this->pdo = new Database();
        parent::__construct();
    }

    public function checkLoginEtudiant($email, $password)
    {
        // Préparer la requête de sélection pour vérifier les informations de connexion
        $query = $this->pdo->prepare("SELECT  nom, prenom, email, mot_de_passe FROM etudiant WHERE Email = ?");
        $query->execute([$_POST['email']]);
        $user = $query->fetch(PDO::FETCH_ASSOC);
        //var_dump($user);
    //echo($user['password']);
        // Vérifier si l'utilisateur existe et si le mot de passe est correct
        if ($user && password_verify($password, $user['mot_de_passe'])) {
            // Authentification réussie
            // Ouvrir une session (ça permet de sécuriser la connexion)
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['firstname'] = $user['nom'];
            $_SESSION['lastname'] = $user['prenom'];
            $_SESSION['password'] = $user['mot_de_passe'];
            $_SESSION['email'] = $user['email'];
            return true;
            
        } else {
            // Authentification échouée
            //  if (empty($user)) {
            //     throw new DomainException("Cette adresse e-mail n'existe pas !");
            // }
            return false;
        }     

        
    }
    public function checkLoginEnseignant($email, $password)
    {
        // Préparer la requête de sélection pour vérifier les informations de connexion
        $query = $this->pdo->prepare("SELECT id, nom, prenom, email, mot_de_passe FROM enseignants WHERE Email = ?");
        $query->execute([$_POST['email']]);
        $user = $query->fetch(PDO::FETCH_ASSOC);
        //var_dump($user);
    //echo($user['password']);
        // Vérifier si l'utilisateur existe et si le mot de passe est correct
        if ($user && password_verify($password, $user['mot_de_passe'])) {
            // Authentification réussie
            // Ouvrir une session (ça permet de sécuriser la connexion)
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['firstname'] = $user['nom'];
            $_SESSION['lastname'] = $user['prenom'];
            $_SESSION['password'] = $user['mot_de_passe'];
            $_SESSION['email'] = $user['email'];
            return true;
            
        } else {
            // Authentification échouée
            //  if (empty($user)) {
            //     throw new DomainException("Cette adresse e-mail n'existe pas !");
            // }
            return false;
        }     

        
    }
    public function checkLoginAdmin($email, $password)
    {
        // Préparer la requête de sélection pour vérifier les informations de connexion
        $query = $this->pdo->prepare("SELECT id, Firstname, Lastname, Email, password FROM admin WHERE Email = ?");
        $query->execute([$_POST['email']]);
        $user = $query->fetch(PDO::FETCH_ASSOC);
        //var_dump($user);
    //echo($user['password']);
        // Vérifier si l'utilisateur existe et si le mot de passe est correct
        if ($user && password_verify($password, $user['password'])) {
            // Authentification réussie
            // Ouvrir une session (ça permet de sécuriser la connexion)
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['firstname'] = $user['Firstname'];
            $_SESSION['lastname'] = $user['Lastname'];
            $_SESSION['password'] = $user['password'];
            $_SESSION['email'] = $user['Email'];
            return true;
            
        } else {
            // Authentification échouée
            //  if (empty($user)) {
            //     throw new DomainException("Cette adresse e-mail n'existe pas !");
            // }
            return false;
        }     

        
    }
}
