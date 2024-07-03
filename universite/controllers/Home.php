<?php

// OK 👍

require_once ('db/database.php');

class Home
{
    private $template;
    protected $db;

    public function showHome() 
    {
        // On inclut le template
        $this->template = "home";

        // Crée une instance de la classe Database
        $this->db = new Database();

        // Vérifie si la connexion à la base de données est établie avec succès
        if ($this->db->getPdo()) {
        } else {
            echo 'Erreur lors de la connexion à la base de données';
        }

        // Également le layout qui gère le header et le footer
        include('views/layout.phtml');
    }
}
