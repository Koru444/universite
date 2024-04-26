<?php

require_once "models/NoteModel.php";

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
      
         try {  
            if($_SERVER['REQUEST_METHOD']==='POST'){
           
                // $result,$profId,$note,$commentaire;
                if(isset($numPromo) && is_numeric($numPromo))
                {
                    $numPromo = $_POST['promos'];

                    $result = $this->Note->getClass($numPromo);
                    var_dump($result);
                    return $result;
                } 

                if(isset($result)){
               
                $note = $_POST['note'];
                $commentaire = $_POST['commentaire'];
                $this->Note->registerNote($result,$note,$commentaire);
                
                // header("Location: index.php?url=enregistrer");
                exit;
                }
                 
                else 
                {
                    echo json_encode(['error'=>"Numero de promotion invalide"]);
                }
        
              
            }  

          
            
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
        
       include('views/note.phtml');
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
