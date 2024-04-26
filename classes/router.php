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
                        'enregistrerEtudiant'  => ['controllers' => 'Admin','method' =>'createEtudiant'],
                        'enregistrerEnseignant' =>['controllers' => 'Admin', 'method'=>'createEnseignant'],
                        'note'          => ['controllers' => 'Note','method' => 'doNote'],
                        'profilAdmin'  => ['controllers' => 'Profil', 'method' =>'showProfileAdmin'],
                        'profilEtudiant'     => ['controllers' => 'Profil', 'method' => 'showProfileEtudiant'],
                        'profilEnseignant'   => ['controllers' => 'Profil', 'method' => 'showProfileEnseignant'],
                        'logout'        => ['controllers' => 'Logout','method' => 'forLogout'],
                        'listeEnseignants' => ['controllers' => 'Admin', 'method'=>'getEnseignants'],  
                        'listeEtudiants'   => ['controllers' => 'Admin', 'method'=>'getEtudiants'],

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