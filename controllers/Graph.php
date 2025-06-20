<?php
ini_set('display_errors','1');
ini_set('display_startup_errors','1');
error_reporting(E_ALL);
require_once ('db/database.php');
include $_SERVER['DOCUMENT_ROOT'] . '/universite/models/GraphModel.php';



class Graph {

    public function __construct(){
        // Initialiser la propriété $this->Note avec une instance de la classe NoteModel
        $this->Graph = new GraphModel();

    }
   private $template;
   private $db;
    private $Graph;
    private $Login;
    private $graphData;

public function ShowGraph()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['id_etudiant'])) {
        echo "Accès refusé. Vous devez être connecté.";
        exit;
    }

    $idEtudiant = $_SESSION['id_etudiant'];
    

    $graphData = $this->Graph->getAbsRetard($idEtudiant);

    $this->template = "graph";
    include('views/layoutEtudiant.phtml');
}
    
    // public function getNote($id){
    // $sql = "SELECT * FROM notes WHERE EtudiantID = :id";
    //     $stmt = $this->pdo->prepare($sql);
    //     $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    //     $stmt->execute();
    //     return $stmt->fetch(PDO::FETCH_ASSOC); // Renvoie un tableau associatif des données de l'étudiant    }
    // }
    
}
?>
