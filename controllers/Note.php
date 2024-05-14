<?php

include dirname ($_SERVER['DOCUMENT_ROOT']).'/universite/models/NoteModel.php';

class Note
{
    private $Note;
    private $numPromo;
    private $template;
    public function __construct(){
        // Initialiser la propriété $this->Note avec une instance de la classe NoteModel
        $this->Note = new NoteModel();

    }
    
    public function doNote(){
      
        
        $numPromo = $_POST['promos'];
        $result = $this->Note->getClass($numPromo);
        
        if ($_POST) {
            // Vérifier si $result n'est pas vide avant de traiter les présences
            if (!empty($result)) {
                $note = $_POST['note'];
                $commentaire = $_POST['commentaire'];
                $this->Note->registerNote($result,$note,$commentaire);
              
                //echo json_encode(['success' => true]);  Réponse JSON pour indiquer le succès
            } else {
                echo json_encode(['error' => "Aucun résultat pour cette promotion"]);
            }
        } 
           
                // $result,$profId,$note,$commentaire;
                
                  $this->template = "note";
                  include('views/layoutAdmin.phtml');
                
    }
                 
        
              
            

          
            

    



    public function testNote(){
        try {
            if(isset($result))
            {
               
                $note = $_POST['note'];
                $commentaire = $_POST['commentaire'];
                $this->Note->registerNote($result,$note,$commentaire);
                
                // header("Location: index.php?url=enregistrer");
                exit;
            } 
            else 
            {
                echo json_encode(['error'=>"Problème de connexion"]);
            } 
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
