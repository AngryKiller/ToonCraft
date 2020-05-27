<?php
require('modele/forum/date.php');
if(isset($_GET['id']) AND isset($_Joueur_))
{
	$id = $_GET['id'];
	$_JoueurForum_->topic_lu($id, $bddConnection);
	$topicd = $_Forum_->getTopic($id);
	if(!empty($topicd['id']))
	{
	?>
		<div class="container-fluid">
			<h1 class="text-uppercase wow fadeInRight" style="color:white;">Post: <?=$topicd['nom'];?></h1>
		</div>
	<section class="layout" id="page">
	<div class="container">
	<nav class="nav nav-pills nav-justified">
		<?php if($_JoueurForum_->is_followed($id))
		{
			?>
			<a class="nav-link" href="?&action=unfollow&id_topic=<?php echo $topicd['id']; ?>">Ne plus suivre cette discussion </a>
				<?php
		}
		else
		{
			?>
			<a class="nav-link" href="?&action=follow&id_topic=<?php echo $topicd['id']; ?>">Suivre cette discussion</a>
				<?php
		}
		?>
		<a class="nav-link" href="?&page=forum_categorie&id=<?php echo $topicd['id_categorie']; if(isset($topicd['sous_forum'])) { ?>&id_sous_forum=<?php echo $topicd['sous_forum']; } ?>">Revenir à l'index de la catégorie</a>
		<a class="nav-link" href="?&page=forum">Revenir à l'index du forum</a>
	</nav><br/>
	<nav aria-label="breadcrumb" role="navigation">
		<ol class="breadcrumb" style="front-size: 20px;">
			<li class="breadcrumb-item"><a href="/">Accueil</a></li>
			<li class="breadcrumb-item"><a href="?page=forum">Forum</a></li>
			<li class="breadcrumb-item"><a href="?&page=forum_categorie&id=<?php echo $topicd['id_categorie']; ?>"><?php echo $topicd['nom_categorie']; ?></a></li>
			<?php if(isset($topicd['sous_forum'])) { ?><li class="breadcrumb-item"><a href="?page=forum_categorie&id=<?php echo $topicd['id_categorie']; ?>&id_sous_forum=<?php echo $topicd['sous_forum']; ?>"><?php echo $topicd['nom_sf']; ?></a></li><?php } ?>
			<li class="breadcrumb-item active" aria-current="page"><?php echo $topicd['nom']; ?></li>
		</ol>
	</nav>
	<center><?php if(isset($_Joueur_) AND ($_PGrades_['PermsForum']['moderation']['closeTopic'] == true OR $_PGrades_['PermsForum']['moderation']['deleteTopic'] == true OR $_PGrades_['PermsForum']['moderation']['mooveTopic'] == true OR $_Joueur_['rang'] == 1) AND !$_SESSION['mode']) { ?>
	<div class="row">
		<div class="col-lg-8">
			<div class="dropdown">
				<button class="btn btn-danger dropdown-toggle" type="button" id="Actions-Modération" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					Actions de Modération .... <span class="caret"></span>
				</button>
				<ul class="dropdown-menu list-inline" aria-labeledby="Actions-Modérations">
				<?php
				if($_PGrades_['PermsForum']['moderation']['closeTopic'] == true OR $_Joueur_['rang'] == 1)
				{
					if($topicd['etat'] == 1)
					{
						?><li> <a href="?&action=forum_moderation&id_topic=<?php echo $id; ?>&choix=4">Ouvrir la discussion</a></li><?php
					}
					else
					{
						?><li><a href="?&action=forum_moderation&id_topic=<?php echo $id; ?>&choix=1">Fermer la discussion</a></li>
					<?php
					}
				}
				if($_PGrades_['PermsForum']['moderation']['deleteTopic'] == true OR $_Joueur_['rang'] == 1)
				{
					?>
					<li><a href="?&action=forum_moderation&id_topic=<?php echo $id; ?>&choix=2">Supprimer le topic</a></li>
					<?php
				}
				if($_PGrades_['PermsForum']['moderation']['mooveTopic'] == true OR $_Joueur_['rang'] == 1)
				{
					?>
					<li><a href="?&action=forum_moderation&id_topic=<?php echo $id; ?>&choix=3">Déplacer la discussion</a></li>
					<?php
				}
				?>
				</ul>
			</div>
		</div>
		</div><?php } ?></center>
	<h3>Sujet : <?php echo $topicd['nom']; ?></h3><br/>
	<div class="row">
		<div class="col-md-2">
		<!-- Div de droite où on met le profil de l'auteur -->
			<img class="rounded" src="https://cravatar.eu/head/<?php echo $topicd['pseudo']; ?>/128" alt="avatar de l'auteur" title="<?php echo $topicd['pseudo']; ?>" />
			<p class="username"> Pseudo : <?php echo $topicd['pseudo']; ?><br/>Grade :
			<?php echo $_Forum_->gradeJoueur($topicd['pseudo']); ?> </p>
		</div>
		<div class="col-md-10">
		<!-- Contenue du topic de l'auteur -->
			<div style="text-overflow: clip; word-wrap: break-word;"><?php unset($contenue);
			$contenue = espacement($topicd['contenue']);
			$contenue = BBCode($contenue, $bddConnection);
			echo $contenue;
			?></div><br/><div style="border-top: 0.5px grey solid;"></div>
			<p class="text-right text-muted">Posté le <?php  echo $topicd['jour']; ?> <?php $mois = switch_date($topicd['mois']); echo $mois; ?> <?php echo $topicd['annee'];?>  <?php if($topicd['d_edition'] != NULL) { echo 'édité le '; $d_edition = explode('-', $topicd['d_edition']); echo $d_edition[2]; echo '/' .$d_edition[1]. '/' .$d_edition[0]. ''; } ?></p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-2">
	<form action="?&action=signalement_topic" method="post">
		<input type="hidden" name="id_topic2" value='<?php echo $id; ?>' />
		<button type="submit" class="btn btn-primary">Signaler !</button>
	</form>
	</div>
	<?php if($_Joueur_['pseudo'] == $topicd['pseudo'] OR ($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['editTopic'] == true) AND !$_SESSION['mode'])
	{
		?><div class="col-md-2"><form action="?page=edit_topic" method="post">
			<input type="hidden" name="id_topic" value="<?php echo $id; ?>" />
			<button type="submit" class="btn btn-rounded btn-default">Editer le topic</button>
		</form>
		</div>
		<?php
	}
		if($_Joueur_['pseudo'] == $topicd['pseudo'] OR ($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['deleteTopic'] == true) AND !$_SESSION['mode'])
		{
			?>
		<div class="col-md-2">
		<form action="?action=remove_topic" method="post">
			<input type="hidden" name="id_topic" value="<?php echo $id; ?>" />
			<a class="btn btn-round btn-default" role="button" data-toggle="collapse" href="#topic_<?php echo $id; ?>" aria-expanded="false" aria-controls="collapseExample" >
				Supprimer ce topic ? </a>
				<div class="collapse" id="topic_<?php echo $id; ?>">
					<div class="well">
						<button type="submit" class="btn btn-round btn-warning">Confirmer la suppression du topic </button>
					</div>
				</div>
		</form>
		</div><?php
		}
	?>
	</div>
	<!-- Affichage des réponses -->
	 <?php
    $count_Max = $_Forum_->compteReponse($id);
    $count_nbrOfPages = ceil($count_Max / 20);

    if(isset($_GET['page_post']))
    {
        $page = $_GET['page_post'];
    } else {
        $page = 1;
    }

    $count_FirstDisplay = ($page - 1) * 20;
	$answerd = $_Forum_->affichageReponse($id, $count_FirstDisplay);
    for($i = 0; $i < count($answerd); $i++)
	{ ?>
		<hr/>
		<div class="well well-lg">
		<div class="row">
			<div class="col-md-2">
				<div id="<?php echo $answerd[$i]['id']; ?>"> <!-- div de droite avec les infos joueurs -->
					<img class="rounded" src="https://cravatar.eu/head/<?php echo $answerd[$i]['pseudo']; ?>/128" alt="avatar de l'auteur" title="<?php echo $answerd[$i]['pseudo']; ?>" />
					<p class="username">Pseudo : <?php echo $answerd[$i]['pseudo']; ?><br/>
						Grade : <?php echo $_Forum_->gradeJoueur($answerd[$i]['pseudo']); ?>
					</p>
				</div>
			</div>
			<div class="col-md-10"> <!-- contenue de la réponse -->
				<div style="text-overflow: clip; word-wrap: break-word;"><?php $answere = $answerd[$i]['contenue'];
				$answere = espacement($answere);
				$answere = BBCode($answere, $bddConnection);
				echo $answere;
				?></div>
				<br/><div style="border-top: 0.5px grey solid;"></div>
				<p class="text-right text-muted"><?php echo $answerd[$i]['day']; ?> <?php $answerd[$i]['mois'] = switch_date($answerd[$i]['mois']); echo $answerd[$i]['mois']; ?> <?php echo $answerd[$i]['annee']; ?> <?php if($answerd[$i]['d_edition'] != NULL){ echo 'édité le '; $d_edition = explode('-', $answerd[$i]['d_edition']); echo '' .$d_edition[2]. '/' .$d_edition[1]. '/' .$d_edition[0]. ''; } ?> </p>
			</div>
		</div>
		<div class="row">
		<div class="col-md-2">
			<form action="?&action=signalement" method="post">
				<input type="hidden" name="id_answer" value='<?php echo $answerd[$i]['id']; ?>' />
				<button type="submit" class="btn btn-primary">Signaler !</button>
			</form></div>
			<?php
			$countlike = $_Forum_->compteLike($answerd[$i]['id'], $count);
			if($count > 0)
			{
				if($count >= 3)
				{
					echo '<div class="col-md-2">';
					for($z = 0; $z < count($countlike); $z++)
					{
						echo ' ';
						echo $countlike[$z]['pseudo'];
						echo ',';
					}
					echo ' aiment ça ';
					?><a href="?&page=list_like&id_answer=<?php echo $answerd[$i]['id']; ?>" title="liste des j'aimes">Liste</a></div><?php
				}
				if($count > 1 && $count < 3)
				{
					echo '<div class="col-md-2">';
					for($z = 0; $z < count($countlike); $z++)
					{
						echo ' ';
						echo $countlike[$z]['pseudo'];
						echo ',';
					}
					echo ' aiment ça </div>';
				}
				elseif($count == 1)
				{
					echo '<div class="col-md-2">';
					echo ' ';
					echo $likedata[0]['pseudo'];
					echo ' aime ça </div>';
				}
			}
			$countdislike = $_Forum_->compteDisLike($answerd[$i]['id'], $count);
			if($count > 0)
			{
				if($count > 3)
				{
					echo '<div class="col-md-2">';
					for($z = 0; $z < count($countdislike); $z++)
					{
						echo ' ';
						echo $countdislike[$z]['pseudo'];
						echo ',';
					}
					echo ' n\'aiment ça';
					?><a href="?&page=list_unlike&id_answer=<?php echo $answerd[$i]['id']; ?>" title="liste des Je n'aime pas">Liste</a></div><?php
				}
				if($count > 1 AND $count < 3)
				{
					echo '<div class="col-md-2">';
					for($z = 0; $z < count($countdislike); $z++)
					{
						echo ' ';
						echo $countdislike[$z]['pseudo'];
						echo ',';
					}
					echo ' n\'aiment ça </div>';
				}
				elseif($count == 1)
				{
					echo '<div class="col-md-2"> ';
					echo $countdislike[0]['pseudo'];
					echo ' n\'aime pas ça</div>';
				}
			}
			$test_votedata = $_Forum_->testVote($answerd[$i]['id'], htmlspecialchars($_Joueur_['pseudo']));
			if(empty($test_votedata['count']) && $_Joueur_['pseudo'] != $answerd[$i]['pseudo'])
			{
				?><div class="col-md-1">
				<form class="form-inline" action="?&action=like" method="post">
					<input type="hidden" name="choix" value="1" />
					<input type="hidden" name="id_answer" value="<?php echo $answerd[$i]['id']; ?>" />
					<button type="submit" class="btn btn-primary" title="J'aime" ><i class="far fa-thumbs-up"></i></button>
				</form></div><div class="col-md-1">
				<form class="form-inline" action="?&action=like" method="post">
					<input type="hidden" name="choix" value="2" />
					<input type="hidden" name="id_answer" value="<?php echo $answerd[$i]['id']; ?>" />
					<button type="submit" class="btn btn-primary" title="Je n'aime pas"><i class="far fa-thumbs-down"></i></button>
				</form></div>
				<?php
			}
			elseif($_Joueur_['pseudo'] != $answerd[$i]['pseudo'] AND $test_votedata['count'] > 0)
			{
				?><div class="col-md-1">
				<form class='form-inline' action="?&action=unlike" method="post">
					<input type="hidden" name="id_answer" value="<?php echo $answerd[$i]['id']; ?>" />
					<button type="submit" class="btn btn-primary" title="Ne plus aimer">Retirer</button>
				</form></div>
				<?php
			}
			if($_Joueur_['pseudo'] === $answerd[$i]['pseudo'] OR ($_PGrades_['PermsForum']['moderation']['editMessage'] == true OR $_Joueur_['rang'] == 1) AND !$_SESSION['mode'])
			{
				?><div class="col-md-2"><form action="?page=edit_answer" method="post">
					<input type="hidden" name="id_answer" value="<?php echo $answerd[$i]['id']; ?>" />
					<button type="submit" class="btn btn-default">Editer ce message</button>
				</form></div>
				<?php
			}
			if($_Joueur_['pseudo'] === $answerd[$i]['pseudo'] OR ($_PGrades_['PermsForum']['moderation']['deleteMessage'] == true OR $_Joueur_['rang'] == 1) AND !$_SESSION['mode'])
			{
				?>
			<div class="col-md-2">
				<form action="?action=remove_answer" method="post">
					<input type="hidden" name="id_answer" value="<?php echo $answerd[$i]['id']; ?>" />
					<input type="hidden" name="page" value="<?php if(isset($_GET['page_post'])) { echo $_GET['page_post']; } else { echo '1'; }?>" />
					<a role="button" class="btn btn-primary" data-toggle="collapse" href="#answer_<?php echo $answerd[$i]['id']; ?>" aria-expanded="false" aria-controls="collapseExample">
						Supprimer ce message ? </a>
						<div class="collapse" id="answer_<?php echo $answerd[$i]['id']; ?>">
							<div class="well">
								<button type="submit" class="btn btn-round btn-warning">Confirmer </button>
							</div>
						</div>
				</form></div><?php
			}
			?>
		</div></div><?php
	}

	?><br/>
	<nav aria-label="Page Navigation Post">
		<ul class="pagination justify-content-center"><?php
			for($i = 1; $i <= $count_nbrOfPages; $i++)
			{
                ?><li class="page-item"><a href="?&page=post&id=<?php echo $id; ?>&page_post=<?php echo $i; ?>"><?php echo $i;
                ?></a></li><?php
			} ?>
        </ul>
	</nav>
	 <br/><?php

	 if($topicd['etat'] == 1 AND (($_Joueur_['rang'] != 1 OR $_PGrades_['PermsForum']['general']['seeForumHide'] != true) AND $_SESSION['mode']))
	 {
		 ?><div class="alert alert-info" role="alert">Le topic est fermé ! Aucune réponse n'est possible ! </div><?php
	 }
	 elseif($topicd['etat'] == 0 OR (($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['seeForumHide'] == true) AND !$_SESSION['mode']))
	 {
		$data = $_Forum_->isLock($topicd['id_categorie']);
		if($data['close'] == 0 OR ($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['seeForumHide'] == true) AND !$_SESSION['mode'])
		{
		 ?><hr/><div class="separator" style="border-top: 1px solid black;"></div>
	<form action="?&action=post_answer" method="post">
		<p>
		<input type='hidden' name="id_topic" value="<?php echo $id; ?>"/>
		<div class="form-group row">
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
				<!--<a href="javascript:ajout_text('contenue', 'Ecrivez ici ce que vous voulez mettre en rouge', 'ce texte sera en rouge', 'color=red')" class="redactor_color_link" style="background-color: rgb(255, 0, 0);"></a>-->
			</div><br/>
				<div class="col-md-12 text-center">
					<label for="contenue" class="form-control-label">Contenue de votre réponse ( 10 000 caractères max ! ) : </label>
				</div>
			<div class="col-md-12">
				<textarea class="form-control" name="contenue" id="contenue" max="10 000" min="1" rows="20" require ></textarea>
			</div>
		</div>
		<div class="form-group row">
			<div class="col-md-12 text-center">
				<button type="submit" class="btn btn-primary">Poster votre réponse</button>
			</div>
		</div>
		</p>
	</form>
	<?php
		}
	 }
	 ?>
	 	</div>
</section>
<?php
	}
	else
	{
		header('Location: index.php');
	}
}
else
	header('Location: ?page=erreur&erreur=17');//fatale
?>
