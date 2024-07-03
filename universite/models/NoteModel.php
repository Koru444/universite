<?php

require_once "C:\wamp64\www\universite\db\database.php";
// 
class NoteModel extends \Database
{
    protected $pdo;
    private $NoteModel;
    

    private $etudiantId;
    private $profId;
    private $note;
    private $commentaire;
    private $numPromo;
   
    public function __construct(){
        parent::__construct();
    }

    public function getClass($numPromo) {
        try {
            if (isset($numPromo) && is_numeric($numPromo)) {
                $numEtudiant = "SELECT etudiant.id, etudiant.nom, etudiant.prenom, promotion.nom as nom_promo FROM etudiant INNER JOIN promotion ON etudiant.promotion = promotion.id WHERE promotion = :numPromo";
                $stmt = $this->pdo->prepare($numEtudiant);
                $stmt->bindParam(':numPromo', $numPromo, PDO::PARAM_STR);
                $stmt->execute();
            
                // Récupérer les résultats sous forme de tableau associatif
                $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);
                // Convertir les résultats en JSON
                $jsonResponse = json_encode($resultats);
    // var_dump($jsonResponse);
                // Envoyer la réponse JSON
                // header('Content-Type: application/json');
                    return $resultats;
            }
        } catch (\PDOException $e) {
            echo "ERREUR DE CONNEXION : " . $e->getMessage();
        }
    }
    public function registerNote($result, $notes, $commentaires)
    {
        $enregistrerNote = "INSERT INTO notes(promo, EtudiantID, ProfID, Note, Commentaire, DateEnregistrement) VALUES (:promo, :etudiantID, :profID, :note, :commentaire, NOW())";
        
        $stmt = $this->pdo->prepare($enregistrerNote);
        
        // Récupérer l'ID du professeur depuis la session
        $profId = $_SESSION['user_id'];
        
        // Parcourir les indices des tableaux $notes et $commentaires
        foreach (array_keys($result) as $index) {
            $etudiantId = $result[$index]['id'];
            $promo = $result[$index]['nom_promo'];
            $note = $notes[$index];
            $commentaire = $commentaires[$index];
    
            // Assigner les valeurs aux paramètres de la requête
            $stmt->bindParam(':promo', $promo);
            $stmt->bindParam(':etudiantID', $etudiantId);
            $stmt->bindParam(':profID', $profId);
            $stmt->bindParam(':note', $note);
            $stmt->bindParam(':commentaire', $commentaire);
            
            // Exécuter la requête d'insertion
            $stmt->execute();
        }
    }
        // foreach ($result as $info ) {
            //  $profId =$_SESSION['user_id'];
            //  $etudiantId= $info['id'];
            // $promo = $info['nom_promo'];
        //     $enregistrerNote = "INSERT INTO notes( promo,EtudiantID, ProfID, Note, Commentaire, DateEnregistrement) VALUES (:promo,:etudiantID, :profID ,:note ,:commentaire , NOW())";
            
        //     $stmt = $this->pdo->prepare($enregistrerNote);
        //     $stmt->bindParam(':promo',$promo);
        //     $stmt->bindParam(':etudiantID',$etudiantId);
        //     $stmt->bindParam(':profID',$profId);
        //     $stmt->bindParam(':commentaire',$commentaire);
        //     foreach($note as $notes){
        //         $stmt->bindParam(':note',$notes);
        //         $stmt->execute();
                
        //     }
         
        // }
       
     

    //     // return $result;
    //     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      

    //     // var_dump($result);
    //     return $result;


    // }
}
