
<?php
require_once "C:\wamp64\www\universite\db\database.php";
class MailService extends \Database {
    
    public static function envoyerAvertissement($nom, $email, $absences, $retards) {
        $subject = "Avertissement - Absences / Retards";
        $message = "Bonjour $nom,\n\n";
        $message .= "Vous avez $absences absence(s) et $retards retard(s).\n";
        $message .= "Merci de régulariser votre situation.\n\nCordialement,\nL'administration";

        // Simulation console
        echo "<p>📧 Mail envoyé à $email</p>";
        echo "<pre>$message</pre>";

        // Envoi réel (optionnel)
        // mail($email, $subject, $message);
    }
}