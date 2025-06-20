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
    $query = $this->pdo->prepare("SELECT id, nom, prenom, email, mot_de_passe FROM etudiant WHERE email = ?");
    $query->execute([$email]); // ✅ CORRIGÉ

    $user = $query->fetch(PDO::FETCH_ASSOC);


    if ($user && password_verify($password, $user['mot_de_passe'])) {
        // Démarrer session si besoin
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
            
        }
        
        $_SESSION['id_etudiant'] = $user['id'];
        $_SESSION['nom'] = $user['nom'];
        $_SESSION['prenom'] = $user['prenom'];
        $_SESSION['mot_de_passe'] = $user['mot_de_passe'];
        $_SESSION['email'] = $user['email'];
    
        return true;

    } else {
        if (empty($user)) {
            throw new DomainException("Cette adresse e-mail n'existe pas !");
        }
        return false;
    } 
}

    public function checkLoginEnseignant($email, $password)
{
    $query = $this->pdo->prepare("SELECT id, nom, prenom, email, mot_de_passe FROM enseignants WHERE email = ?");
    $query->execute([$email]);
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['mot_de_passe'])) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['firstname'] = $user['nom'];
        $_SESSION['lastname'] = $user['prenom'];
        $_SESSION['email'] = $user['email'];

        return true;
    } else {
        if (empty($user)) {
            throw new DomainException("Cette adresse e-mail n'existe pas !");
        }
        return false;
    }
}

   public function checkLoginAdmin($email, $password)
{
    $query = $this->pdo->prepare("SELECT id, nom, prenom, Email, password FROM admin WHERE Email = ?");
    $query->execute([$email]); // ✅ CORRIGÉ

    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Démarrer session si besoin
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
            
        }

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['firstname'] = $user['nom'];
        $_SESSION['lastname'] = $user['prenom'];
        $_SESSION['password'] = $user['password'];
        $_SESSION['email'] = $user['Email'];
    
        return true;

    } else {
        if (empty($user)) {
            throw new DomainException("Cette adresse e-mail n'existe pas !");
        }
        return false;
    }
}
 
}
