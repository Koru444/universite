<?php


class Logout{


    public function forLogout(){
        session_destroy();
    header('Location: index.php?url=home');
        
    }
}