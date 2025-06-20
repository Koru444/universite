<?php
//include __DIR__ .'../models/EnregistrerPresenceModel.php';
// include dirname($_SERVER['DOCUMENT_ROOT']).'/universite/models/EnregistrerPresenceModel.php';
include $_SERVER['DOCUMENT_ROOT'] . '/universite/models/EnregistrerPresenceModel.php';
require_once './models/MailService.php';



class Enregistrer
{
    private $Enregistrer;
    private $numPromo;
    private $template;

    public function __construct()
    {
        $this->Enregistrer = new EnregistrerPresenceModel();
        $this->template = ''; // Initialiser la propriété template
    }

    public function doPresence()
    {  
        if (isset($_POST['promo'])) {
            $numPromo = $_POST['promo'];
            $result = $this->Enregistrer->getClass($numPromo);
            
            // Vérifier si $result n'est pas vide avant de traiter les présences
            if (!empty($result)) {
                $this->Enregistrer->enregistrerPresence($result);
                //echo json_encode(['success' => true]);  Réponse JSON pour indiquer le succès
            } else {
                echo json_encode(['error' => "Aucun résultat pour cette promotion"]);
            }
        } 
        $this->template = 'enregistrer';
        include('views/layoutEnseignant.phtml');
    }
    public function doPresenceAdmin()
    {  
        if (isset($_POST['promo'])) {
            $numPromo = $_POST['promo'];
            $result = $this->Enregistrer->getClass($numPromo);
            
            // Vérifier si $result n'est pas vide avant de traiter les présences
            if (!empty($result)) {
                $this->Enregistrer->enregistrerPresence($result);
                //echo json_encode(['success' => true]);  Réponse JSON pour indiquer le succès
            } else {
                echo json_encode(['error' => "Aucun résultat pour cette promotion"]);
            }
        } 
        $this->template = 'enregistrer';
        include('views/layoutAdmin.phtml');
    }
    
    // Méthode updatePresence
    public function updatePresence()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $numPromo = $_POST['promo'];
            
            if (isset($numPromo) && is_numeric($numPromo)) {
                $result = $this->Enregistrer->getClass($numPromo);
                // var_dump($result);

                if (isset($result)) {
                    $this->Enregistrer->updatePresence($result);
                    exit;
                } 
            }
        }
    }
   

    public function SuivisPresences(){
      $etudiants= $this->Enregistrer->SuivisPresence();

         $this->template = 'suivis-presence';
        include('views/layoutAdmin.phtml');         
    
    }

   public function verifierAbsences(){
        // Affiche le formulaire d'abord
        require_once 'views/FormView.phtml';
        FormView::afficherFormulaire();

        // Si formulaire soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_etudiant'])) {
            $id = $_POST['id_etudiant'];

            require_once 'models/EnregistrerPresenceModel.php';
            require_once 'models/MailService.php';

            $model = new EnregistrerPresenceModel();
            $stats = $model->getStatsPourEtudiant($id);

            $seuil_absence = 3;
            $seuil_retard = 5;

            if ($stats) {
                if ($stats['total_absences'] >= $seuil_absence || $stats['total_retards'] >= $seuil_retard) {
                    MailService::envoyerAvertissement(
                        $stats['nom'],
                        $stats['email'],
                        $stats['total_absences'],
                        $stats['total_retards']
                    );
                    echo "<p><strong>Avertissement :</strong> {$stats['nom']} dépasse les seuils.</p>";
                } else {
                    echo "<p>{$stats['nom']} est dans les normes.</p>";
                }
            } else {
                echo "<p>Aucune donnée trouvée pour l'élève $id.</p>";
            }
        }

    }
}

