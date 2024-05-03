<?php

//méthode de sécuridation de données en évitant les injections sql
function validate($data){
    return trim(stripslashes(htmlspecialchars($data)));
}

// méthode qui vérifie que le mdp contient une minuscule, une majuscule, un chiffre et au mois 8 caractères

function check_password($password){
    $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/';
    return preg_match($regex, $password);
}

// méthode qui vérifie qu'une tache est bien celle de l'utilisateur connecté
function check_task_user($user_id, $task_id){
    global $connexion;
    // on crée la requête sql pour vérifier que la tâche appartient bien à l'utilisateur connecté
    $query = "SELECT * FROM `task` WHERE `id` = $task_id AND `user_id` = $user_id";
    // on exécute la requête
    $result = mysqli_query($connexion, $query);
    //on regarde si on a des résultats
    //si oui on retourne true
    //sinon on retourne false
    return mysqli_num_rows($result) > 0;
}