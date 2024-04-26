<?php
 require_once('db/database.php');

 class AdminModel extends Database{
    public function __construct(){
        parent::__construct();

    }
    protected $pdo;


    public function CreateEnseignant( $nom,$prenom,$email,$mdp){
        try {
            $sql = "INSERT INTO enseignants (nom,prenom,email, mot_de_passe,creationTimeStamp) VALUES (:nom,:prenom,:email,:mot_de_passe, NOW())";
            $mdp= password_hash($mdp,PASSWORD_DEFAULT);
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':nom',$nom);
            $stmt->bindParam(':prenom',$prenom);
            $stmt->bindParam(':email',$email);
            $stmt->bindParam(':mot_de_passe',$mdp);
            $stmt->execute();
             return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die( "erreur de l'envoie du formule".$e->getMessage() );
                
        }
    }

    public function CreateEtudiant($nom,$prenom,$sexe,$date,$tel,$email,$mdp,$promotion){

        try {
            $sql =" INSERT INTO etudiant( nom, prenom, sexe, date, tel, email, mot_de_passe, promotion) VALUES (:nom, :prenom, :sexe, :date_de_naissance, :tel, :email, :mot_de_passe, :promotion)"; 
       $mdp= password_hash($mdp,PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nom',$nom);
        $stmt->bindParam(':prenom',$prenom);
        $stmt->bindParam(':sexe',$sexe);
        $stmt->bindParam(':date_de_naissance',$date);
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
        
        $sql=" SELECT * FROM etudiant ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    
    }
    public function getEtudiant($id){
        $sql=" SELECT * FROM etudiant WHERE id = :id" ;
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    
    }

    public function updateEnseignant($id){
        $sql = "UPDATE enseignant SET nom=:nom,prenom=:prenom WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
    
    }

    public function updateEtudiant($id){
        $sql = "UPDATE etudiant SET nom=:nom,prenom=:prenom,sexe=:sexe,age=:age,tel=:tel,promotion= WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id');
        $stmt->execute();
    

    }

    public function deleteEnseignant($id){
        $sql = "DELETE FROM etudiant WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id');
        $stmt->execute();
    

    }

    public function deleteEtudiant($id){
        $sql = "DELETE FROM etudiant WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id');
        $stmt->execute();
       
    
    }

 }
 