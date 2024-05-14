<?php 
if (isset($_POST['num_promo'])) {
    try {
        $bdd = new PDO("mysql:host=localhost;dbname=projet_final", "root", "");
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $numPromo = $_POST['num_promo'];

        // Utiliser une requête préparée
        $numEtudiant = "SELECT etudiant.id, etudiant.nom, etudiant.prenom, promotion.nom as nom_promo FROM etudiant INNER JOIN promotion ON etudiant.promotion = promotion.id WHERE promotion = :numPromo";
        $stmt = $bdd->prepare($numEtudiant);
        $stmt->bindParam(':numPromo', $numPromo, PDO::PARAM_STR);
        $stmt->execute();

        // Récupérer les données sous forme de tableau associatif
        $data = [];
        while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $ligne;
        }

        // Envoyer la réponse au format JSON
        echo json_encode($data);
    } catch (PDOException $e) {
        echo "ERREUR DE CONNEXION : " . $e->getMessage();
    }
}






