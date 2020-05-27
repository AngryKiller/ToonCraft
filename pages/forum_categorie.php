<?php if(isset($_GET['id']) AND isset($_Joueur_))
{
	//Vérification de l'existence du forum :
	$id = $_GET['id'];
	if($_Forum_->exist($id))
	{
		if(isset($_GET['id_sous_forum']))
			$id_sous_forum = $_GET['id_sous_forum'];
		$categoried = $_Forum_->infosCategorie($id);
		if(isset($id_sous_forum))
			$sousforumd = $_Forum_->SousForum($id_sous_forum);
		else
		$sousforumd = $_Forum_->infosSousForum($id, 0);

		?>
			<div class="container-fluid">
				<h1 class="text-uppercase wow fadeInRight" style="color:white;">Forum: <?=$categoried['nom'];?></h1>
			</div>
		<section class="layout" id="page">
		<div class="container">
			<?php if($_SESSION['mode'])
			{
				?>
			<div class="alert alert-warning" role="alert">
				<p style="margin-bottom: 0;" class="text-center">Vous êtes en Mode Joueur. Pour changer de mode, passer sur la page forum.</p>
			</div><?php
			}
			?>
			<nav aria-label="breadcrumb" role="navigation">
				<ol class="breadcrumb">
				  <li class="breadcrumb-item"><a href="/">Accueil</a></li>
				  <li class="breadcrumb-item"><a href="?page=forum">Forum</a></li>
				  <li<?php if(isset($id_sous_forum)) { echo ' class="breadcrumb-item"><a href="?page=forum_categorie&id='.$id.'">'; } else { echo ' class="breadcrumb-item active">'; } echo $categoried['nom']; if(isset($id_sous_forum)) { echo '</a>'; } ?></li>
				  <?php if(isset($id_sous_forum))
						echo '<li class="breadcrumb-item active">'.$sousforumd['nom'].'</li>';
					?>
				</ol>
			</nav><?php
		if(!empty($sousforumd['id']) && !isset($id_sous_forum))
		{
		?>
		<h3>Les sous-Catégories de <?php echo $categoried['nom']; ?></h3>
		<table class="table table-striped">
			<tr>
				<th style="width: 5%"></th>
				<th style="width: 65%">Nom</th>
				<th style="width: 5%">Discussions</th>
				<th style="width: 5%">Messages</th>
				<?php if(($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['deleteSousForum'] == true) AND !$_SESSION['mode'])
				{
					?><th style="width:20%">Actions</th><?php
				} ?>
			</tr>
			<?php
			$sousforumd = $_Forum_->infosSousForum($id, 1);
			for($a = 0; $a < count($sousforumd); $a++)
			{
				?>
			<tr>
				<td><?php if($sousforumd[$a]['img'] == NULL) { ?><a href="?&page=forum_categorie&id=<?php echo $id; ?>&id_sous_forum=<?php echo $sousforumd[$a]['id']; ?>"><i class="material-icons">chat</i></a><?php }
					else { ?><a href="?page=forum_categorie&id=<?php echo $id; ?>&id_sous_forum=<?php echo $sousforumd[$a]['id']; ?>"><i class="material-icons"><?php echo $sousforumd[$a]['img']; ?></a><?php }?></td>
				<td><a href="?&page=forum_categorie&id=<?php echo $id; ?>&id_sous_forum=<?php echo $sousforumd[$a]['id']; ?>"><?php echo $sousforumd[$a]['nom']; ?></a></td>
				<td><a href="?page=forum_categorie&id=<?php echo $id; ?>&id_sous_forum=<?php echo $sousforumd[$a]['id']; ?>"><?php echo $_Forum_->compteTopicsSF($sousforumd[$a]['id']); ?></a></td>
				<td><a href="?page=forum_categorie&id=<?php echo $id; ?>&id_sous_forum=<?php echo $sousforumd[$a]['id']; ?>"><?php echo $_Forum_->compteAnswerSF($sousforumd[$a]['id']); ?></a></td>
				<?php if(($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['deleteSousForum'] == true) AND !$_SESSION['mode'])
				{
					?><td><a href="?action=remove_sf&id_cat=<?php echo $id; ?>&id_sf=<?php echo $sousforumd[$a]['id']; ?>">Supprimer le Sous-Forum</a></td><?php
				} ?>
			</tr>
			<?php
			}
			?>
		</table>
		<?php
		}
		if(($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['addSousForum'] == true) AND !$_SESSION['mode'] && !isset($id_sous_forum))
		{
			?>
			<div class="col-md-offset-8 col-md-4">
				<a class="btn btn-primary" role="button" data-toggle="collapse" href="#sous_cat" aria-expanded="false" aria-controls="collapseExample">
				  Créez un sous-forum
				</a>
			</div>
				<div class="collapse" id="sous_cat">
					<div class="well">
						<form action="?action=create_sf" method="post">
							<div class="row">
								<div class="col-md-6">
									<input type="hidden" name="id_categorie" value="<?php echo $id; ?>" />
									<label class="control-label" for="nom">Nom</label>
									<input type="text" require class="form-control" name="nom" id="nom" maxlength="40" />
								</div>
								<div class="col-md-6">
									<label class="control-label" for="img">Material icône : <a href="https://design.google.com/icons" target="_blank" >https://design.google.com/icons</a></label>
									<input type="text" maxlength="300" name="img" id="img" class="form-control" />
								</div>
							</div>
							<div class="row">
								<div class="col-md-offset-4 col-md-6">
									<button type="sublmit" class="btn btn-success">Créer un sous-forum</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			<?php
		}
		?>
		<br/>
		<h3> Les topics de <?php echo $categoried['nom']; if(isset($id_sous_forum)) echo ' - '.$sousforumd['nom']; ?></h3>
		<?php
		if(isset($id_sous_forum))
			$count_topic_max2 = $_Forum_->compteTopicsSF($id_sous_forum);
		else
			$count_topic_max2 = $_Forum_->compteTopics($id);
		$count_topic_nbrOfPages2 = ceil($count_topic_max2 / 20);

		if(isset($_GET['page_topic']))
		{
			$page = $_GET['page_topic'];
		}
		else
		{
			$page = 1;
		}

		$count_topic_FirstDisplay2 = ($page - 1) * 20;
		if(isset($id_sous_forum))
			$topicd = $_Forum_->infosSousForumTopics($id_sous_forum, $count_topic_FirstDisplay2);
		else
			$topicd = $_Forum_->infosTopics($id, $count_topic_FirstDisplay2);
		if($count_topic_max2 > 0)
		{
			?>
			<table class="table table-striped table-hover">
				<tr>
					<?php if(isset($_Joueur_) && ($_PGrades_['PermsForum']['moderation']['selTopic'] == true OR $_Joueur_['rang'] == 1)  && !$_SESSION['mode'])
					{
						echo '<th></th>';
					} ?>
					<th></th>
					<th class="w-50">Nom du topic</th>
					<th>Réponses</th>
					<th>Dernière réponse</th>
				</tr>
				<?php
				for($i = 0; $i < count($topicd); $i++)
				{
					?>
					<tr>
						<?php if(isset($_Joueur_) && ($_PGrades_['PermsForum']['moderation']['selTopic'] == true OR $_Joueur_['rang'] == 1) && !$_SESSION['mode'])
							{
								?><td><input name="selection" type="checkbox" value="<?php echo $topicd[$i]['id']; ?>"/></a></td>
										<?php
							} ?>
						<td><img src="https://cravatar.eu/head/<?php echo $topicd[$i]['pseudo'];?>/16" alt="avatar de l'auteur" title="<?php echo $topicd[$i]['pseudo']; ?>"/>
						</td>
						<td><a href="?&page=post&id=<?php echo $topicd[$i]['id']; ?>"><?php if(isset($topicd[$i]['prefix']) && $topicd[$i]['prefix'] != 0)
						{
							echo $_Forum_->getPrefix($topicd[$i]['prefix']);
						}
							echo ' '.$topicd[$i]['nom']; ?></a></td>
						<td><p>Réponses : <?php echo $_Forum_->compteReponse($topicd[$i]['id']); ?></td>
						<td><a href="?&page=post&id=<?php echo $topicd[$i]['id']; ?>"><?php echo $_Forum_->conversionLastAnswer($topicd[$i]['last_answer']); ?></td>
					</tr>
					<?php
				}
				?>
			</table><br/>
			<?php if(($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['moderation']['addPrefix'] == true OR $_PGrades_['PermsForum']['moderation']['epingle'] == true OR $_PGrades_['PermsForum']['moderation']['closeTopic'] == true) AND !$_SESSION['mode'])
			{
			?>
			<div id="popover" class="hide"><hr/><form id="sel-form" method='POST' action='?action=selTopic' class="inline">
				<input type='hidden' name='idCat' value='<?php echo $id; ?>'>
				<?php if(isset($id_sous_forum)) echo "<input type='hidden' name='idSF' value='$id_sous_forum'>";
				if($_PGrades_['PermsForum']['moderation']['addPrefix'] == true OR $_Joueur_['rang'] == 1)
				{ ?>
				<label for='prefix'>Appliquer un préfix de discussion : </label><select name='prefix' id='prefix'>
					<option value="NULL">Ne pas changer le préfixe</option>
					<option value='0'>Aucun</option>
					<?php
					$reqPrefix = $_Forum_->getPrefixModeration();
					while($donnees_prefix = $reqPrefix->fetch())
					{
						?><option value="<?php echo $donnees_prefix['id']; ?>"><?=$donnees_prefix['nom'];?></option><?php
					}
					?>
				</select>
				<?php } if($_PGrades_['PermsForum']['moderation']['epingle'] == true or $_Joueur_['rang'] == 1)
				{ ?>
				<label for='epingle'>Epingler une discussion : </label> <input type='radio' name='epingle' value='1' id='oui'/> <label for='oui'>Oui</label>
																		<input type='radio' name='epingle' value='0' id='non'/> <label for='non'>Non</label>
				<?php } if($_PGrades_['PermsForum']['moderation']['closeTopic'] == true OR $_Joueur_['rang'] ==1)
				{ ?>
				<label for='close'>Fermer une discussion : </label> <input type='radio' name='close' value='1' id='yes'/> <label for='yes'>Oui</label>
																	<input type='radio' name='close' value='0' id='no'/> <label for='no'>Non</label>
				<?php } ?><button type='submit' class='btn btn-lg btn-primary btn-block'>Valider</button>
				</form>
			</div>
			<?php
		}
		?><nav aria-label="Page forum catégorie">
				<ul class="pagination"><?php
					for($i = 1; $i <= $count_topic_nbrOfPages2; $i++)
					{
						?><li class="page-item"><a class="page-link" href="?&page=forum_categorie&id=<?php echo $id; if(isset($id_sous_forum)) echo "&id_sous_forum=$id_sous_forum"; ?>&page_topic=<?php echo $i; ?>"><?php echo $i;
						?></a></li><?php
					} ?>
				</ul>
			</nav>
			<?php
		}
		else
		{
			?>
			<div class="alert alert-warning" role="alert">
				<p class="text-center" style="margin-bottom: 0;">Aucun sujet n'a été posté :( </p>
			</div>
			<?php
		}
	if($categoried['close'] == 0 OR ($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['seeForumHide'] == true) AND !$_SESSION['mode'])
	{
		?>
		<hr/>
		<h4>Poster un topic dans la catégorie <?php echo $categoried['nom']; if(isset($id_sous_forum)) { echo ' et le sous-forum ' .$sousforumd['nom']. ''; } ?></h4>
		<form action="?&action=create_topic" method="post">
			<p>
			<input type="hidden" name="id_categorie" value="<?php echo $id; ?>"/>
			<input type="hidden" name="sous-forum" value="<?php if(isset($id_sous_forum)) { echo $id_sous_forum; } else { echo 'NULL'; } ?>"/>
			<div class="form-group row">
				<label for="nom" class="col-sm-2 form-control-label">Rentrez le nom de votre sujet/topic</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="nom" name="nom" placeholder="Le titre de votre topic ici" require />
				</div>
			</div>
			<div class="col-md-12 text-center">
				<?php
					$smileys = getDonnees($bddConnection);
					for($i = 0; $i < count($smileys['symbole']); $i++)
					{
						echo '<a href="javascript:insertAtCaret(\'contenue\',\' '.$smileys['symbole'][$i].' \')"><img src="'.$smileys['image'][$i].'" alt="'.$smileys['symbole'][$i].'" title="'.$smileys['symbole'][$i].'" /></a>';
					}
				?>
				<a href="javascript:ajout_text('contenue', 'Ecrivez ici ce que vous voulez mettre en gras', 'ce texte sera en gras', 'b')" style="text-decoration: none;" title="gras"><i class="fas fa-bold" aria-hidden="true"></i></a>
				<a href="javascript:ajout_text('contenue', 'Ecrivez ici ce que vous voulez mettre en italique', 'ce texte sera en italique', 'i')" style="text-decoration: none;" title="italique"><i class="fas fa-italic"></i></a>
				<a href="javascript:ajout_text('contenue', 'Ecrivez ici ce que vous voulez mettre en souligné', 'ce texte sera en souligné', 'u')" style="text-decoration: none;" title="souligné"><i class="fas fa-underline"></i></a>
				<a href="javascript:ajout_text('contenue', 'Ecrivez ici ce que vous voulez mettre en barré', 'ce texte sera barré', 's')" style="text-decoration: none;" title="barré"><i class="fas fa-strikethrough"></i></a>
				<a href="javascript:ajout_text('contenue', 'Ecrivez ici ce que vous voulez mettre en aligné à gauche', 'ce texte sera aligné à gauche', 'left')" style="text-decoration: none" title="aligné à gauche"><i class="fas fa-align-left"></i></a>
				<a href="javascript:ajout_text('contenue', 'Ecrivez ici ce que vous voulez mettre en centré', 'ce texte sera centré', 'center')" style="text-decoration: none" title="centré"><i class="fas fa-align-center"></i></a>
				<a href="javascript:ajout_text('contenue', 'Ecrivez ici ce que vous voulez mettre en aligné à droite', 'ce texte sera aligné à droite', 'right')" style="text-decoration: none" title="aligné à droite"><i class="fas fa-align-right"></i></a>
				<a href="javascript:ajout_text('contenue', 'Ecrivez ici ce que vous voulez mettre en justifié', 'ce texte sera justifié', 'justify')" style="text-decoration: none" title="justifié"><i class="fas fa-align-justify"></i></a>
				<a href="javascript:ajout_text_complement('contenue', 'Ecrivez ici l\'adresse de votre lien', 'https://craftmywebsite.fr/forum', 'url', 'Entrez le titre de votre lien', 'CraftMyWebsite')" style="text-decoration: none" title="lien"><i class="fas fa-link"></i></a>
				<a href="javascript:ajout_text_complement('contenue', 'Ecrivez ici l\'adresse de votre image', 'https://craftmywebsite.fr/img/cat6.png', 'img', 'Entrez ici le titre de votre image (laisser vide si vous ne voulez pas compléter', 'Titre')" style="text-decoration: none" title="image"><i class="fas fa-image"></i></a>
				<a href="javascript:ajout_text_complement('contenue', 'Ecrivez ici votre texte en couleur', 'Ce texte sera coloré', 'color', 'Entrer le nom de la couleur en anglais ou en hexaécimal avec le  # : http://www.code-couleur.com/', 'red ou #40A497')" style="text-decoration: none" title="couleur"><i class="fas fa-font"></i></a>
				<a href="javascript:ajout_text_complement('contenue', 'Ecrivez ici votre message caché', 'contenue du spoiler', 'spoiler', 'Entrer le titre du message caché (si la case est vide le titre sera \'Spoiler\'', 'Spoiler')" style="text-decoration: none" title="spoiler"><i class="fas fa-flag"></i></a>
				<div class="dropdown">
				  	<a href="#" role="button" id="font" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				   	 <i class="fas fa-text-height"></i>
				  	</a>
					<div class="dropdown-menu" aria-labelledby="font">
				   		<a class="dropdown-item" href="javascript:ajout_text('contenue', 'Ecrivez ici ce que vous voulez mettre en taille 2', 'ce texte sera en taille 2', 'font=2')"><span style="font-size: 2em;">2</span></a>
				   		<a class="dropdown-item" href="javascript:ajout_text('contenue', 'Ecrivez ici ce que vous voulez mettre en taille 5', 'ce texte sera en taille 5', 'font=5')"><span style="font-size: 5em;">5</span></a>
				  	</div>
				</div>
			</div>
			<div class="form-group row">
				<label for="contenue" class="col-sm-2 form-control-label">Insérez le contenue de votre topic ! ( Max 15 000 caractères )</label>
				<div class="col-sm-10">
					<textarea id="contenue" name="contenue" max="15000" min="1" class="form-control" rows="10" require ></textarea>
				</div>
			</div>
			<div class="form-group row">
				<center><div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-primary">Poster</button>
				</div></center>
			</div>
		</form>
		<?php
	}
	?></div>
	</section><?php
}
else
	header('Location: index.php?page=erreur&erreur=17');
}
else
{
	header('Location: ?page=erreur&erreur=16');
} ?>
