<?php
// namespace models;

require_once "C:\wamp64\www\universite\db\database.php";
//include_once dirname($_SERVER['DOCUMENT_ROOT']).'/universite/db/database.php';


class EnregistrerPresenceModel extends \Database
{
    protected $pdo;
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
                var_dump($resultats);
                // Convertir les résultats en JSON
                $jsonResponse = json_encode($resultats);
    // var_dump($jsonResponse);
                // Envoyer la réponse JSON
                // header('Content-Type: application/json');
                // echo $jsonResponse;
                return $resultats;
            }
        } catch (\PDOException $e) {
            echo "ERREUR DE CONNEXION : " . $e->getMessage();
        }
    }
    
            
    public function enregistrerPresence($result)
    { 
        // Appeler la fonction getClass pour obtenir les données
        //   $listeAbsences=  $this->getClass($this->numPromo);
        //     var_dump($listeAbsences);
            
            foreach ($result as $listeAbsence) {
                
                    $id = $listeAbsence['id'];
                    $promotion = $listeAbsence['nom_promo'];
                    // $statut = $_POST['statut'];
                    $requete = "INSERT INTO enregistrerpresence (id_etudiant, promo) VALUES ('$id','$promotion')";
             $stmt2 = $this->pdo->query($requete);
                    // Utiliser $this->connexion au lieu de créer une nouvelle connexion
                    if(isset($_POST['ok'])){ 
                        $stmt2->execute();

                } 
        }                

    } 
            // Récupérer les données sous forme de tableau associatif
            public function modifierPresence($result,$statut){
                try {
                    foreach ( $result as $listeAbsence) {
                
                        $id = $listeAbsence['id'];
                    }
                    $sql = "UPDATE enregistrerpresence  set statut=:statut WHERE id = :id";
                    $requete = $this->pdo->bindParam($sql);
                    $requete->bindValue(':statut',$statut);
                    $requete->bindValue(':id',$id);
                    $requete->execute();               
                 } catch (\PDOException $e) {
                    echo "ERREUR DE CONNEXION : " . $e->getMessage();
                }
                
          

            }
} // Utiliser une requête préparée
            
            


