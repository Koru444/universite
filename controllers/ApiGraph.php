<?php
session_start();

// Vérification de la session
if (!isset($_SESSION['id_etudiant'])) {
    http_response_code(403);
    echo json_encode(["error" => "Non autorisé"]);
    exit;
}

// Inclusion des fichiers nécessaires
require_once '../models/GraphModel.php';
require_once '../db/database.php'; // ou ta classe Database

// Connexion à la base
$graph = new GraphModel(); // Assure-toi que Database fait bien new PDO()

// Récupération des données
$data = $graph->getAbsRetard($_SESSION['id_etudiant']);

// Réponse JSON
header('Content-Type: application/json');
echo json_encode($data);
