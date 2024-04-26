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

    public function getEnseignantsEtudiants(){
     try {
        
     
            $listeEnseignants =  $this->adminModel->getEnseignants();
            $listeEtudiants =  $this->adminModel->getEtudiants();
            include('views/test.phtml');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function createEnseignant(){
        try { 
            if($_SERVER['REQUEST_METHOD']==='POST'){ 
                $nom =$_POST['lastname'];
                $prenom=$_POST['firstname'];
                $email=$_POST['email'];
                $mdp=$_POST['password'];
                $creationEnseignant= $this->adminModel->CreateEnseignant($nom,$prenom,$email,$mdp);

            }
        } catch (\Throwable $th) {
            //throw $th;
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
            $date=$_POST['date'];
            $tel=$_POST['tel'];
            $email=$_POST['email'];
            $mdp=$_POST['password'];
            $promotion=$_POST['promo'];
            
                $creationEtudiant= $this->adminModel->CreateEtudiant($nom,$prenom,$sexe,$date,$tel,$email,$mdp,$promotion);
            }
        } catch (\Throwable $th) {
        //throw $th;
       }
       $this->template = "register-etudiant";
       include('views/layoutAdmin.phtml');
    }
        
    
    // public function getEnseignant($_POST){
    //     $this->adminModel->getEnseignant($_POST);
    // }

    // public function getEtudiants(){
    //     $this->adminModel->getEtudiants();
    // }

    // public function getEtudiant($_POST){
    //     $this->adminModel->getEtudiant($_POST);
    // }

    // public function updateEnseignant($id){
    //     $this->adminModel->updateEnseignant($_POST);
    // }

    // public function updateEtudiant($id){
    //     $this->adminModel->updateEtudiant($_POST);
    // }

    // public function deleteEnseignant($id){
    //     $this->adminModel->deleteEnseignant($_POST);
    // }
    // public function deleteEtudiant($id){
    //     $this->adminModel->deleteEtudiant($_POST);
    // }


}