<?php
use db\Database;


require "models/EnregistrerPresenceModel.php";

class Enregistrer
{
    private $Enregistrer;

    public function __construct()
    {
        $this->Enregistrer = new EnregistrerPresenceModel();
        
    }

    public function doPresence()
    {
       
        if($_SERVER['REQUEST_METHOD']==='POST'){
            
            $numPromo = $_POST['promo'];
            
            if(isset($numPromo) && is_numeric($numPromo))
            {
                
                $result = $this->Enregistrer->getClass($numPromo);
                // var_dump($result);

                if(isset($result))
                {
                    $this->Enregistrer->enregistrerPresence($result);
                    // header("Location: index.php?url=enregistrer");
                    echo json_encode($result);
                    exit;
                } 
                else 
                {
                    echo json_encode(['error'=>"Problème de connexion"]);
                }
            } 
            else 
            {
                echo json_encode(['error'=>"Numéro de promotion invalide"]);
            }
    
           
        }
         // Inclure le layout qui gère le header et le footer
         include('views/enregistrer.phtml');
    }

    // public function updatePresence(){
        
    //     if($_SERVER['REQUEST_METHOD']==='POST'){
            
    //         $numPromo = $_POST['promo'];
            
    //         if(isset($numPromo) && is_numeric($numPromo))
    //         {
                
    //             $result = $this->Enregistrer->getClass($numPromo);
    //             // var_dump($result);

    //             if(isset($result))
    //             {
    //                 $this->Enregistrer->updatePresence($result);
                
    //                 exit;
    //             } 
    //         }
    //     }
    
    // }
}