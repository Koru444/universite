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
        // Vérifier si le formulaire de connexion a été soumis
        if (isset($_POST['email'], $_POST['password'])) {
            // Récupérer les données du formulaire
            $this->email = htmlspecialchars($_POST['email']);
            $this->password = htmlspecialchars($_POST['password']);

            // Instancier le modèle pour vérifier les informations de connexion
            //$loginModel = new LoginModel\LoginModel;

            // Appeler la méthode de vérification des informations de connexion
            $result = $this->LoginModel->checkLoginAdmin($this->email, $this->password);
            header('Location: index.php?url=profilAdmin');

            // Vérifier si la connexion a réussi
         
        }

        // Inclure le template
        $this->template = "login";

        // Inclure le layout qui gère le header et le footer
        include('views/layout.phtml');
    }
    public function showLoginEtudiant()
    {
        // Vérifier si le formulaire de connexion a été soumis
        if (isset($_POST['email'], $_POST['password'])) {
            // Récupérer les données du formulaire
            $this->email = htmlspecialchars($_POST['email']);
            $this->password = htmlspecialchars($_POST['password']);

            // Instancier le modèle pour vérifier les informations de connexion
            //$loginModel = new LoginModel\LoginModel;

            // Appeler la méthode de vérification des informations de connexion
            $result = $this->LoginModel->checkLoginEtudiant($this->email, $this->password);

            // Vérifier si la connexion a réussi
         
        }

        // Inclure le template
        $this->template = "login";

        // Inclure le layout qui gère le header et le footer
        include('views/layout.phtml');
    }
}
