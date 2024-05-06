<?php

include_once "models\NoteModel.php";

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
            if (isset($_POST['promos'])) {
                $numPromo = $_POST['promos'];
                var_dump($numPromo);
            }
            if($_SERVER['REQUEST_METHOD']==='POST'){
           
                // $result,$profId,$note,$commentaire;
                if(isset($numPromo) && is_numeric($numPromo))
                {
                  

                    $result = $this->Note->getClass($numPromo);
                    json_encode($result);
                    
                    return $result;
                }else {
                    echo json_encode(['error'=>"Numero de promotion invalide"]);
                }

                if(isset($result)){
               
                $note = $_POST['note'];
                $commentaire = $_POST['commentaire'];
                $this->Note->registerNote($result,$note,$commentaire);
                
                // header("Location: index.php?url=enregistrer");
                exit;
                }
                 
        
              
            }  

          
            
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
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
