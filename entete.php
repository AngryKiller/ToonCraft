<header>
    <nav role="navigation" class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Nom de la navbar et configuration du bouton responsive -->
            <div class="navbar-header">
                <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle"> <span class="sr-only">Menu</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                <a href="index.php" class="navbar-brand">
                    <?php if ($logo == "true") { ?> <img class="logo" src="theme/<?php echo $_Serveur_['General']['theme']; ?>/img/logo.png">
                        <?php } else echo $_Serveur_['General']['name']; ?>
                </a>
            </div>
            <!-- Liens dans la navbar -->
            <div id="navbarCollapse" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <?php
	// Je rappelle que _Menu_ est une variable utilisable partout. Elle est générée en début d'index. 
	// Cette variable contient le texte des liens de la barre des menus, l'adresse des liens, le liste déroulantes etc...
	
	// Cette boucle afficheun lien / menu déroulant à chaque tour. On fait autant de tour qu'il y a de textes à afficher.
	for($i = 0; $i < count($_Menu_['MenuTexte']); $i++)
	{
		// Si il y a une listé déroulante contenant le texte du texte de ce tour de boucle, le lien devient un menu déroulant.
		if(isset($_Menu_['MenuListeDeroulante'][$_Menu_['MenuTexteBB'][$i]]))
		{
			// On affiche la structure de base du menu déroulant de Bootstrap :
			?>
                        <li class="dropdown">
                            <a href="<?php echo $_Menu_['MenuLien'][$i]; ?>" class="dropdown-toggle" data-toggle="dropdown">
                                <?php echo $_Menu_['MenuTexte'][$i]; ?><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <?php
		
			// On affiche la puce dans le menu déroulant depuis une boucle, qui fait autant de tour qu'il y a de lignes à afficher dans la liste déroulante.
			for($k = 0; $k < count($_Menu_['MenuListeDeroulante'][$_Menu_['MenuTexteBB'][$i]]); $k++)
			{
				// Dans le cas où le texte de la puce vaut "-divider-", on met une ligne de division à la place du texte (fonctionnalité css de bootstrap). 
				
				if($_Menu_['MenuListeDeroulante'][$_Menu_['MenuTexteBB'][$i]][$k] == 'LastLinkDontDelete'){
					
				}elseif($_Menu_['MenuListeDeroulante'][$_Menu_['MenuTexteBB'][$i]][$k] == '-divider-')
				{
					echo'<li class="divider"></li>';
				}
				// Sinon on met un lien avec texte + adresse.
				else
				{
					echo '<li><a href="' .$_Menu_['MenuListeDeroulanteLien'][$_Menu_['MenuTexteBB'][$i]][$k]. '">' .$_Menu_['MenuListeDeroulante'][$_Menu_['MenuTexteBB'][$i]][$k]. '</a></li>';
				}
			}
			
			// On ferme la liste du déroulant, et on remonte à la premiere boucle :p.
			?>
                            </ul>
                        </li>
                        <li class="divider-vertical"></li>
                        <?php
		}
		
		// Si le lien n'est pas un menu déroulant, on l'affiche tout simplement, ou presque, il faut prévoir que si on est sur la page du lien, le lien doit être en foncé (class="active" fonction bootstrap.
		else
		{
			// Cette variable contient la valeur du lien de la puce(on enlève donc ?&page= en le remplaçant par '' et on garde que la fin.
			$quellePage = str_replace('index.php?&page=', '', $_Menu_['MenuLien'][$i]);
			
			// Si le Get actuel est égal à la variable de la ligne précédente, la puce est active.
			if(isset($_GET['page']) AND $quellePage == $_GET['page']) 
				$active = ' class="active"';
			
			// Si il n'y a pas de get(on est donc sur l'index) et qu'on est au premier tour de boucle --> le premier lien(souvent un lien vers l'accueil justement) est actif (foncé).
			elseif(!isset($_GET['page']) AND $i == 0) 
				$active = ' class="active"';
			
			// On prévoit que quand il n'y a rien à afficher, la var est vide pour éviter l'erreur.
			else $active = '';
			
			// On affiche enfin la puce ! 
			echo '<li' .$active. '><a href="' .$_Menu_['MenuLien'][$i]. '">' .$_Menu_['MenuTexte'][$i]. '</a></li><li class="divider-vertical"></li>';
		}
	}
	?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="divider-vertical"></li>
                    <li><a href="#">Membres inscrits: <?php $req_nbrMembre2 = $bddConnection->query('SELECT * FROM cmw_users'); $Membretotal = $req_nbrMembre2->rowCount(); echo $Membretotal;?></a></li>
                    <li class="divider-vertical"></li>
                    <?php if(isset($_Joueur_)) { ?>
                        <li class="dropdown" style="height: 50px;margin-top: -5px;"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mon profil<b class="caret"></b> <img class="icon-player-topbar" src="http://api.craftmywebsite.fr/skin/face.php?u=<?php echo $_Joueur_['pseudo']; ?>&s=1024&v=front" width="32" height="32" /></a>
                            <?php } else { ?>
                                <li class="dropdown" style="height: 50px;"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">Connexion/Inscription<b class="caret"></b></a>
                                    <?php } ?>
                                        <ul class="dropdown-menu">
                                            <div style="width: 400px;padding:10px;">
                                                <?php
								/*
								Le menu de droite est différent selon si le joueur est connecté ou pas :
									- Pas connecté, on lui propose un lien Connection et un autre Inscription.
									- Connecté :
										- Admin, on lui rajoutte un lien "administration".
										- Pas admin, il a juste le lien vers son profil plus un lien déconnection.
								*/
								
							if(isset($_Joueur_))
								{
									$req_topic = $bddConnection->prepare('SELECT cmw_forum_topic_followed.pseudo, id_topic, vu, cmw_forum_topic_followed.last_answer AS last_answer_int, cmw_forum_post.last_answer AS last_answer_pseudo FROM cmw_forum_topic_followed
									INNER JOIN cmw_forum_post WHERE id_topic = cmw_forum_post.id AND cmw_forum_topic_followed.pseudo = :pseudo');
									$req_topic->execute(array(
										'pseudo' => $_Joueur_['pseudo']
									));
									$alerte = 0;
									while($td = $req_topic->fetch())
									{
										if($td['pseudo'] != $td['last_answer_pseudo'] AND $td['last_answer_pseudo'] != NULL AND $td['vu'] == 0)
										{
											$alerte++;
										}
									}
									$req_answer = $bddConnection->prepare('SELECT cmw_forum_like.pseudo AS pseudo_likeur, Appreciation, id_answer, cmw_forum_answer.pseudo
									AS pseudo_posteur, id_topic, vu	FROM cmw_forum_like INNER JOIN cmw_forum_answer WHERE id_answer = cmw_forum_answer.id
									AND cmw_forum_like.pseudo != :pseudo AND cmw_forum_answer.pseudo = :pseudop');
									$req_answer->execute(array(
										'pseudo' => $_Joueur_['pseudo'],
										'pseudop' => $_Joueur_['pseudo']
									));
									while($answer_liked = $req_answer->fetch())
									{
										if($answer_liked['vu'] == 0)
										{
											$alerte++;
										}
									}
									if($_Joueur_['rang'] == 1)
										{
											$req_report = $bddConnection->query('SELECT * FROM cmw_forum_report WHERE vu = 0');
											$signalement = $req_report->rowCount();
											echo '<a href="admin.php" class="btn btn-success btn-block" style="margin-bottom: 5px;"><i class="fa fa-cog"></i> Administration</a>';
											echo '<a href="?page=signalement" class="btn btn-success btn-block" style="margin-bottom: 5px"><span class="glyphicon glyphicon-bell"></span> Signalement <span class="badges" id="signalement">' . $signalement . '</span></a>';
										}
										echo '<a href="?page=alert" class="btn btn-success btn-block" style="margin-bottom: 5px;"><span class="glyphicon glyphicon-envelope"></span> Alertes <span class="badges" id="alerts">' . $alerte . '</span></a>';
										?> <a href="?&page=profil&profil=<?php echo $_Joueur_['pseudo']; ?>" class="btn btn-primary btn-block" style="margin-bottom: 5px;"><img class="icon-player-topbar" src="http://api.craftmywebsite.fr/skin/face.php?u=<?php echo $_Joueur_['pseudo']; ?>&s=1024&v=front" width="24" height="24" /> <?php echo $_Joueur_['pseudo']; ?></a></a>
                                                    <a href="index.php?&page=token" class="btn btn-danger btn-block" style="margin-bottom: 5px;height: 45px;font-size: 18px;">
                                                        <?php if(isset($_Joueur_['tokens'])) echo $_Joueur_['tokens'] . ' '; ?><img class="icon-player-topbar" src="theme/<?php echo $_Serveur_['General']['theme']; ?>/img/jeton.png" width="24" height="24"></a> <a href="?&action=deco" class="btn btn-danger btn-block"><i class="fa fa-power-off"></i> Déconnexion</a>
                                                    <?php } else { ?> <a data-toggle="modal" data-target="#ConnectionSlide" class="btn btn-primary btn-block"><i class="fa fa-user"></i> Connexion</a> <a data-toggle="modal" data-target="#InscriptionSlide" class="btn btn-primary btn-block"><i class="fa fa-user-plus"></i> Inscription</a>
                                                        <?php } ?>
                                        </ul>
                                        </div>
            </div>
    </nav>
</header>
<script src="theme/<?php echo $_Serveur_['General']['theme']; ?>/js/bootstrap.min.js"></script>
<script src="theme/<?php echo $_Serveur_['General']['theme']; ?>/js/jquery-1.10.2.min.js"></script>