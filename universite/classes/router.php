<?php

// La class router va créer les routes et trouver les controllers

class Router
{
    private $request;

    private $routes = [ 
                        'home'          => ['controllers' => 'Home', 'method' => 'showHome'], 
                        'register'      => ['controllers' => 'Register', 'method' => 'showRegister'],
                        'loginAdmin'       => ['controllers' => 'Login', 'method' => 'showLoginAdmin'],
                        'loginEnseignant'  => ['controllers' => 'Login', 'method' => 'showLoginEnseignant'],
                        'loginEtudiant' => ['controllers' => 'Login', 'method' => 'showLoginEtudiant'],
                        'enregistrer'   => ['controllers' => 'Enregistrer', 'method' => 'doPresence'],
                        'admin-enregistrer'   => ['controllers' => 'Enregistrer', 'method' => 'doPresenceAdmin'],
                        'enregistrerEtudiant'  => ['controllers' => 'Admin','method' =>'createEtudiant'],
                        'enregistrerEnseignant' =>['controllers' => 'Admin', 'method'=>'createEnseignant'],
                        'note'          => ['controllers' => 'Note','method' => 'doNote'],
                        'admin-note'          => ['controllers' => 'Note','method' => 'doNoteAdmin'],
                        'profilAdmin'  => ['controllers' => 'Profil', 'method' =>'showProfileAdmin'],
                        'profilEtudiant'     => ['controllers' => 'Profil', 'method' => 'showProfileEtudiant'],
                        'profilEnseignant'   => ['controllers' => 'Profil', 'method' => 'showProfileEnseignant'],
                        'logout'        => ['controllers' => 'Logout','method' => 'forLogout'],
                        'listeEnseignants' => ['controllers' => 'Admin', 'method'=>'getEnseignants'],  
                        'listeEtudiants'   => ['controllers' => 'Admin', 'method'=>'getEtudiants'],
                        'register-enseignant'=>['controllers' => 'Admin', 'method'=> 'createEnseignant'],
                        'register-etudiant' =>['controllers' => 'Admin', 'method'=>  'createEtudiant'],
                        'admin-enseignants' =>['controllers' => 'Admin', 'method'=>  'homeAdminEnseignant'],
                        'admin-etudiants' =>['controllers' => 'Admin', 'method'=>  'homeAdminEtudiant'],
                        'update-enseignant'=>['controllers'=> 'Admin','method'=> 'updateEnseignants'],
                        'update-etudiant'=>['controllers'=> 'Admin','method'=> 'updateEtudiants'],
                        'delete-enseignant'=>['controllers'=> 'Admin','method'=>  'deleteEnseignant'],
                        'delete-etudiant'=>['controllers'=> 'Admin','method'=>  'deleteEnseignant']

                    ];

    public function __construct($request)
    {
        $this->request = $request;
    }
    

    public function renderControllers()
    {
        $request = $this->request;
        
        if(key_exists($request, $this->routes))
        {
            $controllers = $this->routes[$request]['controllers'];
            $method = $this->routes[$request]['method'];

            $currentController = new $controllers();
            $currentController->$method();

        } else {
            echo 'Erreur 404 - Page introuvable';
        }
    }
}