<?php 
// OK 👍
ini_set('display_errors','1');
ini_set('display_startup_errors','1');
error_reporting(E_ALL);

//require '../config/Database.php';
require 'models/LoginModel.php';


class Login
{
    // Propriétés encapsulées
    private $email;
    private $password;
    private $template;
    private $LoginModel;
    public string $error = '';

    public function __construct(){
        $this->LoginModel = new LoginModel();
    }
             
    public function showLoginEnseignant()
    {   
        // Vérifier si le formulaire de connexion a été soumis
        if (isset($_POST['email'], $_POST['password'])) {
            // Récupérer les données du formulaire
            $this->email = htmlspecialchars($_POST['email']);
            $this->password = htmlspecialchars($_POST['password']);

            // Instancier le modèle pour vérifier les informations de connexion
            //$loginModel = new LoginModel\LoginModel;

            // Appeler la méthode de vérification des informations de connexion
            $result = $this->LoginModel->checkLoginEnseignant($this->email, $this->password);
            header('Location: index.php?url=profilEnseignant');

            // Vérifier si la connexion a réussi
         
        }
            $this->template = "login";
        // Inclure le template
    

        // Inclure le layout qui gère le header et le footer
        include('views/layout.phtml');
    }
    
        public function showLoginAdmin()
        
    {
        if (isset($_POST['email'], $_POST['password'])) {
            $this->email = htmlspecialchars($_POST['email']);
            $this->password = htmlspecialchars($_POST['password']);

            $result = $this->LoginModel->checkLoginAdmin($this->email, $this->password);

            if ($result) {
                // Connexion réussie
                header('Location: index.php?url=profilAdmin');
                exit;
            } else {
                // Connexion échouée : message d'erreur
                $this->error = "Email ou mot de passe incorrect.";
            }
        }

        // Affichage de la page
        $this->template = "login";
        include('views/layout.phtml');
    }
    public function showLoginEtudiant()
    {
        // Vérifier si le formulaire de connexion a été soumis
        if (isset($_POST['email'], $_POST['password'])) {
            // Récupérer les données du formulaire
            $this->email = htmlspecialchars($_POST['email']);
            $this->password = htmlspecialchars($_POST['password']);

            // Appeler la méthode de vérification des informations de connexion
            $result = $this->LoginModel->checkLoginEtudiant($this->email, $this->password);
                    

               if ($result) {
                // Connexion réussie
                header('Location: index.php?url=profilEtudiant');
                exit;
            } else {
                // Connexion échouée : message d'erreur
                $this->error = "Email ou mot de passe incorrect.";
            }

            // Vérifier si la connexion a réussi
         
        }
        // Affichage de la page
        $this->template = "login";
        include('views/layout.phtml');
    }

    public function test(){
             $result = $this->LoginModel->testAdmin();
    }
}
