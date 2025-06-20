<?php

// include dirname ($_SERVER['DOCUMENT_ROOT']).'/universite/models/NoteModel.php';
include $_SERVER['DOCUMENT_ROOT'] . '/universite/models/NoteModel.php';

class Note
{
    private $Note;
    private $numPromo;
    private $template;
    public function __construct(){
        // Initialiser la propriété $this->Note avec une instance de la classe NoteModel
        $this->Note = new NoteModel();

    }
    
    public function doNote() {
        if ($_POST) {
            // Vérifier si la clé 'promos' existe dans le tableau $_POST
            if (isset($_POST['promos'])) {
                $numPromo = $_POST['promos'];
                $result = $this->Note->getClass($numPromo);
    
                // Vérifier si $result n'est pas vide avant de traiter les notes
                if (!empty($result)) {
                    // Vérifier si les clés 'note' et 'commentaire' existent dans le tableau $_POST
                    if (isset($_POST['note']) && isset($_POST['commentaire'])) {
                        $note = $_POST['note'];
                        $commentaire = $_POST['commentaire'];
                        $this->Note->registerNote($result, $note, $commentaire);
    
                        // Réponse JSON pour indiquer le succès
                        // echo json_encode(['success' => true]);
                    } else {
                        echo json_encode(['error' => "Les clés 'note' et/ou 'commentaire' sont manquantes dans le tableau \$_POST"]);
                    }
                } else {
                    echo json_encode(['error' => "Aucun résultat pour cette promotion"]);
                }
            } else {
                echo json_encode(['error' => "La clé 'promos' n'existe pas dans le tableau \$_POST"]);
            }
        }
    
        $this->template = "note";
        include('views/layoutEnseignant.phtml');
    }
    
        
    public function doNoteAdmin() {
        if ($_POST) {
            // Vérifier si la clé 'promos' existe dans le tableau $_POST
            if (isset($_POST['promos'])) {
                $numPromo = $_POST['promos'];
                $result = $this->Note->getClass($numPromo);
    
                // Vérifier si $result n'est pas vide avant de traiter les notes
                if (!empty($result)) {
                    // Vérifier si les clés 'note' et 'commentaire' existent dans le tableau $_POST
                    if (isset($_POST['note']) && isset($_POST['commentaire'])) {
                        $note = $_POST['note'];
                        $commentaire = $_POST['commentaire'];
                        $this->Note->registerNote($result, $note, $commentaire);
    
                        // Réponse JSON pour indiquer le succès
                        // echo json_encode(['success' => true]);
                    } else {
                        echo json_encode(['error' => "Les clés 'note' et/ou 'commentaire' sont manquantes dans le tableau \$_POST"]);
                    }
                } else {
                    echo json_encode(['error' => "Aucun résultat pour cette promotion"]);
                }
            } else {
                echo json_encode(['error' => "La clé 'promos' n'existe pas dans le tableau \$_POST"]);
            }
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
public function GetNotEtudiant() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['id_etudiant'])) {
        echo "Accès refusé. Vous devez être connecté.";
        exit;
    }

    $idEtudiant = $_SESSION['id_etudiant'];

    // Récupération des notes
    $noteEtudiant = $this->Note->getNoteForEtudiant($idEtudiant);

    // Si besoin de vérifier
    // var_dump($noteEtudiant); exit;

    $this->template = "note-etudiant";
    include('views/layoutEtudiant.phtml');
}
}
