<?php

//on déclare nos constante
const DB_HOST ='database';
const DB_NAME = 'todolist';
const DB_USER = 'admin';
const DB_PASS = 'admin'; //or define ('DB_PASS','admin');

$connexion = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

//on vérifie la connexion
if(!$connexion){
    die('Erreur de connexion' . mysqli_connect_error());
}

//on force l'necodage utf8
mysqli_set_charset($connexion, 'utf8');