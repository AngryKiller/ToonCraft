<?php if(stripos($_SERVER['PHP_SELF'], "theme/tooncraft") !== false) {header('Location: /index.php');  } ?>
    <?php
// On inclut le fichier de contrôle de la maintenance
include('controleur/maintenance.php');
// Si la maintenance est activé
if($maintenance[$i]['maintenanceEtat'] == 1){
	// On vérifie si le joueur est connecté
	if(!(isset($_Joueur_))){
		header('Location: index.php?&redirection=maintenance');
	} elseif($_Joueur_['rang'] == 1) { // On vérifie si il est admin
		if( $maintenance[$i]['maintenancePref'] == 0 ){ // Si la pref vaut 0 les admins ont accès au site avec l'entête en plus
			include('theme/' .$_Serveur_['General']['theme']. '/maintenance/entete.php');
		} elseif ( $maintenance[$i]['maintenancePref'] == 1 ) { // Si la maintenance vaut 1 les admins n'ont pas accès au site mais ils sont redirigés vers le panel admin
			header('Location: admin.php');
		}
		else { // Si le joueur n'est pas admin il est redirigé vers la page de maintenance
			header('Location: index.php?&redirection=maintenance');
		}
	} else { // Si le joueur n'est pas connecté il est redirigé vers la page de maintenance
		header('Location: index.php?&redirection=maintenance');
	}
}
if(isset($_Joueur_))
{
	require('modele/forum/joueurforum.class.php');
	$_JoueurForum_ = new JoueurForum($_Joueur_['pseudo'], $_Joueur_['id'], $bddConnection);
}
?>
        <?php include ('config/config.php') ?>
            <?php include ('version.php');
    if(isset($_Joueur) && $_Joueur['rang'] == '1'){
    include ('version_distant.php');
}else{
        $versionthemerelease = $versiontheme;
    }
          
?>
                <!DOCTYPE html>
                <html>

                <head>
                    <meta charset="utf-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
                    <meta name="author" content="CraftMyWebsite, TheTueurCiTy, <?php echo $_Serveur_['General']['name']; ?> ,AngryKiller, TéTéCé, ToonCraft, CMW, AK" />
                    <title>
                        <?php echo $_Serveur_['General']['name'] ?> -
                            <?php echo $_Serveur_['General']['description'] ?>
                    </title>
                    <link href="theme/<?php echo $_Serveur_['General']['theme']; ?>/css/bootstrap.css" rel="stylesheet" type="text/css">
                    <link href="theme/<?php echo $_Serveur_['General']['theme']; ?>/css/style.css" rel="stylesheet" type="text/css">
                    <link href="theme/<?php echo $_Serveur_['General']['theme']; ?>/css/toastr.css" rel="stylesheet" type="text/css">
                    <link href="theme/<?php echo $_Serveur_['General']['theme']; ?>/css/snarl.min.css" rel="stylesheet" type="text/css">
                    <link href="theme/<?php echo $_Serveur_['General']['theme']; ?>/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
                    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600,800' rel='stylesheet' type='text/css'>
                    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
                    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
                    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
                    <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
             <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
                        <![endif]-->
                </head>

                <body>
                    <div class="preloader"></div>
                    <?php if(isset($_Joueur_)) { ?>
                        <?php setcookie('pseudo', $_Joueur_['pseudo'], time() + 86400, null, null, false, true); ?>
                            <?php } else { ?>
                                <?php } ?>
                                    <?php
include('theme/' .$_Serveur_['General']['theme']. '/entete.php');
                    
?>
                                        <?php tempMess(); ?>
                                            <?php include('controleur/page.php'); ?>
                                                <?php if ($versiontheme == $versionthemerelease){ echo "<!-- Le thème est à jour !-->"; ?>
                                                    <?php } elseif ($_Joueur_['rang'] == 1 && $versiontheme < $versionthemerelease && $vercheck == 'true')  { ?>
                                                        <script type="text/javascript">
                                                            $(window).load(function () {
                                                                $('#vercheckModal').modal('show');
                                                            });
                                                        </script>
                                                        <div class="modal modal-danger fade" id="vercheckModal" tabindex="-1" role="dialog">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                        <h4 class="modal-title">Votre thème n'est pas à jour!</h4> </div>
                                                                    <div class="modal-body">
                                                                        <p>
                                                                            <h1 class="text-center">Votre thème n'est pas à jour!</h1>
                                                                            <br/>
                                                                            <h4>Nouveautés de la version <?php echo $versionthemerelease ?>:<br/> <?php echo $descriptionupdate ?></h4> <a class="btn btn-danger btn-lg btn-update btn-block" href="theme/<?php echo $_Serveur_['General']['theme']; ?>/vercheckdl.php">Mettre à jour</a> </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                                                                    </div>
                                                                </div>
                                                                <!-- /.modal-content -->
                                                            </div>
                                                            <!-- /.modal-dialog -->
                                                        </div>
                                                        <!-- /.modal -->
                                                        <?php } ?>
                                                            <?php include('theme/' .$_Serveur_['General']['theme']. '/pied.php'); ?>
                                                                <?php include('theme/' .$_Serveur_['General']['theme']. '/widgets.php');?>
                </body>
                <script src="theme/<?php echo $_Serveur_['General']['theme']; ?>/js/jquery-2.2.4.min.js"></script>
                <script src="theme/<?php echo $_Serveur_['General']['theme']; ?>/js/bootstrap.js"></script>
                <script src="theme/<?php echo $_Serveur_['General']['theme']; ?>/js/scrolldown.js"></script>
                <script src="theme/<?php echo $_Serveur_['General']['theme']; ?>/js/parallax.min.js"></script>
                <script src="theme/<?php echo $_Serveur_['General']['theme']; ?>/js/snarl.js"></script>
                <script src="theme/<?php echo $_Serveur_['General']['theme']; ?>/js/toastr.min.js"></script>
                <script src="theme/<?php echo $_Serveur_['General']['theme']; ?>/js/detectmobile.min.js"></script>
                <script type="text/javascript">
                    if (!jQuery.browser.mobile) {
                        $("div.parallax").addClass("transparent");
                        $("div.newsbg").addClass("transparent");
                    }
                </script>
                <!-- Les formulaires pop-up -->
                <script src="//api.dedipass.com/v1/pay.js"></script>
                <?php include('theme/' .$_Serveur_['General']['theme']. '/formulaires.php'); ?>
                    <?php
	if(isset($modal))
	{
	?>
                        <script>
                            $('#myModal').modal('toggle')
                        </script>
                        <?php
	}
	?>
                            </div>
                            <script type="text/javascript">
                                jQuery(document).ready(function ($) {
                                    $(window).load(function () {
                                        $('.preloader').fadeOut('slow', function () {
                                            $(this).remove();
                                        });
                                    });
                                });
                            </script>
                            <?php include('theme/' .$_Serveur_['General']['theme']. '/js/cmw.php');?>