<?php

require_once('./connexion.php');
require_once('../tools/function.php');


//on doit vérifier que l'on reçoit bien les données du formulaire
if(isset($_POST['email']) && isset($_POST['password'])){
    //déclarer nos variables
    $email = strtolower(validate($_POST['email']));//strtolower permet de passer les lettes en minuscules
    $password = validate($_POST['password']);
    var_dump($email);
    var_dump($password);
}else{

}