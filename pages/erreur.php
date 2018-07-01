<div class="jumbotron parallax" data-parallax="scroll" data-image-src="theme/<?php echo $_Serveur_['General']['theme'];?>/img/jumbotron.png">
    <div class="container">
        <h1><?php echo $erreur['type']; ?></h1>
        <br>
        <p>
            <?php echo $erreur['titre']; ?>
        </p>
    </div>
</div>
<div class="container">
    <p>
        <?php echo $erreur['message']; ?>
    </p>
</div>