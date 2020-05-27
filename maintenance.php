<?php
include('controleur/maintenance.php');

if($maintenance[$i]['maintenanceEtat'] == 0){
setTempMess("<script> $( document ).ready(function() { Snarl.addNotification({ title: '', text: 'La maintenance n\'est pas activée !', icon: '<span class=\'glyphicon glyphicon-cog\'></span>'});});</script>");
header('Location: index.php');
}

?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'>
        <meta name="viewport" content="width=device-width" />
        <title>Maintenance de
            <?php echo $_Serveur_['General']['name']; ?>
        </title>
        <link href="theme/<?php echo $_Serveur_['General']['theme']; ?>/css/bootstrap.css" rel="stylesheet" />
        <link href="theme/<?php echo $_Serveur_['General']['theme']; ?>/css/maintenance.css" rel="stylesheet" />
        <!--     Fonts     -->
        <link href="theme/<?php echo $_Serveur_['General']['theme']; ?>/css/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Grand+Hotel' rel='stylesheet' type='text/css'> </head>

    <body>
        <div class="main" style="<?php echo $bgType; ?>background-size: cover;">
            <div class="cover black" data-color="black"></div>
            <div class="container">
                <h1 class="logo cursive">
           <?php echo $_Serveur_['General']['name']; ?> est en maintenance
        </h1>
            </div>
            <div class="content">
                <h4 class="motto"><?php echo $maintenance[$i]['maintenanceMsg']; ?></h4>
                <div class="subscribe">
                    <h5 class="info-text">
                    <?php echo $donnees['maintenanceMsgAdmin']; ?>
                </h5> </div>
                <div class="row">
                    <center><a data-toggle="modal" data-target="#ConnectionSlide" class="btn btn-danger btn-fill"><i class="fa fa-user"></i> Connexion administrateur</a></center>
                </div>
            </div>
        </div>
        <div class="modal fade" id="ConnectionSlide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Connexion administrateur</h4> </div>
                    <div class="modal-body">
                        <form class="form-signin" role="form" method="post" action="?&action=connection">
                            <input type="text" name="pseudo" class="form-control" id="PseudoConectionForm" placeholder="Pseudo" required autofocus>
                            <br/>
                            <input type="password" name="mdp" class="form-control" id="MdpConnectionForm" placeholder="Votre mot de passe" required>
                            <br/>
                            <button class="btn btn-lg btn-primary btn-block btn-fill" type="submit"> Connexion</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-fill" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        <footer class="footer">
            <?php include('pied.php')?>
        </footer>
        </div>
    </body>
    <script src="theme/<?php echo $_Serveur_['General']['theme']; ?>/js/jquery-2.2.4.min.js" type="text/javascript"></script>
    <script src="theme/<?php echo $_Serveur_['General']['theme']; ?>/js/bootstrap.js" type="text/javascript"></script>

    </html>
