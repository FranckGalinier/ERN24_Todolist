<?php

//méthode de sécuridation de données en évitant les injections sql
function validate($data){
    return trim(stripslashes(htmlspecialchars($data)));
}