<?php 
ini_set('display_errors','1');
ini_set('display_startup_errors','1');
error_reporting(E_ALL);
require('models/AdminModel.php');



class Admin
{
    
    private $adminModel;
    private $template;
    public function __construct()
    {
        $this->adminModel = new AdminModel();
        
    }

    public function homeAdminEnseignant(){   
        $listeEnseignants =  $this->adminModel->getEnseignants();
        // $listeEnseignants =  $this->adminModel->createEnseignant();

        $this->template = "admin-enseignant";
        include('views/layoutAdmin.phtml');
    }
    public function homeAdminEtudiant(){   
        $listeEtudiants =  $this->adminModel->getEtudiants();
        // $listeEnseignants =  $this->adminModel->createEnseignant();

        $this->template = "admin-enseignant";
        include('views/layoutAdmin.phtml');
    }
    
    public function getEnseignantsEtudiants(){
     try {
        
     
            $listeEnseignants =  $this->adminModel->getEnseignants();
            $listeEtudiants =  $this->adminModel->getEtudiants();
            include('views/test.phtml');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function createAdmin(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupération des données du formulaire
            $nom = $_POST['lastname'];
            $prenom = $_POST['firstname'];
            $email = $_POST['email'];
            $mdp = $_POST['password'];
        
            // Appel de la méthode pour créer l'enseignant
            $creationAdmin= $this->adminModel->CreateAdmin($nom,$prenom,$email,$mdp);
        
            if ($creationAdmin) {
                echo "Enregistrement réussi !";
            } else {
                echo "Erreur lors de l'enregistrement.";
            }
        }
        
       
        $this->template = "register";
        include('views/layoutAdmin.phtml');
    }
    
    public function createEnseignant(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupération des données du formulaire
            $nom = $_POST['lastname'];
            $prenom = $_POST['firstname'];
            $email = $_POST['email'];
            $mdp = $_POST['password'];
        
            // Appel de la méthode pour créer l'enseignant
            $creationEnseignant= $this->adminModel->CreateEnseignant($nom,$prenom,$email,$mdp);
        
            if ($creationEnseignant) {
                echo "Enregistrement réussi !";
            } else {
                echo "Erreur lors de l'enregistrement.";
            }
        }
        
       
        $this->template = "register-enseignant";
        include('views/layoutAdmin.phtml');
    }

    public function createEtudiant(){
       try {
          if($_SERVER['REQUEST_METHOD']==='POST'){ 
            $nom =$_POST['lastname'];
            $prenom=$_POST['firstname'];
            $sexe=$_POST['sexe'];
            $tel=$_POST['tel'];
            $age=$_POST['age'];
            $email=$_POST['email'];
            $mdp=$_POST['password'];
            $promotion=$_POST['promo'];
            
                $creationEtudiant= $this->adminModel->CreateEtudiant($nom,$prenom,$sexe,$age,$tel,$email,$mdp,$promotion);
            }
        } catch (\Throwable $th) {
        //throw $th;
       }
       $this->template = "register-etudiant";
       include('views/layoutAdmin.phtml');
    }
        
    
    

    public function updateEnseignants(){
       $id = $_GET['id'];

       $enseignant=$this-> adminModel->getEnseignant($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupération des données du formulaire
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
        
            // Appel de la méthode pour créer l'enseignant
            $modificationEnseignant= $this->adminModel->updateEnseignant($id);
            if ($modificationEnseignant) {
                echo "Modification réussi !";
            } else {
                echo "Erreur lors de la modification .";
            }
        }
        
       
        $this->template ="update-   enseignant";
        include('views/layoutAdmin.phtml');   
     }

     
     public function updateEtudiants() {
        $id = $_GET['id'];
    
        // Récupérer les données de l'étudiant
        $etudiant = $this->adminModel->getEtudiant($id);
    
        // Vérifier si l'étudiant existe
        if (!$etudiant) {
            echo "Étudiant introuvable.";
            return;
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupération des données du formulaire
            $nom = $_POST['nom'] ?? '';
            $prenom = $_POST['prenom'] ?? '';
            $email = $_POST['email'] ?? '';
            $tel = $_POST['tel'] ?? '';
    
            // Appel de la méthode pour mettre à jour l'étudiant
            $modificationEtudiant = $this->adminModel->updateEtudiant($id, $nom, $prenom, $email, $tel);
    
            if ($modificationEtudiant) {
                echo "Modification réussie !";
            } else {
                echo "Erreur lors de la modification.";
            }
        }
    
        // Transmettre les données de l'étudiant à la vue
        $this->template = "update-etudiant";
        include('views/layoutAdmin.phtml');   
    }
    
    
  
     public function deleteEnseignant(){

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            echo "ID à supprimer : " . htmlspecialchars($id) . "<br>";
            if (isset($_POST['confirmation']) && $_POST['confirmation'] === 'oui') {
                // Appel de la méthode pour supprimer l'enseignant
                $deleteEnseignant = $this->adminModel->deleteEnseignant($id);
                
                if ($deleteEnseignant) {
                    header("Location: index.php?url=admin-enseignant");
                    exit(); // Assurez-vous d'arrêter l'exécution après la redirection
                } else {
                    echo "Erreur lors de la suppression.";
                }
            }
        }
    
        $this->template = "delete-enseignant";
        include('views/layoutAdmin.phtml');
    }
      public function deleteEtudiant(){
 
         if (isset($_GET['id'])) {
             $id = $_GET['id'];
             echo "ID à supprimer : " . htmlspecialchars($id) . "<br>";
             if (isset($_POST['confirmation']) && $_POST['confirmation'] === 'oui') {
                 // Appel de la méthode pour supprimer l'enseignant
                 $deleteEnseignant = $this->adminModel->deleteEtudiant($id);
                 
                 if ($deleteEnseignant) {
                     header("Location: index.php?url=admin-enseignant");
                     exit(); // Assurez-vous d'arrêter l'exécution après la redirection
                 } else {
                     echo "Erreur lors de la suppression.";
                 }
             }
         }
     
         $this->template = "delete-etudiant";
         include('views/layoutAdmin.phtml');
     }
  
    // public function deleteEnseignant($id){
    //     $this->adminModel->deleteEnseignant($_POST);
    // }
    // public function deleteEtudiant($id){
    //     $this->adminModel->deleteEtudiant($_POST);
    // }


}