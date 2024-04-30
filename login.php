<!-- on importe le header -->
<?php require_once('./template/_header.php'); ?>
<?php require_once('./template/_form.php'); ?>


<?php
form(
    './requete/authentification.php', //$action
    'Connectez-vous', //$title
    'Se connecter', //$button_name
    'Vous n\'avez pas compte', //$text
    './index.php', //$link
    'Inscrivez-vous'//$button_link
);
?>

<!-- on importe le footer -->
<?php require_once('./template/_footer.php'); ?>