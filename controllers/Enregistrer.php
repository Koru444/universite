<?php
//use db\Database;


//include __DIR__ .'../models/EnregistrerPresenceModel.php';
include dirname($_SERVER['DOCUMENT_ROOT']).'/universite/models/EnregistrerPresenceModel.php';

class Enregistrer
{
    private $Enregistrer;
    private $numPormo;

    public function __construct()
    {
        $this->Enregistrer = new EnregistrerPresenceModel();
        
        
    }
    
    
    public function doPresence()
    {  
        
        
        // if(isset($_POST['num_promo'])){
            // $numPromo = $_POST['num_promo'];
            $numPromo =1;
        
                $result = $this->Enregistrer->getClass($numPromo);
                if(isset($result))
                {
                    $this->Enregistrer->enregistrerPresence($result);
                    json_encode($result);
                    exit;
                } 
                else 
                {
                    echo json_encode(['error'=>"Problème de connexion"]);
                }
             
                // Inclure le layout qui gère le header et le footer
            // } 
            $this->template='enregistrer';
           include('views/layout.phtml');
        }
      
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
// }