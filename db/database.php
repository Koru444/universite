<?php
class Database
{
    protected $pdo;
    protected $stmt;


    public function __construct(){

        $this->connect();
    }

    public function connect() {
        // $server = "mysql:host=localhost;dbname=projet_final","root", "";
      
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=projet_final", "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo 'Connexion réussie';
        }
        catch(\PDOException $e) {
            $this->error = $e->getMessage();
        }

    }  
    public function getPdo()
    {
        return $this->pdo;
    }
    
    public function query($query){
        return $this->stmt = $this->pdo->prepare($query);
    }



        public function execute(){
            return $this->stmt->execute();
        }

        // public function result(){
        //     $this->execute();
        //     return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        // }

        // public function single(){
        //     $this->execute();
        //     return $this->stmt->fetch(PDO::FETCH_ASSOC);
        // }
}
