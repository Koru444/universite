<?php

// OK 👍

ini_set('display_errors','1');
ini_set('display_startup_errors','1');
error_reporting(E_ALL);

//require '../config/Database.php';
require 'models/RegisterEnseignantModel.php';

class Register
{
    // Propriétés encapsulées
    private $firstname;
    private $lastname;
    private $email;
    private $password;
    private $template;
    private $RegisterModel;

    public function __construct(){
        $this->RegisterModel = new RegisterEnseignantModel();
    }

    public function showRegister()
    {
        // Vérifier si le formulaire a été soumis
        if (isset($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password'])) {
            // Récupérer les données du formulaire
            $this->firstname = htmlspecialchars($_POST['firstname']);
            $this->lastname = htmlspecialchars($_POST['lastname']);
            $this->email = htmlspecialchars($_POST['email']);
            $this->password = htmlspecialchars($_POST['password']);

            // Obtenir la date actuelle
            $date = date("Y-m-d H:i:s");

            // Instancier le modèle pour effectuer l'ajout de l'utilisateur
            //$registerModel = new RegisterModel\RegisterModel;

            // Appeler la méthode d'ajout d'utilisateur
            $result = $this->RegisterModel->registerAdmin($this->firstname,$this->lastname, $this->email, $this->password, $date);

            // Vérifier si l'inscription a réussi
            if ($result) {
                echo "Inscription réussie";
                header("Location: index.php?url=login");
            } else {
                echo "Erreur lors de l'inscription";
            }
        }

        // Inclure le template
        $this->template = "register";

        // Inclure le layout qui gère le header et le footer
        include('views/layout.phtml');
    }
}
