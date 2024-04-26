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
    public function showProfileAdmin(){

        
        $this->template='admin';
      
   

include('views/layoutAdmin.phtml');

}
}
