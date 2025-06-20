<?php
require_once 'controllers/PresenceController.php';
require_once 'views/FormView.php';

// Afficher le formulaire
FormView::afficherFormulaire();

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_etudiant'])) {
    $controller = new PresenceController();
    $controller->verifierUnEtudiant($_POST['id_etudiant']);
}
