<?php
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
        
            if (isset($_POST['promo'])) {
                $numPromo = $_POST['promo'];
                $result = $this->Enregistrer->getClass($numPromo);
                
                // Vérifier si $result n'est pas vide avant de traiter les présences
                if (!empty($result)) {
                    $this->Enregistrer->enregistrerPresence($result);
                    //echo json_encode(['success' => true]);  Réponse JSON pour indiquer le succès
                } else {
                    echo json_encode(['error' => "Aucun résultat pour cette promotion"]);
                }
            } 
            $this->template = 'enregistrer';
            include('views/layoutEnseignant.phtml');
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
    ?>