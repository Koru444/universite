<?php
 require_once('db/database.php');

 class AdminModel extends Database{
    public function __construct(){
        parent::__construct();

    }
    protected $pdo;


    public function CreateEnseignant($nom, $prenom, $email, $mdp) {
        try {
            // Hashage du mot de passe
            $mdpHashed = password_hash($mdp, PASSWORD_DEFAULT);
    
            // Préparation de la requête SQL
            $sql = "INSERT INTO enseignants (nom, prenom, email, mot_de_passe, creationTimeStamp) VALUES (:nom, :prenom, :email, :mot_de_passe, NOW())";
            $stmt = $this->pdo->prepare($sql);
    
            // Liaison des paramètres
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':mot_de_passe', $mdpHashed);
            // Exécution de la requête
            $stmt->execute();
            return true; // Retourne true en cas de succès
        } catch (PDOException $e) {
            // Gérer l'erreur
            die("Erreur lors de l'envoi du formulaire : " . $e->getMessage());
        }
    }
    

    public function CreateEtudiant($nom,$prenom,$sexe,$age,$tel,$email,$mdp,$promotion){

        try {
            $sql =" INSERT INTO etudiant( nom, prenom, sexe, age , tel, email, mot_de_passe, promotion) VALUES (:nom, :prenom, :sexe, :age, :tel, :email, :mot_de_passe, :promotion)"; 
       $mdp= password_hash($mdp,PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nom',$nom);
        $stmt->bindParam(':prenom',$prenom);
        $stmt->bindParam(':sexe',$sexe);
        $stmt->bindParam(':age',$age);
        $stmt->bindParam(':tel',$tel);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':mot_de_passe',$mdp);
        $stmt->bindParam(':promotion',$promotion);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
        die( "erreur de l'envoie du formule".$e->getMessage() );
        }
        
    
    }
    
    public function getEnseignants(){
        $sql=" SELECT * FROM enseignants " ;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getEnseignant($id){
        $sql=" SELECT * FROM enseignants WHERE id = :id" ;
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    
    }
     
    public function getEtudiants(){
        $sql=" SELECT * FROM etudiant " ;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function getEtudiant($id) {
        $sql = "SELECT * FROM etudiant WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Renvoie un tableau associatif des données de l'étudiant
    }
    



    
    public function updateEnseignant($id) {
      
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
        
            try {
                $sql = "UPDATE enseignants SET nom = :nom, prenom = :prenom, email = :email WHERE id = :id";
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
                $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
        
                echo "Enseignant mis à jour avec succès.";
            } catch (PDOException $e) {
                die("Erreur lors de la mise à jour : " . $e->getMessage());
            }
        }
   
}
    

    public function updateEtudiant($id){
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $tel = $_POST['tel'];
        
            try {
                $sql = "UPDATE etudiant SET nom = :nom, prenom = :prenom, email = :email,tel = :tel WHERE id = :id";
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
                $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->bindParam(':tel', $tel, PDO::PARAM_INT);
                $stmt->execute();
        
                return true;
                echo "Etudiant mis à jour avec succès.";
            } catch (PDOException $e) {
                die("Erreur lors de la mise à jour : " . $e->getMessage());
            }
        }
   

    }
  
    public function deleteEnseignant($id) {
        // Vérifier si l'ID est présent et la confirmation est reçue
        var_dump($_POST['confirmation']);
        if (isset($id) && isset($_POST['confirmation']) == 'oui') {
            try {
                $sql = "DELETE FROM enseignants WHERE id = :id";
                
                
                
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
               
                $sql2=" ALTER TABLE enseignants  AUTO_INCREMENT = 1";
                $stmt2 = $this->pdo->prepare($sql2);
                $stmt2->execute();
                //   Vérifie si une ligne a été affectée (supprimée)
            return $stmt->rowCount() > 0;
            } catch (PDOException $e) {
                die("Erreur lors de la suppression : " . $e->getMessage());
            }
        } 
    }

    public function deleteEtudiant($id){
        var_dump($_POST['confirmation']);
        if (isset($id) && isset($_POST['confirmation']) == 'oui') {
            try {
                $sql = "DELETE FROM etudiant WHERE id = :id";
                
                
                
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
               
                $sql2=" ALTER TABLE etudiant  AUTO_INCREMENT = 1";
                $stmt2 = $this->pdo->prepare($sql2);
                $stmt2->execute();
                //   Vérifie si une ligne a été affectée (supprimée)
            return $stmt->rowCount() > 0;
            } catch (PDOException $e) {
                die("Erreur lors de la suppression : " . $e->getMessage());
            }
        } 
    
    }

 }
 