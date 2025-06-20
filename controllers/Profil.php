<?php

ini_set('display_errors','1');
ini_set('display_startup_errors','1');
error_reporting(E_ALL);
class Profil
{
    private $db;
    private $template;



    public function showProfileEnseignant(){

       
            
                $this->template='enseignant';

        
        include('views/layoutEnseignant.phtml');

    }


    public function showProfileEtudiant(){

        
                $this->template='etudiant';
              
           
    
        include('views/layoutEtudiant.phtml');

    }
    public function showProfileAdmin()
    {
        // Démarrer la session si elle n'est pas déjà active
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Vérifier si l'admin est connecté (sinon rediriger)
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?url=loginAdmin');
            exit;
        }

        // Définir le template à utiliser
        $this->template = 'admin';

        // Inclure le layout qui charge la vue et les parties communes
        include('views/layoutAdmin.phtml');
    }
}
