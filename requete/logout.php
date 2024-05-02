<?php

session_start();
// déstruction de la session
session_destroy();
// redirection vers la page de login
header('Location: ../login.php?error= Vous êtes déconnecté !');
exit();