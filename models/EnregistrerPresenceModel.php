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
    
            
    public function enregistrerPresence($result)
{ 
    // Vérifier si $_POST['statut'] existe et est un tableau
    if (!isset($_POST['statut']) || !is_array($_POST['statut'])) {
        throw new InvalidArgumentException("Statuts d'absence invalides.");
    }

    $statuts = $_POST['statut']; // Supposons que $_POST['statut'] est un tableau indexé séquentiellement

    // Débogage : Afficher les statuts reçus
    var_dump($statuts);

    $requete = "INSERT INTO enregistrerpresence (id_etudiant, promo, status, date) VALUES (:etudiantID, :promo, :statut,now())";
    $stmt = $this->pdo->prepare($requete);

    foreach ($result as $index => $listeAbsence) {
        $etudiantId = $listeAbsence['id'];
        $promo = $listeAbsence['nom_promo'];

        // Vérifier si l'index existe dans le tableau des statuts
        if (isset($statuts[$index])) {
            $statut = $statuts[$index];

            // Assigner les valeurs aux paramètres de la requête
            $stmt->bindValue(':etudiantID', $etudiantId);
            $stmt->bindValue(':promo', $promo);
            $stmt->bindValue(':statut', $statut);

            // Exécuter la requête d'insertion
            $stmt->execute();
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


    public function SuivisPresence(){
        try {
            $sql = "SELECT e.id,e.nom,e.prenom,e.email, 
             SUM(CASE WHEN p.status = 'A' THEN 1 ELSE 0 END) AS total_absences,
             SUM(CASE WHEN p.status = 'R' THEN 1 ELSE 0 END) AS total_retards FROM etudiant e 
            LEFT JOIN enregistrerpresence p ON e.id = p.id_etudiant GROUP BY e.id, e.nom, e.prenom, e.email ORDER BY e.id ASC;
            ";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);        
        } catch (\PDOException $e) {
        echo "ERREUR  : " . $e->getMessage();        }
       
    } 

    public function getStatsPourEtudiant($id_etudiant) {
        $sql = "SELECT 
    e.id,
    e.nom,e.prenom,
    e.email,
    COALESCE(SUM(CASE WHEN p.status = 'A' THEN 1 ELSE 0 END), 0) AS total_absences,
    COALESCE(SUM(CASE WHEN p.status = 'R' THEN 1 ELSE 0 END), 0) AS total_retards
    FROM etudiant e LEFT JOIN enregistrerpresence p ON e.id = p.id_etudiant WHERE e.id = :id GROUP BY e.id, e.nom,e.prenom,e.email
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id_etudiant]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
            
            


