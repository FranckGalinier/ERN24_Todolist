<!-- on importe le header -->
<?php require_once('./template/_header.php'); ?>

<!-- on va démarrer la session -->
<?php session_start(); ?>

<?php var_dump($_SESSION) ?>

<?php
//on regarde si une session existe
if(isset($_SESSION['email'])){

// si la session existe on redirige sur la page d'acceuil
header('Location: ./home.php');
exit();

}else{
//ici on affiche le formulaire de création de compte

}



?>

<!-- on importe le footer -->
<?php require_once('./template/_footer.php'); ?>
