<?php
require_once "db/database.php";
// 
class NoteModel extends Database
{
    protected $pdo;
    private $NoteModel;
    public function __construct()
    {
        parent::__construct();
        //$this->pdo = new Database();
    }

    private $etudiantId;
    private $profId;
    private $note;
    private $commentaire;

    public function getClass($numPromo)
    {


        try {
            if (isset($numPromo) && is_numeric($numPromo)) {

                $numEtudiant = "SELECT etudiant.id, etudiant.nom, etudiant.prenom, promotion.nom as nom_promo FROM etudiant INNER JOIN promotion ON etudiant.promotion = promotion.id WHERE promotion = :numPromo";
                $stmt = $this->pdo->prepare($numEtudiant);
                $stmt->bindParam(':numPromo', $numPromo);
                $stmt->execute();
                // var_dump($stmt);
               
                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
                // Envoyer la réponse au format JSON
                
            }
        } catch (PDOException $e) {
            echo "ERREUR DE CONNEXION : " . $e->getMessage();
        }

        // Structuration sous format JSON

    }
    public function registerNote($result, $note, $commentaire)
    {   
        

        $profId =$_SESSION['user_id'];
        foreach ($result as $info) {
            $etudiantId= $info['id'];
            $promo = $info['nom_promo'];
            $enregistrerNote = "INSERT INTO notes( promo,EtudiantID, ProfID, Note, Commentaire, DateEnregistrement) VALUES (:promo,:etudiantID, :profID ,:note ,:commentaire , NOW())";
         
           $stmt = $this->pdo->prepare($enregistrerNote);
           $stmt->bindParam(':promo',$promo);
         $stmt->bindParam(':etudiantID',$etudiantId);
         $stmt->bindParam(':profID',$profId);
         $stmt->bindParam(':note',$note);
         $stmt->bindParam(':commentaire',$commentaire);
         $stmt->execute();
         
        }
       
        // 
        //var_dump( $stmt->fetchAll(PDO::FETCH_ASSOC));

        // $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 

        // return $result;
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $notes) {
            $stmt->execute([$note['id'], $profId, $note, $commentaire]);
        }

        // var_dump($result);
        return $result;


    }
}
