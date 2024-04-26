<?php
// namespace models;

require_once "db/database.php";

class EnregistrerPresenceModel extends \Database
{
    protected $pdo;
    private $numPromo;
   
    public function __construct(){
        parent::__construct();
    }
    public function getClass($numPromo) {
        try{
           

                 if(isset($numPromo)&&is_numeric($numPromo)){

                $numEtudiant = "SELECT etudiant.id, etudiant.nom, etudiant.prenom, promotion.nom as nom_promo FROM etudiant INNER JOIN promotion ON etudiant.promotion = promotion.id WHERE promotion = :numPromo";
                $stmt = $this->pdo->prepare($numEtudiant);
                $stmt->bindParam(':numPromo', $numPromo, PDO::PARAM_STR);
                $stmt->execute();
                // var_dump($stmt);
        
                return $stmt->fetchAll(\PDO::FETCH_ASSOC); 
                // Envoyer la réponse au format JSON
                $chaine = "[";
                while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $chaine .= "{";
                        $chaine .= "\"nom\" : \"$ligne[nom]\",";
                        $chaine .= "\"prenom\" : \"$ligne[prenom]\",";
                        $chaine .= "\"promotion\" : \"$ligne[nom_promo]\"";
                        $chaine .= "},";
                    }
    $test =json_encode($chaine);
        // Envoyer la réponse au format JSON
        echo $test;
                if (strlen($chaine) > 1) {
                    $chaine = substr($chaine, 0, -1);
                }   
                $chaine .=  "]";
                echo $chaine;
                $stmt->closeCursor();
            }
                } catch (\PDOException $e) {
                    echo "ERREUR DE CONNEXION : " . $e->getMessage();
                }
                
                // Structuration sous format JSON
             
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
            
            


