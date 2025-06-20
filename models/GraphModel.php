<?php
require_once "C:\wamp64\www\universite\db\database.php";

class GraphModel extends Database {

    public function __construct() {
        parent::__construct();
    }

    public function getAbsRetard($id) {
    $sql = "SELECT * FROM enregistrerpresence WHERE id_etudiant = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $data = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }

    return $data; 
}

}