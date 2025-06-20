<?php

require_once 'db/database.php';

class RegisterEnseignantModel //extends Database
{
    private $pdo; // Objet de connexion à la base de données

    public function __construct()
    {
        // erreur
        //  $this->$pdo = Core::getDatabase();
         // Initialise la connexion à la base de données 
        //parent::__construct();
        $this->pdo = new Database();
    }

    public function registerAdmin($lastname, $firstname, $email, $password, $date)
    {
        // Hasher le mot de passe pour des raisons de sécurité
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Préparer la requête d'insertion
        $stmt = $this->pdo->query("INSERT INTO admin (nom, prenom, Email, password, creationTimeStamp) VALUES (?, ?, ?, ?, NOW())");

        // Exécuter la requête avec les valeurs fournies
        $result = $stmt->execute([ $firstname,$lastname, $email, $hashedPassword]);

         // Vérifier les erreurs
        if (!$result) {
            // S'il y a une erreur, afficher le message d'erreur
            $errorInfo = $stmt->errorInfo();
            echo "Erreur lors de l'insertion dans la base de données : " . $errorInfo[2];
            // Ou enregistrez l'erreur dans un fichier journal ou journal de débogage
            file_put_contents('error.log', $errorInfo[2], FILE_APPEND);
        }

        // Retourner true si l'insertion a réussi, sinon false
        return $result;
    }

    public function registerEtudiant($lastname, $firstname, $email, $password, $date)
    {
        // Hasher le mot de passe pour des raisons de sécurité
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Préparer la requête d'insertion
        $stmt = $this->pdo->query("INSERT INTO etudiant (nom, prenom, email, mot_de_passe,promotion) VALUES (?, ?, ?, ?, ?");

        // Exécuter la requête avec les valeurs fournies
        $result = $stmt->execute([$lastname, $firstname, $email, $hashedPassword]);

         // Vérifier les erreurs
        if (!$result) {
            // S'il y a une erreur, afficher le message d'erreur
            $errorInfo = $stmt->errorInfo();
            echo "Erreur lors de l'insertion dans la base de données : " . $errorInfo[2];
            // Ou enregistrez l'erreur dans un fichier journal ou journal de débogage
            file_put_contents('error.log', $errorInfo[2], FILE_APPEND);
        }

        // Retourner true si l'insertion a réussi, sinon false
        return $result;
    }
}
