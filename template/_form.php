<?php

function form($action, $title, $button_name, $text, $link, $button_link){ ?>

    <div id="wrapper">
        <form action="<?php echo $action ?>" method="POST">

            <h2><?php echo $title ?></h2>
            <!-- zone de retour d'erreur -->
            <?php if(isset($_GET['error'])){ ?>

                <p class="error"><?php echo $_GET['error'] ?></p>

            <?php } ?>

            <!-- Label et input -->
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Saisir votre email">

            <label for="password">Mot de passe</label>
            <input type="password" name="password" placeholder="Saisir votre mot de passe">

            <div class="box_button">
                <button type="submit"> <?php echo $button_name ?></button>
                <p class="sub_text"><?php echo $text ?></p>
                <a class="link" href="<?php echo $link ?>"><?php echo $button_link ?></a>
            </div>
        </form>
    </div>

<?php } 