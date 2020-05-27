<?php if($pages['titre'] == "" && $pageContenu[$j][0] == ""){ ?>
    <style>
        .error-template {
            padding: 40px 15px;
            text-align: center;
        }
        
        .error-actions {
            margin-top: 15px;
            margin-bottom: 15px;
        }
        
        .error-actions .btn {
            margin-right: 10px;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="error-template">
                    <h1>
                    Oups!</h1>
                    <h2>
                    Erreur 404</h2>
                    <div class="error-details"> Désolé mais la page demandé est introuvable ! :( </div>
                    <div class="error-actions"> <a href="index.php" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span>
                        Retourner a l'accueil</a> </div>
                </div>
            </div>
        </div>
    </div>
    <?php } else {} ?>
        <div class="jumbotron parallax" data-parallax="scroll" data-image-src="theme/<?php echo $_Serveur_['General']['theme'];?>/img/jumbotron.png">
            <div class="container">
                <h1> <?php echo $pages['titre']; ?> </h1>
                <br/>
                <p>
                    <?php echo $pageContenu[$j][0]; ?>
                </p>
            </div>
        </div>
        <div class="container">
            <?php for($j = 0; $j < count($pages['tableauPages']); $j++) { ?>
                <div>
                    <?php echo $pageContenu[$j][1]; ?>
                </div>
                <?php } ?>
        </div>
        </div>